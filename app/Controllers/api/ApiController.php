<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\SiswaModel;
use App\Models\SoalModel;
use CodeIgniter\HTTP\ResponseInterface;

class ApiController extends BaseController
{
    protected $soalModel;
    protected $siswaModel;
    public function __construct()
    {
        $this->soalModel = new SoalModel();
        $this->siswaModel = new SiswaModel();
    }
    public function index()
    {
        $data = $this->soalModel->orderBy('id', 'DESC')->findAll();

        // return json
        return $this->response->setJSON($data);
    }
    public function readSoal()
    {
        $data = $this->soalModel->orderBy('id', 'DESC')->findAll();

        // return json
        return $this->response->setJSON($data);
    }

    public function readSoalById($id)

    {
        $data = $this->soalModel->find($id);
        if ($data) {
            // return json
            return $this->response->setJSON($data);
        }

        $data = [
            'message' => 'Data tidak ditemukan'
        ];
        // return json
        return $this->response->setJSON($data);
    }
    
    public function readSoalPost()
    {
        $id = $this->request->getPost('id');

        $data = $this->soalModel->find($id);
        // return json
        return $this->response->setJSON($data);
    }

    public function readNilai()
    {
        date_default_timezone_set('Asia/Jakarta');
        $nilai = $this->request->getPost('nilai');
        $nama_siswa = $this->request->getPost('nama_siswa');
        $waktu_pengerjaan = date('Y-m-d H:i:s');

        $data = [
            'nilai' => $nilai,
            'nama_siswa' => $nama_siswa,
            'waktu_pengerjaan' => $waktu_pengerjaan
        ];

        try {
            // insert ke table siswa
            $this->siswaModel->insert($data);

            $returnData =
                [
                    'success' => true,
                    'message' => 'Data berhasil disimpan'
                ];

            // return json
            return $this->response->setJSON($returnData);
        } catch (\Exception $e) {
            $returnData =
                [
                    'success' => false,
                    'message' => $e->getMessage()
                ];

            // return json
            return $this->response->setJSON($returnData);
        }
    }
}
