<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfileModel extends Model
{
    protected $table = 'profil'; // Ganti dengan nama tabel Anda
    protected $primaryKey = 'id'; // Ganti dengan primary key tabel Anda
    protected $allowedFields = ['profil_title', 'profil_isi', 'profil_tgl', 'profil_foto', 'id_akses']; // Sesuaikan dengan kolom yang ada di tabel Anda
}