<?php

namespace App\Http\Controllers\AllRole;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class SalesController extends Controller
{
    public function index($username){
        $data['sales'] = User::where([
            'username' => $username,
        ])->first();

        if(!$data['sales']){
            return abort(404);
        }

        return view('allRole.index', $data);
    }
}
