<?php

namespace App\Controllers\approver;

use App\Controllers\BaseController;
use App\Models\PostsModel;
use App\Models\UsersModel;

class PostsApprovalController extends BaseController
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

        $posts = $this->postsModel->where('uid_approver_1', $userId)->findAll();

        foreach ($posts as &$post) {
            $oriStatus = $post['post_status'];
            $post['post_status'] = $this->mapStatus($oriStatus);
            $post['progress'] = $this->mapProgress($oriStatus);
        }

        $data = [
            'title' => 'Posts Approval',
            'posts' => $posts
        ];

        return view('approver/posts_approval', $data);
    }

    public function detail($slug)
    {
        $post = $this->postsModel->where(['slug' => $slug])->first();

        if (empty($post)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Post ' . $slug . ' not found.');
        }

        $approver1 = $this->usersModel->getApproversName($post['uid_approver_1']);
        $approver2 = $this->usersModel->getApproversName($post['uid_approver_2']);
        $post['status_2'] = $this->approverMapStatus($post['status_2']);

        $data = [
            'title' => 'Post Detail',
            'post' => $post,
            'approver1' => $approver1['name'] ?? 'Waiting for approval',
            'approver2' => $approver2['name'] ?? 'Waiting for approval',

        ];

        // dd($data);

        return view('approver/post_approval_detail', $data);
    }

    public function updateStatus($slug)
    {
        $status_1 = $this->request->getPost('status_1');

        // Ambil data post berdasarkan slug
        $post = $this->postsModel->where('slug', $slug)->first();

        if (!$post) {
            return redirect()->to(base_url('approver/post_approval_detail/' . $slug))->with('error', 'Post not found.');
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

        return redirect()->to(base_url('approver/post_approval_detail/' . $slug))->with('success', 'Status updated successfully.');
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
