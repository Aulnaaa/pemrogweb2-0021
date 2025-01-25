<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AksesModel;

class Register extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function register()
    {
        $aksesModel = new AksesModel();
        $data = [
            'nama' => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'status' => 0,
            'level' => 0,
        ];

        if ($aksesModel->save($data)) {
            session()->setFlashdata('success', 'Register berhasil!');
            return redirect()->to('/login');
        } else {
            session()->setFlashdata('error', 'Register gagal!');
            return redirect()->to('/register');
        }
    }
}