<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class SalesController extends Controller
{
    public function index(){
        $data['sales'] = User::where([
            'role' => 'Sales',
        ])->get();

        return view('admin.sales', $data);
    }
}
