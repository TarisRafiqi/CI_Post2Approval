<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class UsersController extends BaseController
{
    protected $usersModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Users Info',
            'users' => $this->usersModel->getAllUsers(),
        ];

        return view('admin/users_info', $data);
    }

    public function detail($id)
    {
        $data = [
            'title' => 'User Detail Info',
            'user' => $this->usersModel->getUserDetail($id),
        ];

        return view('admin/user_detail_info', $data);
    }

    public function updateUserDetail($id)
    {
        // Validasi Input
        $validation = $this->validate([
            'username'  => 'required',
            'name'      => 'required|min_length[3]|max_length[100]',
            'email'     => 'required|valid_email',
            'role'      => 'required|in_list[approver,writer]',
            'is_active' => 'required|in_list[0,1]'
        ]);

        if (!$validation) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors()) // Untuk error spesifik per field
                ->with('error', 'Make sure you have entered the data correctly.'); // Untuk notifikasi global
        }

        // Data yang akan diupdate
        $data = [
            'username'  => $this->request->getPost('username'),
            'name'      => $this->request->getPost('name'),
            'email'     => $this->request->getPost('email'),
            'role'      => $this->request->getPost('role'),
            'is_active' => $this->request->getPost('is_active')
        ];

        // Update ke database
        $this->usersModel->update($id, $data);

        // Redirect ke halaman user detail dengan pesan sukses
        return redirect()->to('/admin/user_detail_info/' . $id)->with('success', 'Data successfully updated.');
    }
}
