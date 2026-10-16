<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        return view('auth/login', [
            'pageTitle' => 'Login | ClientFlow CRM',
        ]);
    }


    public function authenticate()
    {
        $email = strtolower(trim($this->request->getPost('email') ?? ''));
        $password = $this->request->getPost('password') ?? '';

        if ($email === '' || $password === '') {
            return redirect()->to(site_url('login'))
                ->with('error', 'Please enter your email and password.');
        }

        $userModel = new \App\Models\UserModel();
        $user = $userModel->where('email', $email)->first();

        if (! $user || ! password_verify($password, $user['password'])) {
            return redirect()->to(site_url('login'))
                ->with('error', 'Invalid email or password.');
        }

        session()->regenerate();

        session()->set([
            'user_id'   => $user['id'],
            'user_name' => $user['name'],
            'user_email' => $user['email'],
            'user_role' => $user['role'],
            'isLoggedIn' => true,
        ]);

        return redirect()->to(site_url('dashboard'));
    }


    public function register()
    {
        return view('auth/register', [
            'pageTitle' => 'Create Account | ClientFlow CRM',
        ]);
    }

    public function store()
    {
        $rules = [
            'name' => 'required|min_length[2]|max_length[100]',
            'email' => 'required|valid_email|max_length[150]',
            'password' => 'required|min_length[8]',
            'confirm_password' => 'required|matches[password]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();

        $email = strtolower(trim($this->request->getPost('email')));

        if ($userModel->where('email', $email)->first()) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'This email is already registered.');
        }

        $userModel->insert([
            'name' => trim($this->request->getPost('name')),
            'email' => $email,
            'password' => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),
            'role' => 'user',
        ]);

        return redirect()->to(site_url('login'))
            ->with('success', 'Account created successfully. Please log in.');
    }


    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login')
            ->with('success', 'You have been logged out successfully.');
    }
}
