<?php
namespace app\Repositories;
use App\Repositories\CustomerRepositoryInterface;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function createCustomer($data)
    {
        dd($data);
    }
}