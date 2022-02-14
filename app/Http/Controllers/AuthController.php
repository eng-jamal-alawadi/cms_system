<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Mockery\Generator\StringManipulation\Pass\Pass;

class AuthController extends Controller
{
    public function showLoginPage(Request $request ,$guard)
    {
        return view('cms.login',['guard'=>$guard]);
    }

    public function login(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:30',
            'remember' => 'required|boolean',
            'guard' => 'required|string|in:admin,user'
        ],
        ['guard.in'=>'please check login URL']);

        if (!$validator->fails()) {
            $cridentials = [
                'email' => $request->get('email'),
                'password' => $request->get('password')
            ];
            if (Auth::guard($request->get('guard'))->attempt($cridentials, $request->get('remember'))) {
                return response()->json([
                    'message' => 'Login Successfully',
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'message' => 'Invalid Credentials',
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    // public function login(Request $request)
    // {
    //     $validator = Validator($request->all(), [
    //         'email' => 'required|email|exists:admins,email',
    //         'password' => 'required|string|min:6|max:30',
    //         'remember' => 'required|boolean'
    //     ]);
    //     if (!$validator->fails()) {
    //         $cridentials = [
    //             'email' => $request->get('email'),
    //             'password' => $request->get('password')
    //         ];
    //         if (Auth::guard('admins')->attempt($cridentials, $request->get('remember'))) {
    //             return response()->json([
    //                 'message' => 'Login Successfully',
    //             ], Response::HTTP_OK);
    //         } else {
    //             return response()->json([
    //                 'message' => 'Invalid Credentials',
    //             ], Response::HTTP_BAD_REQUEST);
    //         }
    //     } else {
    //         return response()->json([
    //             'message' => $validator->getMessageBag()->first(),
    //         ], Response::HTTP_BAD_REQUEST);
    //     }
    // }


    public function logout(Request $request)
    {
        //tow way to logout

        //multiple guard logout

        // Auth::guard('admins')->logout();
        // if(auth('admin')->check()){
        //     auth('admin')->logout();
        //     $request->session()->invalidate();
        //     return redirect()->route('login','admins');
        // }else{
        //     auth('usetr')->logout();
        //     $request->session()->invalidate();
        //     return redirect()->route('login','user');
        // }
//-------------------------------------------------------------------------------------------------
        //tow guard logout
        $guard=auth('admin')->check() ? 'admin' : 'user';
        auth($guard)->logout();
        $request->session()->invalidate();
        return redirect()->route('login',$guard);


    }

    public function changePassword(){

        return view('cms.auth.change-password');
    }

    public function updatePassword(Request $request){

        $guard = auth('admin')->check() ? 'admin' : 'user';
        $validator = Validator($request->all(),[
            'current_password'=>"required|string|min:3|password:$guard",
            'new_password'=>'required|string|min:3|confirmed'
        ]);

        if(!$validator->fails()){
            $user = auth($guard)->user();
            $user->password = Hash::make($request->get('new_password'));
            $isSaved = $user->save();
            if($isSaved){
                return response()->json([
                    'message'=>'Password Changed Successfully'
                ],Response::HTTP_OK);
            }else{
                return response()->json([
                    'message'=>'Password Changed Failed'
                ],Response::HTTP_BAD_REQUEST);

            }
        }else{
            return response()->json([
                'message'=>$validator->getMessageBag()->first(),
            ],Response::HTTP_BAD_REQUEST);
        }

    }


}
