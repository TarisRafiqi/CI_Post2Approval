<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UsersModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\RedirectResponse;

class AuthController extends BaseController
{
    protected $usersModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
    }

    public function unauthorized()
    {
        return view('errors/unauthorized');
    }

    public function registerForm()
    {
        return view('register');
    }

    public function registerSave()
    {
        // dd($this->request->getVar());
        $validationRules = [
            'name'     => 'required',
            'email'    => 'required|valid_email',
            'username' => [
                'rules'  => 'required|is_unique[users.username]',
                'errors' => [
                    'is_unique' => 'Username already taken, try using another username.'
                ]
            ],
            'password' => 'required'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->usersModel->save([
            'name'     => $this->request->getVar('name'),
            'email'    => $this->request->getVar('email'),
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
        ]);

        return redirect()->to('/login')->with('success', 'Registration successful! Please login.');
    }

    public function loginForm()
    {
        return view('login');
    }

    public function login()
    {
        $validationRules = [
            'username' => 'required',
            'password' => 'required'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $user = $this->usersModel->where('username', $username)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Invalid username or password.');
        }

        if ($user['is_active'] == 0) {
            return redirect()->back()->withInput()->with('error', 'your account has not been activated.');
        }

        $session = session();
        $session->set([
            'user_id'   => $user['id'],
            'username'  => $user['username'],
            'role'      => $user['role'],
            'logged_in' => true
        ]);

        switch ($user['role']) {
            case 'writer':
                return redirect()->to('/writer/posts')->with('success', 'Login successful!');
            case 'approver':
                return redirect()->to('/approver/posts')->with('success', 'Login successful!');
            case 'admin':
                return redirect()->to('/admin/posts')->with('success', 'Login successful!');
            default:
                return redirect()->to('/login')->with('success', 'Login failed!');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'You have been logged out.');
    }
}
