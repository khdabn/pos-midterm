<?php

namespace App\Controllers;

use App\Models\SaleModel;
use App\Models\ProductModel;
use App\Models\CustomerModel;

class Sales extends BaseController
{
    public function new()
    {
        $productModel = new ProductModel();
        $customerModel = new CustomerModel();

        return view('sales_new', [
            'products'  => $productModel->findAll(),
            'customers' => $customerModel->findAll()
        ]);
    }

    public function create()
    {
        $rules = [
            'product_id' => 'required|integer',
            'quantity'   => 'required|integer|greater_than[0]'
        ];

        if (!$this->validate($rules)) {
            $productModel = new ProductModel();
            $customerModel = new CustomerModel();

            return view('sales_new', [
                'products'   => $productModel->findAll(),
                'customers'  => $customerModel->findAll(),
                'validation' => $this->validator
            ]);
        }

        $productModel = new ProductModel();
        $saleModel = new SaleModel();

        $productId = (int) $this->request->getPost('product_id');
        $quantity = (int) $this->request->getPost('quantity');

        $product = $productModel->find($productId);

        if (!$product) {
            return redirect()->to('/sales/new');
        }

        if ($quantity > (int) $product['stock_quantity']) {
            $customerModel = new CustomerModel();

            return view('sales_new', [
                'products'  => $productModel->findAll(),
                'customers' => $customerModel->findAll(),
                'saleError' => 'Not enough stock available.'
            ]);
        }

        $totalPrice = (float) $product['price'] * $quantity;

        $customerId = $this->request->getPost('customer_id');

        if (empty($customerId)) {
            $customerId = null;
        }

        $db = db_connect();
        $db->transStart();

        $saleModel->insert([
            'product_id'  => $productId,
            'customer_id' => $customerId,
            'sold_by'     => session()->get('user_id'),
            'quantity'    => $quantity,
            'total_price' => $totalPrice,
            'created_at'  => date('Y-m-d H:i:s')
        ]);

        $productModel->update($productId, [
            'stock_quantity' =>
                (int) $product['stock_quantity'] - $quantity
        ]);

        $db->transComplete();

        return redirect()->to('/sales');
    }
	public function index()
{
    $db = db_connect();

    $data['sales'] = $db->table('sales')
        ->select('
            sales.*,
            products.name AS product_name,
            customers.full_name AS customer_name,
            users.full_name AS staff_name
        ')
        ->join('products', 'products.id = sales.product_id')
        ->join('customers', 'customers.id = sales.customer_id', 'left')
        ->join('users', 'users.id = sales.sold_by')
        ->orderBy('sales.created_at', 'DESC')
        ->get()
        ->getResultArray();

    return view('sales', $data);
}
}