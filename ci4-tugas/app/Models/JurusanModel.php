<?php

namespace App\Models;

use CodeIgniter\Model;

class JurusanModel extends Model
{
    protected $table = 'jurusan';
    protected $primaryKey = 'jurusan_id';
    protected $allowedFields = ['jurusan_nama'];
}