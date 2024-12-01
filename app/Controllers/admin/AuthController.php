<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Login',
        ];

        return view('admin/login', $data);
    }

    public function auth()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // login

        $user = $this->adminModel->where('username', $username)->first();

        if ($user) {
            // cek password
            $pass = $user['password'];

            if ($pass == $password) {
                // set session
                $dataSession = [
                    'nama' => $user['nama'],
                    'isLogin' => true
                ];
                session()->set($dataSession);
                return redirect()->to('admin/soal');
            } else {
                return redirect()->to('/')->with('error', 'Username atau Password salah');
            }
        } else {
            return redirect()->to('/')->with('error', 'Username atau Password salah');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
