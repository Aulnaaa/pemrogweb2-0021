<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AlumniModel;

class Alumni extends Controller
{
    public function index()
    {
        $alumniModel = new AlumniModel();
        $data = [
            'title' => 'Data Alumni',
            'alumni' => $alumniModel->findAll(),
        ];

        return view('alumni/index', $data);
    }
    public function create()
{
    $data = [
        'title' => 'Tambah Alumni',
    ];

    return view('alumni/create', $data);
}

    public function edit($id)
    {
        $alumniModel = new AlumniModel();
        $data = [
            'title' => 'Edit Data Alumni',
            'alumni' => $alumniModel->find($id),
        ];

        return view('alumni/edit', $data);
    }
    public function store()
    {
        $request = \Config\Services::request();
        $alumniModel = new AlumniModel();
        $data = [
            'alumni_nama' => $request->getPost('alumni_nama'),
            'alumni_angkatan' => $request->getPost('alumni_angkatan'),
            'alumni_nohp' => $request->getPost('alumni_nohp'),
            'alumni_alamat' => $request->getPost('alumni_alamat'),
            'alumni_email' => $request->getPost('alumni_email'),
            'alumni_status' => $request->getPost('alumni_status'),
            'alumni_aktif' => $request->getPost('alumni_aktif'),
            'username' => $request->getPost('username'),
            'password' => $request->getPost('password'),
            'alumni_regis' => $request->getPost('alumni_regis'),
            'alumni_jk' => $request->getPost('alumni_jk'),
            'alumni_nis' => $request->getPost('alumni_nis'),
            'alumni_tempat_lahir' => $request->getPost('alumni_tempat_lahir'),
            'alumni_tgl_lahir' => $request->getPost('alumni_tgl_lahir'),
            'alumni_foto' => $request->getPost('alumni_foto'),
        ];

        if (!$this->validate($alumniModel->validationRules)) {
            return redirect()->to('/alumni/create')->withInput()->with('validation', $this->validator);
        }

        $alumniModel->save($data);

        return redirect()->to('/alumni');
    }

    public function update($id)
    {
        $request = \Config\Services::request();
        $alumniModel = new AlumniModel();
        $data = [
            'alumni_id' => $id,
            'alumni_nama' => $request->getPost('alumni_nama'),
            'alumni_angkatan' => $request->getPost('alumni_angkatan'),
            'alumni_nohp' => $request->getPost('alumni_nohp'),
            'alumni_alamat' => $request->getPost('alumni_alamat'),
            'alumni_email' => $request->getPost('alumni_email'),
            'alumni_status' => $request->getPost('alumni_status'),
            'alumni_aktif' => $request->getPost('alumni_aktif'),
            'username' => $request->getPost('username'),
            'password' => $request->getPost('password'),
            'alumni_regis' => $request->getPost('alumni_regis'),
            'alumni_jk' => $request->getPost('alumni_jk'),
            'alumni_nis' => $request->getPost('alumni_nis'),
            'alumni_tempat_lahir' => $request->getPost('alumni_tempat_lahir'),
            'alumni_tgl_lahir' => $request->getPost('alumni_tgl_lahir'),
            'alumni_foto' => $request->getPost('alumni_foto'),
        ];

        $alumniModel->save($data);

        return redirect()->to('/alumni');
    }

    public function delete($id)
    {
        $alumniModel = new AlumniModel();
        $alumniModel->delete($id);

        return redirect()->to('/alumni');
    }
}