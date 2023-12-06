<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Repositories\CustomerRepositoryInterface;

class CustomerController extends Controller
{
    protected $CustomerRepository;
    public function __construct(CustomerRepositoryInterface $CustomerRepository)
    {
        $this->CustomerRepository = $CustomerRepository;
    }
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'cust_name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'state' => 'required',
            'district' => 'required',
            'gender' => 'required',
            'password' => 'required|string|confirmed',
        ]);
        if ($validator->fails()) 
        {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $this->CustomerRepository->createCustomer($request->all());
    }
}
