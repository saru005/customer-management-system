<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Customer;
class AuthController extends Controller
{
    public function login(Request $request){
        //create a record for the admin in users table for testing purposes
        // $user = User::create(['name' => 'Sarvesh Yadav','email' => 'sarvesh@gmail.com','password' => Hash::make('123')]);
        // dd($user);
        $Validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($Validator->fails())
        {
            return response()->json(['errors' => $Validator->errors()], 422);
        }
        
        if ($request->get('user_type') == 'admin') {
            $user = User::where('email', $request->get('email'))->first();
        
            if (!$user) {
                return response()->json(['error_message' => 'User not found']);
            }
        
            if (Hash::check($request->get('password'), $user->password)) {
                $request->session()->put(['user_id' => $user->id,'user_type' => 'customer']);
                return response()->json(['success' => true, 'redirect' => route('dashboard')]);
            } else {
                return response()->json(['error_message' => 'Invalid password']);
            }
        }
        else
        {
            $customer = Customer::where('email', $request->get('email'))->first();
            if (!$customer) {
                return response()->json(['error_message' => 'User not found']);
            }
            if(!$customer->status){
                return response()->json(['error_message' => 'You are not approved']);
            }
            if (Hash::check($request->get('password'), $customer->password)) {
                $request->session()->put(['customer_id' => $customer->id,'user_type' => 'customer']);                
                return response()->json(['success' => true,'redirect' => route('home')]);
            } else {
                return response()->json(['error_message' => 'Invalid password']);
            }
        }
        
        return response()->json(['error_message' => 'Invalid user type']);
    }

    public function logout(Request $request){
        if($request->get('user_type') === 'customer')
            $request->session()->forget('customer_id');
        if($request->get('user_type') === 'admin') {
            $request->session()->forget('user_id');
        }
        return redirect()->route('login');
    }
}
