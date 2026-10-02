<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class Customers extends BaseController
{
    public function index()
    {
        $customerModel = new CustomerModel();

        $data['customers'] = $customerModel->findAll();

        return view('customers', $data);
    }

    public function new()
    {
        return view('customers_new');
    }

    public function create()
    {
        $rules = [
            'full_name' => 'required',
            'email'     => 'required|valid_email',
            'phone'     => 'permit_empty'
        ];

        if (!$this->validate($rules)) {
            return view('customers_new', [
                'validation' => $this->validator
            ]);
        }

        $customerModel = new CustomerModel();

        $customerModel->insert([
            'full_name'  => $this->request->getPost('full_name'),
            'email'      => $this->request->getPost('email'),
            'phone'      => $this->request->getPost('phone'),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/customers');
    }
	public function edit($id)
{
    $customerModel = new CustomerModel();

    $customer = $customerModel->find($id);

    if (!$customer) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    return view('customers_edit', [
        'customer' => $customer
    ]);
}

public function update($id)
{
    $rules = [
        'full_name' => 'required',
        'email'     => 'required|valid_email',
        'phone'     => 'permit_empty'
    ];

    $customerModel = new CustomerModel();
    $customer = $customerModel->find($id);

    if (!$customer) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    if (!$this->validate($rules)) {
        return view('customers_edit', [
            'customer'   => $customer,
            'validation' => $this->validator
        ]);
    }

    $customerModel->update($id, [
        'full_name' => $this->request->getPost('full_name'),
        'email'     => $this->request->getPost('email'),
        'phone'     => $this->request->getPost('phone')
    ]);

    return redirect()->to('/customers');
}
	public function delete($id)
{
    $customerModel = new CustomerModel();

    $customer = $customerModel->find($id);

    if (!$customer) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    $customerModel->delete($id);

    return redirect()->to('/customers');
}
}