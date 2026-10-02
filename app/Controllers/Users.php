<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();

        $data['users'] = $userModel->findAll();

        return view('users', $data);
    }

    public function new()
    {
        return view('users_new');
    }

    public function create()
    {
        $rules = [
            'username'  => 'required|is_unique[users.username]',
            'full_name' => 'required'
        ];

        if (!$this->validate($rules)) {
            return view('users_new', [
                'validation' => $this->validator
            ]);
        }

        $userModel = new UserModel();

        $userModel->insert([
            'username'   => $this->request->getPost('username'),
            'full_name'  => $this->request->getPost('full_name'),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/users');
    }
	public function edit($id)
{
    $userModel = new UserModel();

    $user = $userModel->find($id);

    if (!$user) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    return view('users_edit', [
        'user' => $user
    ]);
}

public function update($id)
{
    $userModel = new UserModel();
    $user = $userModel->find($id);

    if (!$user) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    $rules = [
        'username' => "required|is_unique[users.username,id,{$id}]",
        'full_name' => 'required',
        'avatar' => [
            'rules' => 'permit_empty|uploaded[avatar]|max_size[avatar,2048]|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png]',
            'errors' => [
                'max_size' => 'The avatar must not be larger than 2MB.',
                'is_image' => 'The uploaded file must be an image.',
                'mime_in'  => 'Only JPG and PNG images are allowed.'
            ]
        ]
    ];

    if (!$this->validate($rules)) {
        return view('users_edit', [
            'user' => $user,
            'validation' => $this->validator
        ]);
    }

    $data = [
        'username'  => $this->request->getPost('username'),
        'full_name' => $this->request->getPost('full_name')
    ];

    $avatar = $this->request->getFile('avatar');

    if ($avatar && $avatar->isValid() && !$avatar->hasMoved()) {

        $newName = $avatar->getRandomName();

        $avatar->move(
            FCPATH . 'uploads/avatars',
            $newName
        );

        $image = \Config\Services::image()
            ->withFile(FCPATH . 'uploads/avatars/' . $newName);

        $image->fit(300, 300, 'center')
              ->save(FCPATH . 'uploads/avatars/' . $newName);

        $data['avatar'] = $newName;
    }

    $userModel->update($id, $data);

    return redirect()->to('/users');
}
}