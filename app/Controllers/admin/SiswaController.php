<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SiswaModel;
use CodeIgniter\HTTP\ResponseInterface;

class SiswaController extends BaseController
{
    protected $siswaModel;

    public function __construct()
    {
        $this->siswaModel = new SiswaModel();
    }

    public function index()
    {
        $siswa = $this->siswaModel->orderBy('id', 'DESC')->findAll();

        $data = [
            'title' => 'Data Siswa',
            'siswa' => $siswa
        ];

        return view('admin/siswa', $data);
    }
}
