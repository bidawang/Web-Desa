<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PengaturanModel;

class PengaturanController extends BaseController
{
    protected $pengaturanModel;

    public function __construct()
    {
        $this->pengaturanModel = new PengaturanModel();
    }

    public function index()
    {
        $pengaturan = $this->pengaturanModel->first();
        // dd($pengaturan);
        $data = [
            'title' => 'Data Desa',
            'validation' => \Config\Services::validation(),
            'pengaturan' => $pengaturan
        ];

        return view('pengaturan/index', $data);
    }

    public function update()
    {
        $validationRules = [
            'nama_desa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Desa harus diisi.'
                ]
            ],
            'sejarah_desa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Sejarah Desa harus diisi.'
                ]
            ],
            'kalimat_ucapan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kalimat Ucapan harus diisi.'
                ]
            ],
            'visi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Visi harus diisi.'
                ]
            ],
            'misi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Misi harus diisi.'
                ]
            ],
            'titik_koordinator' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Titik Koordinat harus diisi.'
                ]
            ],
            'jumlah_rt' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Jumlah RT harus diisi.',
                    'numeric' => 'Jumlah RT harus berbentuk angka!.'
                ]
            ],
            'jumlah_penduduk' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Jumlah Penduduk harus diisi.',
                    'numeric' => 'Jumlah Penduduk harus berbentuk angka!.'
                ]
            ],
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama_desa' => $this->request->getVar('nama_desa'),
            'sejarah_desa' => $this->request->getVar('sejarah_desa'),
            'kalimat_ucapan' => $this->request->getVar('kalimat_ucapan'),
            'visi' => $this->request->getVar('visi'),
            'misi' => $this->request->getVar('misi'),
            'titik_koordinator' => $this->request->getVar('titik_koordinator'),
            'jumlah_rt' => $this->request->getVar('jumlah_rt'),
            'jumlah_penduduk' => $this->request->getVar('jumlah_penduduk'),
        ];

        if ($this->pengaturanModel->update(1, $data)) {
            return redirect()->to('/settings')->with('success', 'Data berhasil diperbarui!');
        } else {
            return redirect()->to('/settings')->with('error', 'Data gagal diperbarui.');
        }
    }
}
