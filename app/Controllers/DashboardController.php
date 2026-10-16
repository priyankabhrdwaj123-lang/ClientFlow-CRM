<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class DashboardController extends BaseController
{
    public function index()
    {


        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')
                ->with('error', 'Please login to access the dashboard.');
        }
        $customerModel = new CustomerModel();

        $data['totalCustomers'] = $customerModel->countAllResults();

        $data['recentCustomers'] = $customerModel
            ->orderBy('id', 'DESC')
            ->findAll(5);

        return view('dashboard', $data);
    }
}
