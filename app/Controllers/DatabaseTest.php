<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;

class DatabaseTest extends Controller
{
    public function testConnection()
    {
        $db = Database::connect();
        if ($db->connID) {
            echo "✅ Database berhasil terhubung!";
        } else {
            echo "❌ Gagal terhubung ke database.";
        }
    }
}

// Gunakan ini untuk test di web
// http://localhost:8080/databasetest/testConnection
