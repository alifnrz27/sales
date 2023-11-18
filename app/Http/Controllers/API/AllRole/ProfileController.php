<?php

namespace App\Http\Controllers\API\AllRole;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    public function index(){
        $user = JWTAuth::parseToken()->authenticate();

        $getUser = User::
        select("name", "username", "image_path", "email", "whatsapp", "instagram", "facebook")
        ->where([
            'uuid' => $user->uuid,
        ])->first();

        return response()->json([
            'message' => "Success get data",
            "user" => $getUser,
        ], 200);
    }

    public function update(Request $request){
        try{
            $user = JWTAuth::parseToken()->authenticate();

            $getUser = User::
            where([
                'uuid' => $user->uuid,
            ])->first();

            $validate = [
                'name' => 'required|string',
                'username' => 'required|string',
                'email' => 'required|string|email',
                'image' => 'required',
                'whatsapp' => 'required|string',
                'instagram' => 'required|string',
                'facebook' => 'required|string',
            ];

            if($request->password){
                $validate['password'] = "required|min:8";
            }
            if($request->email != $getUser->email){
                $validate['email'] = "required|string|email|unique:users";
            }
            if($request->username != $getUser->username){
                $validate['username'] = "required|string|unique:users";
            }

            $validator = Validator::make($request->all(), $validate);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $path = $getUser->image_path;
            if(substr($request->image, 0, 4) == "data"){
                if (File::exists(public_path('storage/'.$getUser->image_path))) {
                    File::delete(public_path('storage/'.$getUser->image_path));
                }
                $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->image));
                $pathToSave = storage_path('app/public/sales'); // Ganti dengan direktori yang sesuai
                $imageName = uniqid() . '.png'; // Nama file unik dengan ekstensi .png
                $imagePath = $pathToSave . '/' . $imageName;
                $path = "sales/".$imageName;
                file_put_contents($imagePath, $imageData);
            }
            $cleanedNumber = preg_replace('/[^0-9]/', '', $request->whatsapp);

            // Menambahkan awalan + jika belum dimulai dengan +
            if (substr($cleanedNumber, 0, 1) !== '+') {
                // Menghapus angka 0 di depan jika ada
                $cleanedNumber = ltrim($cleanedNumber, '0');

                // Menambahkan awalan +62
                $cleanedNumber = '+62' . $cleanedNumber;
            }

            $validated = [
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'image_path' => $path,
                'whatsapp' => $cleanedNumber,
                'instagram' => $request->instagram,
                'facebook' => $request->facebook,
            ];

            if($request->password){
                $validated['password'] = bcrypt($request->password);
            }

            User::
            where(['uuid' => $getUser->uuid])
            ->update($validated);

            return response()->json([
                'message' => 'Success update data',
            ], 200);
        }
        catch(\Exception $e){
            return response()->json([
                'message' => $e,
            ], 404);
        }
    }
}
