<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use JWTFactory;

class ApiAuthController extends Controller
{
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'required|string|max:255',
            'lastname' => 'string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'newsletters_subs' => 'boolean',
            'biography' => 'string',
            'photo' => 'mimes:jpeg,bmp,png',
            'whois' => 'required|string'
        ]);
    }

    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }

        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->newsletters_subs = $request->newsletters_subs;
        $user->whois = $request->whois;
        $user->password = bcrypt($request->password);
        $user->save();

        $token = JWTAuth::fromUser($user);
        return response([
            'status' => 'success',
            'data' => [$user, 'token' => $token]
        ], 200);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if ( !$token = JWTAuth::attempt($credentials)) {
            return response([
                'status' => 'error',
                'error' => 'invalid.credentials',
                'msg' => 'Invalid Credentials.'
            ], 400);
        }
        return response([
            'status' => 'success',
            'token' => $token
        ]);
    }

    public function refresh()
    {
        return response([
            'status' => 'success'
        ]);
    }
}
