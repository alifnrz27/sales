<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\AllRole\SalesController as ShowSalesController;
use App\Http\Controllers\AllRole\ProfileController;

use App\Http\Controllers\Admin\SalesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
    return redirect(route('login'));
})->name('home');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/register', [RegisterController::class, 'index'])->name('register');

Route::get('/admin/sales', [SalesController::class, 'index'])->name('admin.sales');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

Route::get('/{username_sales}', [ShowSalesController::class, 'index'])->name('show.sales');

