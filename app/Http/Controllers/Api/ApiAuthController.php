<?php

namespace App\Http\Controllers\Api;

use auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
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



    //-----------------------------------------------------------------------------------




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



//-----------------------------------------------------------------------------------

    public function login(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string' //|password:api

        ]);

        if (!$validator->fails()) {
            try {
                $response= Http::asForm()->post('http://127.0.0.1:8001/oauth/token',[
                    'grant_type' => 'password',
                    'client_id' => '3',
                    'client_secret' =>'ZSr8H0mA3K6r8OoapgRtVGTXEXIpPT3I53HFC6EY',
                    'username' => $request->get('email'),
                    'password' => $request->get('password'),
                    'scope' => '*'
                    ]);
                    $user = User::where('email', $request->get('email'))->first();
                    $user->setAttribute('token', $response->json()['access_token']);
                    $user->setAttribute('refresh_token', $response->json()['refresh_token']);
                    $user->setAttribute('token_type', $response->json()['token_type']);
                    return response()->json([
                        'message' => 'login success', 'data' => $user
                            ], Response::HTTP_OK);


            } catch (Exception $e) {
              $message ='';
              if($response->json()['error']=='invalid_grant'){
                $message = 'Cradentials is incorrect, please enter correct email and password';
                }
              else{
                $message = 'login success';
                }
              return response()->json([
                  'status' => false,
                  'message' => $message
                ], Response::HTTP_BAD_REQUEST);
            }



        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
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
