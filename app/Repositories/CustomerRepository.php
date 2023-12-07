<?php
namespace app\Repositories;
use App\Repositories\CustomerRepositoryInterface;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function createCustomer($data)
    {
        $createData = [
            'name' => @$data['cust_name'],
            'email' => @$data['email'],
            'mobile' => @$data['mobile'],
            'state' => @$data['state'],
            'district' => @$data['district'],
            'gender' => @$data['gender'],
            'password' => @Hash::make($data['password']),
        ];
        // dd($createData);
        return Customer::create($createData);
    }

    public function getAllCustomer()
    {
        return Customer::all();
    }

    public function getCustomerById($id){
        return Customer::find($id);
    }

    public function updateCustomerStatus($id,$status)
    {
        $customer = Customer::find($id);
        $customer->status = $status;
        return $customer->save();
    }

    public function updateCustomer($data,$id)
    {
        $customer = Customer::find($id);
        $customer->name = @$data['cust_name'];
        $customer->email = @$data['email'];
        $customer->mobile = @$data['mobile'];
        $customer->state = @$data['state'];
        $customer->district = @$data['district'];
        $customer->gender = @$data['gender'];
        return $customer->save();
    }
}