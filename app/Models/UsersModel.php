<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['username', 'password', 'name', 'email', 'role', 'is_active'];

    public function getAllUsers()
    {
        return $this->select('id, username, name, email, role')->findAll();
    }

    public function getUserById($id)
    {
        return $this->select('id, username, name, email, role')->where('id', $id)->first();
    }

    public function getApproversName($id)
    {
        return $this->select('name')->where('id', $id)->first();
    }

    public function getUserDetail($id)
    {
        return $this->select('id, username, name, email, role, is_active')->where('id', $id)->first();
    }

    public function getApprovers1()
    {
        return $this->select('id, name')
            ->where('role', 'approver')
            ->where('is_active', 1)
            ->findAll();
    }

    public function getApprovers2()
    {
        return $this->select('id, name')
            ->where('role', 'admin')
            ->where('is_active', 1)
            ->findAll();
    }
}
