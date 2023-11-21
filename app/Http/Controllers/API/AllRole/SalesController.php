<?php

namespace App\Http\Controllers\API\AllRole;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\UserAccessLog;

use Ramsey\Uuid\Uuid;

class SalesController extends Controller
{
    public function submitPhoneNumber(Request $request, $username){
        // Menghapus karakter selain angka
        $cleanedNumber = preg_replace('/[^0-9]/', '', $request->phone_number);

        // Menambahkan awalan + jika belum dimulai dengan +
        if (substr($cleanedNumber, 0, 1) !== '+') {
            // Menghapus angka 0 di depan jika ada
            $cleanedNumber = ltrim($cleanedNumber, '0');

            // Menambahkan awalan +62
            $cleanedNumber = '+62' . $cleanedNumber;
        }


        $getUserLog = UserAccessLog::where([
            'phone_number' => $cleanedNumber,
        ])->first();

        if($getUserLog){
            $getSales = User::where([
                'uuid' => $getUserLog->sales_uuid,
            ])->first();

            return response()->json([
                "message" => "Redirect",
                "username" => $getSales->username,
                'dataCookie' => $getUserLog->user_cookie
            ], 200);
        }


        $getSales = User::where([
            'username' => $username,
        ])->first();

        // return response()->json([
        //     "message" => "Register",
        //     "reference_sales_uuid" => $getSales->uuid,
        // ], 200);
        $UserAccessLog = UserAccessLog::create([
            'user_uuid' => '-',
            'phone_number' => $cleanedNumber,
            'sales_uuid' => $getSales->uuid,
            'user_cookie' => Uuid::uuid4()->toString()
        ]);


        return response()->json([
            'message' => "Success add phone number",
            'dataCookie' => $UserAccessLog->user_cookie
        ]);
    }

    public function show(Request $request, $username){
        $getUserLog = UserAccessLog::where([
            'user_cookie' => $request->userCookie,
        ])->first();

        if($getUserLog){
            $getSales = User::where([
                'uuid' => $getUserLog->sales_uuid,
            ])->first();

            return response()->json([
                "message" => "Redirect",
                "username" => $getSales->username,
            ], 200);
        }


        $getSales = User::where([
            'username' => $username,
        ])->first();

        $getUserLog = UserAccessLog::where([
            'sales_uuid' => $getSales->uuid,
            'user_cookie' => $request->userCookie,
        ])->first();


        if(!$getUserLog){
            return response()->json([
                "message" => "Input phone number"
            ], 200);
        }
    }
}
