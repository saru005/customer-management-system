<?php

namespace App\Http\Controllers;

use App\Models\Customer;
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
        
        $validator = Validator::make($request->all(), [
            'cust_name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|max:15',
            'state' => 'required',
            'district' => 'required',
            'gender' => 'required',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|string|same:password',
        ]);
        
        if ($validator->fails()) 
        {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $customer = $this->CustomerRepository->createCustomer($request->all());
        if($customer){
            return response()->json(['success' => true,'message' => 'sign up successfully'], 200);
        }
        
        return response()->json(['success' => false,'message' => 'Something went wrong'], 500);
    }

    public function approveCustomer($id)
    {
        $customer = $this->CustomerRepository->updateCustomerStatus($id,'1');
        return back()->with(['status'=>true,'message' => 'Customer Approved'], 200);
        
    }

    public function rejectCustomer($id)
    {
        $customer = $this->CustomerRepository->updateCustomerStatus($id,'0');
        return back()->with(['status'=>true,'message' => 'Customer Approved'], 200);  
    }

    public function editCustomerPage($id)
    {
        $customer = $this->CustomerRepository->getCustomerById($id);
        return view('admin.Customer_edit',compact('customer'));
    }
    
    public function edit(Request $request,$id){
        $validator = Validator::make($request->all(),[
            'cust_name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'state' => 'required',
            'district' => 'required',
            'gender' => 'required',
        ]);
        if ($validator->fails()) 
        {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $customer = $this->CustomerRepository->updateCustomer($request->all(),$id);
        if($customer){
            return response()->json(['success' => true, 'redirect' => route('dashboard'),'message' => 'Customer Updated Successfully']);
        }
    }
}
