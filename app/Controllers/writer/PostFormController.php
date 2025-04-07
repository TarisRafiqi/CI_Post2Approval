<?php

namespace App\Controllers\writer;

use App\Controllers\BaseController;
use App\Models\PostsModel;

class PostFormController extends BaseController
{
    protected $postsModel;

    public function __construct()
    {
        $this->postsModel = new PostsModel();
    }


    public function postForm()
    {
        return view('writer/post_form');
    }

    public function postFormAction()
    {
        $session = session();
        $userId = $session->get('user_id');
        // dd($userId);

        if (!$userId) {
            return view('errors/unauthorized');
        }

        $validationRules = [
            'title'  => 'required',
            'author' => 'required',
            'body'   => 'required',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', 'Validation Failed!');
        }

        // Ambil input
        $title = $this->request->getVar('title');
        $author = $this->request->getVar('author');
        $slug = url_title($title, '-', true); // Buat slug dari title
        $body = $this->request->getVar('body');
        $action = $this->request->getVar('action'); // Ambil nilai tombol yang diklik

        // Tentukan status post
        $postStatus = ($action === 'submit') ? 'Waiting Approval 1' : 'Draft';

        // Simpan ke database
        $this->postsModel->save([
            'user_id'    => $userId,
            'title'      => $title,
            'author'     => $author,
            'slug'       => $slug,
            'body'       => $body,
            'post_status' => $postStatus,
        ]);

        // Redirect dengan pesan sesuai aksi
        $message = ($postStatus === 'Waiting Approval 1') ? 'Post successfully submitted!' : 'Post successfully saved as draft!';

        // return redirect()->to('/writer/posts')->with('success', $message);
        return redirect()->to(base_url('/writer/post_form'))->with('success', $message);
    }
}
