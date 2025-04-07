<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\PostsModel;
use App\Models\UsersModel;

class PostsController extends BaseController
{
    protected $postsModel, $usersModel;

    public function __construct()
    {
        $this->postsModel = new PostsModel();
        $this->usersModel = new UsersModel();
    }

    public function index()
    {
        // $postsModel = new PostModel(); 
        // $posts = $postsModel->findAll();
        $posts = $this->postsModel->findAll();

        foreach ($posts as &$post) {
            $oriStatus = $post['post_status']; // Simpan nilai asli sebelum diubah ke HTML
            $post['post_status'] = $this->mapStatus($oriStatus);
            $post['progress'] = $this->mapProgress($oriStatus); // Gunakan status asli untuk progress
        }

        $data = [
            'title' => 'Posts',
            'posts' => $posts
        ];

        return view('admin/posts', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Detail Post',
            'post' => $this->postsModel->where(['slug' => $slug])->first(),
            'selectedApprover1' => $this->postsModel->where('slug', $slug)->select('uid_approver_1')->first()['uid_approver_1'] ?? '',
            'selectedApprover2' => $this->postsModel->where('slug', $slug)->select('uid_approver_2')->first()['uid_approver_2'] ?? '',
            'approver1' => $this->usersModel->getApprovers1(),
            'approver2' => $this->usersModel->getApprovers2(),
        ];

        if (empty($data['post'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Post ' . $slug . ' not found.');
        }

        return view('admin/post', $data);
    }

    public function updateApprover($slug)
    {
        // Validasi input
        $approver_1 = (int) $this->request->getPost('approver_1');
        $approver_2 = (int) $this->request->getPost('approver_2');

        // Siapkan data yang akan diupdate
        $data = [];

        if (!empty($approver_1) && is_numeric($approver_1)) {
            $data['uid_approver_1'] = $approver_1;
        }
        if (!empty($approver_2) && is_numeric($approver_2)) {
            $data['uid_approver_2'] = $approver_2;
        }

        // Jika tidak ada data yang valid, kembalikan error
        if (empty($data)) {
            return redirect()->to(base_url('admin/posts/' . $slug))
                ->with('error', 'Failed to submit Approver. Please select a valid approver.');
        }

        $this->postsModel->where('slug', $slug)->set($data)->update();

        return redirect()->to(base_url('admin/posts/' . $slug))->with('success', 'Approver submit successfully.');
    }

    public function updateStatus($slug)
    {
        $status_1 = $this->request->getPost('status_1');
        $status_2 = $this->request->getPost('status_2');

        // Ambil data post berdasarkan slug
        $post = $this->postsModel->where('slug', $slug)->first();

        if (!$post) {
            return redirect()->to(base_url('admin/posts/' . $slug))->with('error', 'Post not found.');
        }

        // Logika perubahan status berdasarkan Approver 1
        if ($status_1 !== null && $post['post_status'] === 'Waiting Approval 1') {
            if ($status_1 === 'Approved') {
                $newStatus = 'Waiting Approval 2';
            } elseif ($status_1 === 'Need Revision') {
                $newStatus = 'Need Revision 1';
            }
            $this->postsModel->where('slug', $slug)->set([
                'post_status' => $newStatus,
                'status_1' => $status_1
            ])->update();
        }

        // Logika perubahan status berdasarkan Approver 2
        if ($status_2 !== null && $post['post_status'] === 'Waiting Approval 2') {
            if ($status_2 === 'Approved') {
                $newStatus = 'Published';
            } elseif ($status_2 === 'Need Revision') {
                $newStatus = 'Need Revision 2';
            } elseif ($status_2 === 'Rejected') {
                $newStatus = 'Rejected';
            }
            $this->postsModel->where('slug', $slug)->set([
                'post_status' => $newStatus,
                'status_2' => $status_2
            ])->update();
        }

        return redirect()->to(base_url('admin/posts/' . $slug))->with('success', 'Status updated successfully.');
    }

    private function mapStatus($status)
    {
        $statusMap = [
            'Draft'               => '<span class="tag is-light">Draft</span>',
            'Waiting Approval 1'  => '<span class="tag is-info is-light">Waiting for Approval</span>',
            'Need Revision 1'     => '<span class="tag is-warning is-light">Need Revision</span>',
            'Waiting Approval 2'  => '<span class="tag is-info is-light">Waiting for Approval</span>',
            'Need Revision 2'     => '<span class="tag is-warning is-light">Need Revision</span>',
            'Rejected'            => '<span class="tag is-danger is-light">Rejected</span>',
            'Published'           => '<span class="tag is-link is-light">Published</span>',
        ];

        return $statusMap[$status] ?? '';
    }

    private function mapProgress($status)
    {
        $progressMap = [
            'Draft'               => 25,
            'Waiting Approval 1'  => 50,
            'Need Revision 1'     => 50,
            'Waiting Approval 2'  => 75,
            'Need Revision 2'     => 75,
            'Rejected'            => 100,
            'Published'           => 100,
        ];

        return $progressMap[$status] ?? 0;
    }
}
