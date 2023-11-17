<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserAccessLog;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SalesController extends Controller
{
    public function index(){
        try{
            $sales = User::
            select('uuid', 'name', 'role', 'email', 'image_path')->where(['role' => 'Sales'])->get();
            return response()->json([
                'message' => 'Success get data',
                'sales' => $sales,
            ], 200);
        }
        catch(\Exception $e){
            return response()->json([
                'message' => $e,
            ], 404);
        }
    }

    public function show($uuid){
        try{
            $sales = User::
            select('uuid', 'name', 'username', 'role', 'email', 'image_path', 'facebook', 'instagram', 'whatsapp')->where(['role' => 'Sales', 'uuid' => $uuid])->first();

            if(!$sales){
                return response()->json([
                    'message' => 'Sales not found',
                ], 404);
            }
            return response()->json([
                'message' => 'Success get data',
                'user' => $sales,
            ], 200);
        }
        catch(\Exception $e){
            return response()->json([
                'message' => $e,
            ], 404);
        }
    }

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
            ];

            $validator = Validator::make($request->all(), $validate);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }

            if(substr($request->image, 0, 4) == "data"){
                $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->image));
                $pathToSave = storage_path('app/public/sales'); // Ganti dengan direktori yang sesuai
                $imageName = uniqid() . '.png'; // Nama file unik dengan ekstensi .png
                $imagePath = $pathToSave . '/' . $imageName;
                $path = "sales/".$imageName;
                file_put_contents($imagePath, $imageData);
            }

            $sales = User::
            create([
                'name' => $request->name,
                'username' => $request->username,
                'role' => 'Sales',
                'email' => $request->email,
                'image_path' => $path,
                'password' => bcrypt($request->password),
                'whatsapp' => $request->whatsapp,
                'instagram' => $request->instagram,
                'facebook' => $request->facebook,
                ]);

            return response()->json([
                'message' => 'Success create new data',
                'user' => [
                    'name' => $sales->name,
                    'username' => $sales->username,
                    'email' => $sales->email,
                    'image_path' => $sales->image_path,
                    'whatsapp' => $sales->whatsapp,
                    'instagram' => $sales->instagram,
                    'facebook' => $sales->facebook,
                ],
            ], 200);
        }
        catch(\Exception $e){
            return response()->json([
                'message' => $e,
            ], 404);
        }
    }

    public function update(Request $request, $uuid){
        try{
            $getUser = User::where([
                'uuid' => $uuid,
            ])->first();

            if(!$getUser){
                return response()->json([
                    'message' => 'Sales not found',
                ], 404);
            }

            $validate = [
                'name' => 'required|string',
                'username' => 'required|string',
                'email' => 'required|string|email',
                'image' => 'required',
                'whatsapp' => 'required|string',
                'instagram' => 'required|string',
                'facebook' => 'required|string',
            ];

            if(isset($request->username)){
                if($request->username != $getUser->username){
                    $validate['username'] = 'required|string|unique:users';
                }
            }

            if(isset($request->email)){
                if($request->email != $getUser->email){
                    $validate['email'] = 'required|string|unique:users';
                }
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

            User::where(['uuid' => $uuid])
            ->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'image_path' => $path,
                'whatsapp' => $request->whatsapp,
                'instagram' => $request->instagram,
                'facebook' => $request->facebook,
                ]);

            return response()->json([
                'message' => 'Success update data',
                'sales' => [
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => $request->email,
                    'image_path' => $path,
                    'whatsapp' => $request->whatsapp,
                    'instagram' => $request->instagram,
                    'facebook' => $request->facebook,
                ],
            ], 200);
        }
        catch(\Exception $e){
            return response()->json([
                'message' => $e,
            ], 404);
        }
    }

    public function delete($uuid){
        $getUser = User::where([
            'uuid' => $uuid,
        ])->first();

        if (File::exists(public_path('storage/'.$getUser->image_path))) {
            File::delete(public_path('storage/'.$getUser->image_path));
        }

        UserAccessLog::where([
            'sales_uuid' => $getUser->uuid,
        ])->delete();

        User::where([
            'uuid' => $uuid,
        ])->delete();

        return response()->json([
            'message' => 'Success delete sales',
        ], 200);
    }
}
