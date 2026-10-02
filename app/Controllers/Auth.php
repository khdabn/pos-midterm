<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('login');
    }

    public function attemptLogin()
    {
        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            return view('login', [
                'validation' => $this->validator
            ]);
        }

        $userModel = new UserModel();

        $user = $userModel
            ->where('username', $this->request->getPost('username'))
            ->first();

        if (!$user || !password_verify(
            $this->request->getPost('password'),
            $user['password']
        )) {
            return view('login', [
                'loginError' => 'Invalid username or password.'
            ]);
        }

        session()->set([
            'user_id'   => $user['id'],
            'username'  => $user['username'],
            'full_name' => $user['full_name'],
            'logged_in' => true
        ]);

        return redirect()->to('/products');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }
}