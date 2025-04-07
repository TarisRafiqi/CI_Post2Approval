<?php

namespace App\Models;

use CodeIgniter\Model;

class PostsModel extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['user_id', 'title', 'author', 'body', 'slug', 'post_status', 'uid_approver_1', 'uid_approver_2', 'status_1', 'status_2',];
}
