<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CustomerModel;

class CustomerController extends BaseController
{



    public function index()
    {
        $customerModel = new \App\Models\CustomerModel();

        $search = trim((string) $this->request->getGet('search'));
        $sort = (string) $this->request->getGet('sort');

        $allowedSorts = [
            'newest' => ['id', 'DESC'],
            'name'   => ['name', 'ASC'],
            'company' => ['company', 'ASC'],
        ];

        if (! array_key_exists($sort, $allowedSorts)) {
            $sort = 'newest';
        }

        if ($search !== '') {
            $customerModel
                ->groupStart()
                ->like('name', $search)
                ->orLike('email', $search)
                ->orLike('company', $search)
                ->orLike('phone', $search)
                ->groupEnd();
        }

        [$sortColumn, $sortDirection] = $allowedSorts[$sort];

        $data['customers'] = $customerModel
            ->orderBy($sortColumn, $sortDirection)
            ->paginate(10);

        $data['pager'] = $customerModel->pager;
        $data['search'] = $search;
        $data['sort'] = $sort;

        return view('customers/index', $data);
    }

    public function show($id)
    {
        $customerModel = new \App\Models\CustomerModel();

        $customer = $customerModel->find($id);

        if (! $customer) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Customer not found'
            );
        }

        return view('customers/show', [
            'customer' => $customer,
        ]);
    }


    public function create()
    {
        return view('customers/create', [
            'pageTitle' => 'Add Customer | ClientFlow CRM',
        ]);
    }

    public function store()
    {
        $rules = [
            'name' => 'required|min_length[2]|max_length[100]',
            'email' => 'required|valid_email|max_length[150]|is_unique[customers.email]',
            'phone' => 'permit_empty|max_length[20]',
            'company' => 'permit_empty|max_length[150]',
        ];

        $messages = [
            'name' => [
                'required'   => 'Customer name is required.',
                'min_length' => 'Name must contain at least 2 characters.',
                'max_length' => 'Name cannot exceed 100 characters.',
            ],
            'email' => [
                'required'    => 'Email address is required.',
                'valid_email' => 'Please enter a valid email address.',
                'max_length'  => 'Email cannot exceed 150 characters.',
                'is_unique'   => 'This email address already exists.',
            ],
        ];

        if (! $this->validate($rules, $messages)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $customerModel = new \App\Models\CustomerModel();

        $customerModel->save([
            'name'    => $this->request->getPost('name'),
            'email'   => $this->request->getPost('email'),
            'phone'   => $this->request->getPost('phone'),
            'company' => $this->request->getPost('company'),
        ]);

        return redirect()->to(site_url('customers'))
            ->with('success', 'Customer added successfully!');
    }


    public function edit($id)
    {
        $customerModel = new \App\Models\CustomerModel();

        $customer = $customerModel->find($id);

        if (! $customer) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Customer not found.'
            );
        }

        return view('customers/edit', [
            'customer'  => $customer,
            'pageTitle' => 'Edit Customer | ClientFlow CRM',
        ]);
    }

    public function update($id)
    {
        $customerModel = new \App\Models\CustomerModel();

        $customer = $customerModel->find($id);

        if (! $customer) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Customer not found.'
            );
        }

        $rules = [
            'name' => 'required|min_length[2]|max_length[100]',
            'email' => "required|valid_email|max_length[150]|is_unique[customers.email,id,{$id}]",
            'phone' => 'permit_empty|max_length[20]',
            'company' => 'permit_empty|max_length[150]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $customerModel->update($id, [
            'name'    => $this->request->getPost('name'),
            'email'   => $this->request->getPost('email'),
            'phone'   => $this->request->getPost('phone'),
            'company' => $this->request->getPost('company'),
        ]);

        return redirect()->to(site_url('customers'))
            ->with('success', 'Customer updated successfully!');
    }


    public function delete($id)
    {
        $customerModel = new \App\Models\CustomerModel();

        $customer = $customerModel->find($id);

        if (! $customer) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Customer not found.'
            );
        }

        $customerModel->delete($id);

        return redirect()->to(site_url('customers'))
            ->with('success', 'Customer deleted successfully!');
    }
}
