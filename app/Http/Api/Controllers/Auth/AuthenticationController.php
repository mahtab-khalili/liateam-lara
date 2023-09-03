<?php

namespace App\Http\Api\Controllers\Auth;

use App\Http\Api\Controllers\Controller;
use Illuminate\Http\Request;
use Domain\User\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{

    public function register(Request $request){

        //Validate fields
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        // Check duplication email
        $user = User::where('email', $request->email)->first();
        if(!is_null($user))
        {
            return responseApi(
                'failed',
                trans('auth.register_failed_duplicate_email'),
                null,
                422
            );
        }
        
        //Create user
        $user =  User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        // Generate token
        $token = JWTAuth::fromUser($user);

        return responseApi(
            'success',
            trans('auth.signed_up_success'),
            [
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]
        );
    }
    
    public function login(Request $request)
    {
        
        $creds = $request->only(['email', 'password']);

        // Authenticate user
        if(!$token = auth()->attempt($creds)){
            return responseApi(
                'failed',
                trans('auth.sign_in_failed_Invalid_email_password'),
                null,
                401
            );
        };

        return responseApi(
            'success',
            trans('auth.signed_in_success'),
            [
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]
        );
    }

    public function refresh()
    {
        // Refresh token 
        try{

            $newToken = auth()->refresh();

        } catch(\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return responseApi(
                'failed',
                $e->getMessage(),
                null,
                401
            );
        } catch(\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return responseApi(
                'failed',
                $e->getMessage(),
                null,
                500
            );
        }

        return response()->json(['token' => $newToken]);
    
    }

}