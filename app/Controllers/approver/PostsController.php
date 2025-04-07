<?php

namespace App\Controllers\approver;

use App\Controllers\BaseController;
use App\Models\PostsModel;
use App\Models\UsersModel;

class PostsController extends BaseController
{
    protected $postsModel;
    protected $usersModel;

    public function __construct()
    {
        $this->postsModel = new PostsModel();
        $this->usersModel = new UsersModel();
    }

    public function index()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return view('errors/unauthorized');
        }

        $posts = $this->postsModel->where('user_id', $userId)->findAll();

        foreach ($posts as &$post) {
            $oriStatus = $post['post_status'];
            $post['post_status'] = $this->mapStatus($oriStatus);
            $post['progress'] = $this->mapProgress($oriStatus);
        }

        $data = [
            'title' => 'My Post',
            'posts' => $posts
        ];

        return view('approver/posts', $data);
    }

    public function detail($slug)
    {
        $post = $this->postsModel->where(['slug' => $slug])->first();

        if (empty($post)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Post ' . $slug . ' not found.');
        }

        $post['status_1'] = $this->approverMapStatus($post['status_1']);
        $post['status_2'] = $this->approverMapStatus($post['status_2']);

        $approver1 = $this->usersModel->getApproversName($post['uid_approver_1']);
        $approver2 = $this->usersModel->getApproversName($post['uid_approver_2']);

        $data = [
            'title' => 'Detail Post',
            'post' => $post,
            'approver1' => $approver1['name'] ?? 'Waiting for approval',
            'approver2' => $approver2['name'] ?? 'Waiting for approval',
        ];

        return view('approver/post', $data);
    }

    public function submitRevision($slug)
    {
        // dd($this->request->getPost());

        // Validasi Input
        $validation = $this->validate([
            'title'  => 'required',
            'author' => 'required',
            'body'   => 'required',
        ]);

        if (!$validation) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors())
                ->with('error', 'Make sure you have entered the data correctly.');
        }

        // Ambil post berdasarkan slug
        $post = $this->postsModel->where('slug', $slug)->first();
        if (!$post) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Post not found.");
        }

        $postStatus = $post['post_status'];
        $status1 = $post['status_1'];
        $status2 = $post['status_2'];

        if ($post['post_status'] == 'Need Revision 1') {
            $postStatus = 'Waiting Approval 1';
            $status1 = null;
        } else if ($post['post_status'] == 'Need Revision 2') {
            $postStatus = 'Waiting Approval 2';
            $status2 = null;
        }

        // Data yang akan diupdate
        $data = [
            'title'         => $this->request->getPost('title'),
            'author'        => $this->request->getPost('author'),
            'body'          => $this->request->getPost('body'),
            'post_status'   => $postStatus,
            'status_1'      => $status1,
            'status_2'      => $status2,
        ];

        $this->postsModel->update($post['id'], $data);

        return redirect()->to('/approver/posts/' . $slug)->with('success', 'Data successfully updated.');
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

    private function approverMapStatus($status)
    {
        $statusMap = [
            '' => '<span class="tag is-light">Waiting for Status</span>',
            'Approved'            => '<span class="tag is-link is-light">Approved</span>',
            'Need Revision'       => '<span class="tag is-warning is-light">Need Revision</span>',
            'Rejected'            => '<span class="tag is-danger is-light">Rejected</span>',
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
