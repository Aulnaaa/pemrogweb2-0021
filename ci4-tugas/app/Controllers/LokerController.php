<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\LokerModel;

class LokerController extends Controller
{
    public function index()
    {
        $lokerModel = new LokerModel();
        $data = $lokerModel->findAll();
        return view('loker/index', ['data' => $data]);
    }

    public function create()
    {
        
        return view('loker/create');
    }

    public function store()
    {
        $lokerModel = new LokerModel();
    
        // Konfigurasi upload
        $file = $this->request->getFile('loker_foto');

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('./JurusanImage', $newName);
    
            // Siapkan data untuk disimpan
            $data = [
                'loker_title' => $this->request->getPost('loker_title'),
                'loker_isi' => $this->request->getPost('loker_isi'),
                'loker_foto' => $newName, // Simpan nama file yang baru
                'loker_tgl' => $this->request->getPost('loker_tgl'),
                'loker_slug' => $this->request->getPost('loker_slug'),
                'loker_nm_per' => $this->request->getPost('loker_nm_per'),
                'id_akses' => $this->request->getPost('id_akses'), // Ambil id_akses dari sesi
                    // 'jurusan_id' => $jurusan_id, // Jika diperlukan
            ];
    
            // Simpan data ke database
            $lokerModel->insert($data);
            return redirect()->to('/loker');
        } else {
            // Jika upload gagal
            return redirect()->back()->with('error', 'Upload foto gagal: ' . $file->getErrorString());
        }
    }

    public function edit($id)
    {
        $lokerModel = new LokerModel();
        $data = $lokerModel->find($id);
        return view('loker/edit', ['data' => $data]);
    }

    public function update($id)
    {
        $lokerModel = new LokerModel();
        $id_akses = session()->get('id');
        $jurusan_id = session()->get('id');
        $data = [
            'loker_title' => $this->request->getPost('loker_title'),
            'loker_isi' => $this->request->getPost('loker_isi'),
            'loker_foto' => $this->request->getPost('loker_foto'),
            'loker_tgl' => $this->request->getPost('loker_tgl'),
            'loker_slug' => $this->request->getPost('loker_slug'),
            'loker_nm_per' => $this->request->getPost('loker_nm_per'),
            'id_akses' => $id_akses,
            'jurusan_id' => $jurusan_id,
        ];
        dd($data);
        $lokerModel->update($id, $data);
        return redirect()->to('/loker');
    }

    public function delete($id)
    {
        $lokerModel = new LokerModel();
        $lokerModel->delete($id);
        return redirect()->to('/loker');
    }
}
