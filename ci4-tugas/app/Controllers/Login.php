<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AksesModel;

class Login extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function cek_login()
    {
        $aksesModel = new AksesModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Validasi inputan
        if (empty($username) || empty($password)) {
            session()->setFlashdata('error', 'Username dan password tidak boleh kosong!');
            return redirect()->to('/login');
        }

        $data = $aksesModel->where('username', $username)->first();

        if ($data) {
            if (password_verify($password, $data['password'])) {
                session()->set('logged_in', true);
                session()->set('username', $username);
                
                // Menyimpan id_akses ke dalam sesi
                session()->set('id', $data['id']); // Pastikan kolom ini ada di tabel akses

                return redirect()->to('/dashboard');
            } else {
                session()->setFlashdata('error', 'Password salah!');
                return redirect()->to('/login');
            }
        } else {
            session()->setFlashdata('error', 'Username tidak ditemukan!');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}