<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

use App\Models\User;
use App\Models\UserAccessLog;

class AuthController extends Controller
{
    public function authenticate(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }
        //Verify login information
        $credentials = $request->only(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['message' => 'Incorrect credentials'], 401);
        }

        // Token dikirimkan sebagai respons setelah otentikasi berhasil
        return response()->json([
            'user' => [
                'role'       => auth()->user()->role,
                'name'       => auth()->user()->name,
                'email'      => auth()->user()->email,
                'image_path' => auth()->user()->image_path,
            ],
            'access_token' => $token,
            'token_type'   => 'bearer',
        ]);

    }

    public function checkAuthenticate(){
        $salesCookie = $request->header('sales-web-cookie');

        $checkCookie = UserAccessLog::where([
            'user_cookie' => $salesCookie,
        ])->first();

        if($checkCookie == null){
            return response()->json([
                'message' => 'Cookie not found',
            ],200);
        }

        $getUser = User::
        where([
            'uuid' => $checkCookie->user_uuid,
        ])->first();

        if($getUser == null){
            return response()->json([
                'message' => 'User not register',
            ],200);
        }

        $jwtToken = $request->header('Authorization');

        if($jwtToken){
            try{
                $user = JWTAuth::parseToken()->authenticate();
                return response()->json([
                    'message' => 'User already log in',
                    'redirectTo' => $user->role,
                ],200);
            } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
                return response()->json([
                    'message' => 'token expired',
                ], 401);
            } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                return response()->json([
                    'message' => 'token invalid',
                ], 401);
            } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
                return response()->json([
                    'message' => 'token not found',
                ], 401);
            } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
                return response()->json([
                    'message' => 'could not decode token',
                ], 401);
            }
        }
        return response()->json([
            'message' => 'User need to log in',
            'redirectTo' => $getUser->role,
        ],200);

    }
}
