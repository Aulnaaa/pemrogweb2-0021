<?php

namespace App\Controllers;

use App\Models\ProfileModel;
use App\Models\AksesModel;

class Profile extends BaseController
{
    protected $profileModel;

    public function __construct()
    {
        $this->profileModel = new ProfileModel();
    }

    public function index()
    {
        $data['profiles'] = $this->profileModel->findAll();
        return view('profile/index', $data);
    }

    public function create()
    {
        return view('profile/create');
    }

    public function store()
    {
        // Load model
        $aksesModel = new AksesModel();
        $profileModel = new ProfileModel();

        // Ambil id_akses dari sesi
        // $id_akses = session()->get('id'); // Pastikan Anda menyimpan id_akses di sesi saat login

        // Konfigurasi upload
        $file = $this->request->getFile('profil_foto');

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('./uploads', $newName);

            $data = [
                'profil_title' => $this->request->getPost('profil_title'),
                'profil_isi' => $this->request->getPost('profil_isi'),
                'profil_tgl' => $this->request->getPost('profil_tgl'),
                'profil_foto' => $newName,
                'id_akses' => $this->request->getPost('id_akses')// Tambahkan id_akses ke data
            ];

            // Simpan data ke database
            if ($profileModel->insert($data)) {
                return "Data berhasil disimpan!";
            } else {
                return "Gagal menyimpan data: " . implode(", ", $profileModel->errors());
            }
        } else {
            return "Upload gagal: " . $file->getErrorString();
        }
    }

    public function edit($id)
    {
        $data['profile'] = $this->profileModel->find($id);
        return view('profile/edit', $data);
    }

    public function update($id)
    {
        $this->profileModel->update($id, [
            'profi_title' => $this->request->getPost('profi_title'),
            'profil_tgl' => $this->request->getPost('profil_tgl'),
            'id_akses' => $this->request->getPost('id_akses'),
        ]);

        if ($this->request->getFile('profil_foto')->isValid()) {
            $this->request->getFile('profil_foto')->move('uploads');
        }

        return redirect()->to('/profile');
    }

    public function delete($id)
    {
        $this->profileModel->delete($id);
        return redirect()->to('/profile');
    }
}
