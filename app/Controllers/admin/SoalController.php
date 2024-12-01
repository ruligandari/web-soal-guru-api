<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PengaturanModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SoalModel;

class SoalController extends BaseController
{
    protected $soalModel;
    protected $pengaturanModel;

    public function __construct()
    {
        $this->soalModel = new SoalModel();
        $this->pengaturanModel = new PengaturanModel();
    }
    public function index()
    {
        $soal = $this->soalModel->orderBy('id', 'ASC')->findAll();
        $jumlah_soal = $this->pengaturanModel->find('1');

        $data = [
            'title' => 'Data Soal',
            'soal' => $soal,
            'jumlah_soal' => $jumlah_soal['jumlah_soal']
        ];

        return view('admin/soal', $data);
    }

    public function store()
    {
        $data = [
            'soal' => $this->request->getPost('soal'),
            'pilihan_a' => $this->request->getPost('pilihan_a'),
            'pilihan_b' => $this->request->getPost('pilihan_b'),
            'pilihan_c' => $this->request->getPost('pilihan_c'),
            'pilihan_d' => $this->request->getPost('pilihan_d'),
            'jawaban' => $this->request->getPost('jawaban'),
            'bobot_nilai' => $this->request->getPost('bobot_nilai')
        ];

        $this->soalModel->insert($data);

        return redirect()->to('/admin/soal')->with('success', 'Data berhasil ditambahkan');
    }

    public function update($id)
    {

        $data = [
            'soal' => $this->request->getPost('soal'),
            'pilihan_a' => $this->request->getPost('pilihan_a'),
            'pilihan_b' => $this->request->getPost('pilihan_b'),
            'pilihan_c' => $this->request->getPost('pilihan_c'),
            'pilihan_d' => $this->request->getPost('pilihan_d'),
            'jawaban' => $this->request->getPost('jawaban'),
            'bobot_nilai' => $this->request->getPost('bobot_nilai')
        ];

        $this->soalModel->update($id, $data);

        return redirect()->to('/admin/soal')->with('success', 'Data berhasil diubah');
    }

    public function delete($id)
    {
        $this->soalModel->delete($id);

        return redirect()->to('/admin/soal')->with('success', 'Data berhasil dihapus');
    }

    public function pengaturan()
    {
        $id = "1";
        $jumlah_soal = $this->request->getPost('jumlah_soal');
        $data = [
            'jumlah_soal' => $jumlah_soal
        ];

        // update jumlah Soal
        $this->pengaturanModel->update($id, $data);
        return redirect()->to('/admin/soal')->with('success', 'Jumlah Soal Tampil Berhasil Disimpan');
    }
}
