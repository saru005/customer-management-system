<?php
namespace app\Repositories;

interface CustomerRepositoryInterface
{
    public function createCustomer($data);
    public function getAllCustomer();
    public function getCustomerById($id);
    public function updateCustomerStatus($id,$status);
    public function updateCustomer($data,$id);
}