<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;
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

Route::get('login', function (Request $request) {
    if ($request->session()->has('user_id')) {
        return redirect()->route('dashboard');
    }
    if ($request->session()->has('customer_id')) {
        return redirect()->route('home');
    }
    return view('login');
});
Route::get('signup', function () {
    return view('signup');
});
Route::get('/', function (Request $request) {
    if (!$request->session()->has('customer_id')) {
        return redirect()->route('login');
    }
    return view('homepage');
})->name('home');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/signup', [CustomerController::class, 'signup'])->name('signup');

Route::middleware(['admin.auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/approve_customer/{id}', [CustomerController::class, 'approveCustomer'])->name('approve_customer');
    Route::get('/dashboard/reject_customer/{id}', [CustomerController::class, 'rejectCustomer'])->name('reject_customer');
    Route::get('/dashboard/edit_customer/{id}', [CustomerController::class, 'editCustomerPage'])->name('edit_customer');
    Route::post('/dashboard/edit_customer/{id}', [CustomerController::class, 'edit'])->name('edit_customer_detail');
});
