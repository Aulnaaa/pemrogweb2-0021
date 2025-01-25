<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class Dashboard extends Controller
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
        return view('dashboard');
    }

    public function add_data()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
        return view('add_data');
    }

    public function save_data()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
        ];
        // Simpan data ke database
        return redirect()->to('/dashboard');
    }
}