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
            'full_name' => 'required',
            'password'  => 'required|min_length[6]',
            'avatar' => [
                'rules' => 'permit_empty|uploaded[avatar]|max_size[avatar,2048]|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png]'
            ]
        ];

        if (!$this->validate($rules)) {
            return view('users_new', [
                'validation' => $this->validator
            ]);
        }

        $data = [
            'username'   => $this->request->getPost('username'),
            'full_name'  => $this->request->getPost('full_name'),
            'password'   => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),
            'created_at' => date('Y-m-d H:i:s')
        ];

        $avatar = $this->request->getFile('avatar');

        if ($avatar && $avatar->isValid() && !$avatar->hasMoved()) {
            $newName = $avatar->getRandomName();

            $avatar->move(
                FCPATH . 'uploads/avatars',
                $newName
            );

            \Config\Services::image()
                ->withFile(FCPATH . 'uploads/avatars/' . $newName)
                ->fit(300, 300, 'center')
                ->save(FCPATH . 'uploads/avatars/' . $newName);

            $data['avatar'] = $newName;
        }

        $userModel = new UserModel();
        $userModel->insert($data);

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
            'username'  => "required|is_unique[users.username,id,{$id}]",
            'full_name' => 'required',
            'password'  => 'permit_empty|min_length[6]',
            'avatar' => [
                'rules' => 'permit_empty|uploaded[avatar]|max_size[avatar,2048]|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png]'
            ]
        ];

        if (!$this->validate($rules)) {
            return view('users_edit', [
                'user'       => $user,
                'validation' => $this->validator
            ]);
        }

        $data = [
            'username'  => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name')
        ];

        $password = $this->request->getPost('password');

        if (!empty($password)) {
            $data['password'] = password_hash(
                $password,
                PASSWORD_DEFAULT
            );
        }

        $avatar = $this->request->getFile('avatar');

        if ($avatar && $avatar->isValid() && !$avatar->hasMoved()) {
            $newName = $avatar->getRandomName();

            $avatar->move(
                FCPATH . 'uploads/avatars',
                $newName
            );

            \Config\Services::image()
                ->withFile(FCPATH . 'uploads/avatars/' . $newName)
                ->fit(300, 300, 'center')
                ->save(FCPATH . 'uploads/avatars/' . $newName);

            $data['avatar'] = $newName;
        }

        $userModel->update($id, $data);

        return redirect()->to('/users');
    }

    public function delete($id)
    {
        // Prevent the logged-in user from deleting their own account.
        if ((int) session()->get('user_id') === (int) $id) {
            return redirect()->to('/users');
        }

        $userModel = new UserModel();

        $user = $userModel->find($id);

        if (!$user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $userModel->delete($id);

        return redirect()->to('/users');
    }
}