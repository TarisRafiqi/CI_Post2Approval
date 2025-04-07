<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\PostsModel;
use App\Models\UsersModel;

class UpdateApproverController extends BaseController
{
    protected $postsModel, $usersModel;

    public function __construct()
    {
        $this->postsModel = new PostsModel();
        $this->usersModel = new UsersModel();
    }

    // public function updateApprover($postId)
    // {
    //     // Validasi input
    //     $approver_1 = $this->request->getPost('approver_1');

    //     // Update data di database
    //     $this->postsModel->update($postId, [
    //         'uid_approver_1' => $approver_1
    //     ]);

    //     // Redirect kembali ke halaman sebelumnya dengan pesan sukses
    //     return redirect()->to(base_url('admin/post/' . $postId))->with('success', 'Approver updated successfully.');
    // }
}
