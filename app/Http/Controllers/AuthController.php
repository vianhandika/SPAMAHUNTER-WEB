<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
// use Validator;
use App\User;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        if ( ! $token = JWTAuth::attempt($credentials)) {
            return response([
                'status' => 'Failed To Login',
                // 'error' => 'invalid.credentials',
                // 'msg' => 'Invalid Credentials.'
            ], 400);
        }

        return response([
            'status' => 'success'
        ])
        ->header('Authorization', $token);

        
        // try {
        //     if(Auth::attempt(['username' => request('username'), 'password' => request('password')]))
        //     {
        //         $users = Auth::User(); 
        //         return response()->json([$users], 200); 
        //         // return redirect()->intended('/vueapp');
        //     }
        //     else{
        //         throw "failed";
        //     }
        // } 
        // catch (\Exception $e){
        //     // return $this->sendIseResponse($e->getMessage());
        //     return response()->json(['Failed To Login'=>$e], 401);
            
        // }
    }
    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);

        return response([
            'status' => 'success',
            'data' => $user
        ]);
    }

    public function refresh()
    {
        return response([
            'status' => 'success'
        ]);
    }
    
    public function logout()
    {
        JWTAuth::invalidate();

        return response([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }
}