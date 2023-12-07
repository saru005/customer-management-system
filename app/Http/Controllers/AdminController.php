<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CustomerRepositoryInterface;

class AdminController extends Controller
{
    protected $CustomerRepository;
    public function __construct(CustomerRepositoryInterface $CustomerRepository)
    {
        $this->CustomerRepository = $CustomerRepository;
    }
    public function index()
    {
        $customers = $this->CustomerRepository->getAllCustomer();
        return view('admin.index', compact('customers'));
    }
}
