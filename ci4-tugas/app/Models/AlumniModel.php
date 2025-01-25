<?php
namespace App\Models;

use CodeIgniter\Model;

class AlumniModel extends Model
{
    protected $table = 'alumni';
    protected $primaryKey = 'alumni_id';
    protected $allowedFields = [
        'alumni_id',
        'alumni_nama',
        'alumni_angkatan',
        'alumni_nohp',
        'alumni_alamat',
        'alumni_email',
        'alumni_status',
        'alumni_aktif',
        'username',
        'password',
        'alumni_regis',
        'alumni_jk',
        'alumni_nis',
        'alumni_tempat_lahir',
        'alumni_tgl_lahir',
        'alumni_foto',
    ];

    protected $returnType = 'array';
    protected $useAutoIncrement = true;
    protected $useSoftDeletes = false;

    protected $validationRules = [
        'alumni_nama' => 'required',
        'alumni_angkatan' => 'required',
        'alumni_nohp' => 'required',
        'alumni_alamat' => 'required',
        'alumni_email' => 'required|valid_email',
        'alumni_status' => 'required',
        'alumni_aktif' => 'required',
        'username' => 'required',
        'password' => 'required',
        'alumni_regis' => 'required',
        'alumni_jk' => 'required',
        'alumni_nis' => 'required',
        'alumni_tempat_lahir' => 'required',
        'alumni_tgl_lahir' => 'required',
        'alumni_foto' => 'required',
    ];

    protected $validationMessages = [
        'alumni_nama' => [
            'required' => 'Nama alumni harus diisi.',
        ],
        'alumni_angkatan' => [
            'required' => 'Angkatan alumni harus diisi.',
        ],
        'alumni_nohp' => [
            'required' => 'No HP alumni harus diisi.',
        ],
        'alumni_alamat' => [
            'required' => 'Alamat alumni harus diisi.',
        ],
        'alumni_email' => [
            'required' => 'Email alumni harus diisi.',
            'valid_email' => 'Email alumni harus valid.',
        ],
        'alumni_status' => [
            'required' => 'Status alumni harus diisi.',
        ],
        'alumni_aktif' => [
            'required' => 'Aktif alumni harus diisi.',
        ],
        'username' => [
            'required' => 'Username alumni harus diisi.',
        ],
        'password' => [
            'required' => 'Password alumni harus diisi.',
        ],
        'alumni_regis' => [
            'required' => 'Regis alumni harus diisi.',
        ],
        'alumni_jk' => [
            'required' => 'Jenis kelamin alumni harus diisi.',
        ],
        'alumni_nis' => [
            'required' => 'NIS alumni harus diisi.',
        ],
        'alumni_tempat_lahir' => [
            'required' => 'Tempat lahir alumni harus diisi.',
        ],
        'alumni_tgl_lahir' => [
            'required' => 'Tanggal lahir alumni harus diisi.',
        ],
        'alumni_foto' => [
            'required' => 'Foto alumni harus diisi.',
        ],
    ];
}