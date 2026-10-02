<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Products extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();

        $data['products'] = $productModel->findAll();

        return view('products', $data);
    }

    public function new()
    {
        return view('products_new');
    }

    public function create()
    {
        $rules = [
            'name' => 'required',
            'price' => 'required|decimal',
            'stock_quantity' => 'required|integer',
            'image' => [
                'rules' => 'permit_empty|uploaded[image]|max_size[image,2048]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'The product image must not be larger than 2MB.',
                    'is_image' => 'The uploaded file must be an image.',
                    'mime_in' => 'Only JPG and PNG images are allowed.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return view('products_new', [
                'validation' => $this->validator
            ]);
        }

        $data = [
            'name'           => $this->request->getPost('name'),
            'price'          => $this->request->getPost('price'),
            'stock_quantity' => $this->request->getPost('stock_quantity'),
            'created_at'     => date('Y-m-d H:i:s')
        ];

        $image = $this->request->getFile('image');

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();

            $image->move(
                FCPATH . 'uploads/products',
                $newName
            );

            \Config\Services::image()
                ->withFile(FCPATH . 'uploads/products/' . $newName)
                ->fit(400, 400, 'center')
                ->save(FCPATH . 'uploads/products/' . $newName);

            $data['image'] = $newName;
        }

        $productModel = new ProductModel();
        $productModel->insert($data);

        return redirect()->to('/products');
    }
	public function edit($id)
{
    $productModel = new ProductModel();
    $product = $productModel->find($id);

    if (!$product) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    return view('products_edit', [
        'product' => $product
    ]);
}

public function update($id)
{
    $productModel = new ProductModel();
    $product = $productModel->find($id);

    if (!$product) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    $rules = [
        'name'           => 'required',
        'price'          => 'required|decimal',
        'stock_quantity' => 'required|integer',
        'image' => [
            'rules' => 'permit_empty|uploaded[image]|max_size[image,2048]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
            'errors' => [
                'max_size' => 'The product image must not be larger than 2MB.',
                'is_image' => 'The uploaded file must be an image.',
                'mime_in'  => 'Only JPG and PNG images are allowed.'
            ]
        ]
    ];

    if (!$this->validate($rules)) {
        return view('products_edit', [
            'product'    => $product,
            'validation' => $this->validator
        ]);
    }

    $data = [
        'name'           => $this->request->getPost('name'),
        'price'          => $this->request->getPost('price'),
        'stock_quantity' => $this->request->getPost('stock_quantity')
    ];

    $image = $this->request->getFile('image');

    if ($image && $image->isValid() && !$image->hasMoved()) {
        $newName = $image->getRandomName();

        $image->move(
            FCPATH . 'uploads/products',
            $newName
        );

        \Config\Services::image()
            ->withFile(FCPATH . 'uploads/products/' . $newName)
            ->fit(400, 400, 'center')
            ->save(FCPATH . 'uploads/products/' . $newName);

        $data['image'] = $newName;
    }

    $productModel->update($id, $data);

    return redirect()->to('/products');
}
public function delete($id)
{
    $productModel = new ProductModel();
    $product = $productModel->find($id);

    if (!$product) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    $productModel->delete($id);

    return redirect()->to('/products');
}
}