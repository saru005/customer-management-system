<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('login', function(){
    return view('login');
});
Route::get('signup', function(){
    return view('signup');
});
Route::get('/', function () {
    return view('welcome');
});
Route::post('/login',[AuthController::class,'login'])->name('login');
Route::post('/signup',[CustomerController::class,'signup'])->name('signup');