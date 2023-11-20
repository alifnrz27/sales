<?php

namespace App\Http\Controllers\API\AllRole;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserAccessLog;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class RegisterController extends Controller
{
    public function store(Request $request){
        try{
            $validate = [
                'name' => 'required|string',
                'username' => 'required|string|unique:users',
                'email' => 'required|string|email|unique:users',
                'image' => 'required',
                'password' => 'required|min:8',
                'whatsapp' => 'required|string',
                'instagram' => 'required|string',
                'facebook' => 'required|string',
                'reference_sales_uuid' => 'required|string',
            ];

            $validator = Validator::make($request->all(), $validate);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $checkReferenceSales = User::where([
                'uuid' => $request->reference_sales_uuid,
            ])->first();

            if($checkReferenceSales == null){
                return response()->json([
                    'message' => 'Reference sales not found',
                ], 422);
            }

            $cleanedNumber = preg_replace('/[^0-9]/', '', $request->whatsapp);

            $checkPhoneNumber = User::where([
                'whatsapp' => $cleanedNumber,
            ])->first();

            if($checkPhoneNumber){
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => [
                        'whatsapp'=> [
                            'The number already taken'
                        ]
                    ],
                ], 422);
            }

            if(substr($request->image, 0, 4) == "data"){
                $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->image));
                $pathToSave = storage_path('app/public/sales'); // Ganti dengan direktori yang sesuai
                $imageName = uniqid() . '.png'; // Nama file unik dengan ekstensi .png
                $imagePath = $pathToSave . '/' . $imageName;
                $path = "sales/".$imageName;
                file_put_contents($imagePath, $imageData);
            }else{
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => [
                        "image" => [
                            "Image not valid"
                        ],
                    ],
                ], 422);
            }

            // Menambahkan awalan + jika belum dimulai dengan +
            if (substr($cleanedNumber, 0, 1) !== '+') {
                // Menghapus angka 0 di depan jika ada
                $cleanedNumber = ltrim($cleanedNumber, '0');

                // Menambahkan awalan +62
                $cleanedNumber = '+62' . $cleanedNumber;
            }

            $sales = User::
            create([
                'name' => $request->name,
                'username' => $request->username,
                'role' => 'Sales Pending',
                'email' => $request->email,
                'image_path' => $path,
                'password' => bcrypt($request->password),
                'whatsapp' => $cleanedNumber,
                'instagram' => $request->instagram,
                'facebook' => $request->facebook,
                'reference_sales_uuid' => $checkReferenceSales->uuid,
                ]);

            $userLog = UserAccessLog::create([
                'phone_number' => $cleanedNumber,
                'user_uuid' => $sales->uuid,
                'sales_uuid' => $checkReferenceSales->uuid,
                'user_cookie' => Uuid::uuid4()->toString()
            ]);

            return response()->json([
                'message' => 'Redirect',
                'dataCookie' => $userLog->user_cookie,
                'username' => $checkReferenceSales->username,
            ], 200);
        }
        catch(\Exception $e){
            return response()->json([
                'message' => $e,
            ], 404);
        }
    }
}
