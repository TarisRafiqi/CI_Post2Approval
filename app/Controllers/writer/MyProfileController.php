<?php

namespace App\Controllers\writer;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class MyProfileController extends BaseController
{
    protected $usersModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
    }

    public function index()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return view('errors/unauthorized');
        }

        $user = $this->usersModel->getUserById($userId);

        return view('writer/my_profile', ['user' => $user]);
    }

    public function updateUserDetail()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return view('errors/unauthorized');
        }

        // Validasi Input
        $validation = $this->validate([
            'username'  => 'required',
            'name'      => 'required|min_length[3]|max_length[100]',
            'email'     => 'required|valid_email',
        ]);

        if (!$validation) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors()) // Untuk error spesifik per field
                ->with('error', 'Make sure you have entered the data correctly.'); // Untuk notifikasi global
        }

        // Ambil data lama dari database
        $oldData = $this->usersModel->find($userId);

        // Ambil data dari form
        $newData = [
            'username'  => $this->request->getPost('username'),
            'name'      => $this->request->getPost('name'),
            'email'     => $this->request->getPost('email'),
        ];

        // Bandingkan data lama dan baru
        if (
            $oldData['username'] === $newData['username'] &&
            $oldData['name'] === $newData['name'] &&
            $oldData['email'] === $newData['email']
        ) {
            return redirect()->to('/writer/my_profile')->with('info', 'No data changes were made. Make sure you entered the new data before submit.');
        }

        // Jika ada perubahan, lakukan update
        $this->usersModel->update($userId, $newData);

        // Redirect ke halaman user detail dengan pesan sukses
        return redirect()->to('/writer/my_profile')->with('success', 'Data successfully updated.');
    }
}
