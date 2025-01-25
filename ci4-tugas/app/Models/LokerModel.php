<?php

namespace App\Models;

use CodeIgniter\Model;

class LokerModel extends Model
{
    protected $table = 'loker';
    protected $primaryKey = 'loker_id';
    protected $allowedFields = [
        'loker_title',
        'loker_isi',
        'loker_foto',
        'loker_tgl',
        'loker_slug',
        'loker_nm_per',
        'id_akses',
        'jurusan_id' => 'unsigned',
    ];
}
