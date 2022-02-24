<?php

namespace App\Http\Controllers\Api;

use auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthController extends Controller
{

    //الطريقة الاولى هي عند تسجيل الدخول بنجاح يتم حذف جميع التوكن القديمة ويتم إنشاء جديدة
    // يعني يتم تسجيل الخروج من جميع الجلسات القديمة
    // public function login(Request $request)
    // {
    //     $validator = Validator($request->all(), [
    //         'email' => 'required|email|exists:users,email',
    //         'password' => 'required|string' //|password:api

    //     ]);

    //     if (!$validator->fails()) {
    //         $user = User::where('email', $request->get('email'))->first();
    //         if (Hash::check($request->get('password'), $user->password)) {
    //             $this->revokePreviousToken($user->id);
    //             $token = $user->createToken('User-Api');
    //             $user->setAttribute('token', $token->accessToken);
    //             return response()->json([
    //                 'message' => 'login success', 'data' => $user
    //             ], Response::HTTP_OK);
    //         } else {
    //             return response()->json([
    //                 'message' => 'password is incorrect'
    //             ], Response::HTTP_BAD_REQUEST);
    //         }
    //     } else {
    //         return response()->json([
    //             'message' => $validator->getMessageBag()->first()
    //         ], Response::HTTP_BAD_REQUEST);
    //     }
    // }
    //-----------------------------------------------------------------------------------
    //الطريقة الثانية يمنعك من الدخول اذا كنت مسجل دخول من اكثر من جهاز
    // يعني يتم تسجيل الدخول من جهاز واحد فقط
    
    public function login(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string' //|password:api

        ]);

        if (!$validator->fails()) {
            $user = User::where('email', $request->get('email'))->first();
            if (Hash::check($request->get('password'), $user->password)) {
                 if(!$this->checkForActiveTokens($user->id)){
                    $token = $user->createToken('User-Api');
                    $user->setAttribute('token', $token->accessToken);
                    return response()->json([
                    'message' => 'login success', 'data' => $user
                ], Response::HTTP_OK);
                 }else{
                    return response()->json([
                        'message' => 'you are already logged in from another device'
                    ], Response::HTTP_BAD_REQUEST);
                 }

            } else {
                return response()->json([
                    'message' => 'password is incorrect'
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }



    // هذه الفنكشن تستخدم للخروج من التوكن بعد التسجيل بنجاح
    // تحذف التوكن القديم وتحديث التوكن الجديد بعد التسجيل بنجاح
    private function revokePreviousToken($userId){
        DB::table('oauth_access_tokens')
        ->where('user_id', $userId)
        ->update([
            'revoked' => true
        ]);
    }

    private function checkForActiveTokens($userId){
        return DB::table('oauth_access_tokens')
        ->where('user_id', $userId)
        ->where('revoked' , false)
        ->exists();
    }

    public function logout()
    {
        $token = auth('api')->user()->token();
        $isRevoked = $token->revoke();
        return response()->json(['status' => $isRevoked ,
            'message' => $isRevoked ? 'logout success' : 'logout failed' ,
    ], $isRevoked ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);

    }
}
