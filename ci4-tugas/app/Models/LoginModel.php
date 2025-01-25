<?php 
namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table = 'akses'; // Ganti dengan nama tabel Anda
    protected $primaryKey = 'id'; // Ganti dengan primary key tabel Anda
    protected $allowedFields = ['username', 'password']; // Ganti dengan field yang diizinkan
}