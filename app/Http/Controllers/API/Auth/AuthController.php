<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

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
}
