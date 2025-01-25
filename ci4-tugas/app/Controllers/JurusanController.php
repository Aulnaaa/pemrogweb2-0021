<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Files\File;
use App\Models\JurusanModel;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusanModel = new JurusanModel();
        $data = [
            'title' => 'Data Jurusan',
            'jurusan' => $jurusanModel->findAll(),
        ];

        return view('jurusan/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Jurusan',
        ];

        return view('jurusan/create', $data);
    }

    public function store()
    {
        $request = \Config\Services::request();
        $jurusanModel = new JurusanModel();
        $data = [
            'jurusan_id' => $request->getPost('jurusan_id'),
            'jurusan_nama' => $request->getPost('jurusan_nama'),
        ];

        $jurusanModel->save($data);

        return redirect()->to('/jurusan');
    }
}