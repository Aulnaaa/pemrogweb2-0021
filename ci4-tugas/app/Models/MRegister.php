<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Register extends Model
{
    protected $table = 'akses';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['nama', 'username', 'email', 'password', 'level', 'status'];

    public function insert($data)
    {
        return $this->db->table($this->table)->insert($data);
    }
}