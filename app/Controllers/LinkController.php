<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LinkModel;

class LinkController extends BaseController
{
    protected $linkModel;

    public function __construct()
    {
        $this->linkModel = new LinkModel();
    }

    public function index()
    {
        $link = $this->linkModel->findAll();
        $data = [
            'title' => 'Quick Link',
            'link' => $link,
        ];

        return view('link/index', $data);
    }

    // function tampil halaman tambah data quick link
    public function create()
    {
        $data = [
            'title' => 'Tambah Data Quick Link',
            'validation' => \Config\Services::validation()
        ];

        return view('link/tambah', $data);
    }

    // function save data quick link
    public function save()
    {
        $validationRules = [

            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Nama Harus Diisi',
                ]
            ],
            'link' => [
                'rules' => 'required|valid_url_strict',
                'errors' => [
                    'required' => 'Kolom Link Harus Diisi',
                    'valid_url_strict' => 'Kolom Harus Diisi Dengan Link yang Valid'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // ambil data dari form
        $nama = $this->request->getPost('nama');
        $link = $this->request->getPost('link');

        // membuat array collection yang disiapkan untuk insert ke table
        $data = [
            'nama' => $nama,
            'link' => $link,
        ];

        // insert ke table
        $simpan = $this->linkModel->insert($data);


        // cek jika proses simpan gagal
        if (!$simpan) {
            // redirect ke halaman create
            session()->setFlashdata('pesan', 'Data Gagal ditambahkan!');
            return redirect()->to('/link/edit');
        }
        // jika berhasil
        else {
            // redirect ke halaman index
            session()->setFlashdata('pesan', 'Data Berhasil ditambahkan!');
            return redirect()->to('/link');
        }
    }

    // function edit data quick link
    public function edit($id)
    {

        $data = [
            'title' => 'Edit Data Quick Link',
            'validation' => \Config\Services::validation(),
            'link' => $this->linkModel->find($id)
        ];

        return view('link/edit', $data);
    }

    // function update data quick link
    public function update($id)
    {
        $validationRules = [

            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Nama Harus Diisi',
                ]
            ],
            'link' => [
                'rules' => 'required|valid_url_strict',
                'errors' => [
                    'required' => 'Kolom Link Harus Diisi',
                    'valid_url_strict' => 'Kolom Harus Diisi Dengan Link yang Valid'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // ambil data dari form
        $nama = $this->request->getPost('nama');
        $link = $this->request->getPost('link');

        // membuat array collection yang disiapkan untuk insert ke table
        $data = [
            'nama' => $nama,
            'link' => $link,
        ];

        // insert ke table
        $ubah = $this->linkModel->update($id, $data);


        // cek jika proses simpan gagal
        if (!$ubah) {
            // redirect ke halaman create
            session()->setFlashdata('pesan', 'Data Gagal diubah!');
            return redirect()->to('/link');
        }
        // jika berhasil
        else {
            // redirect ke halaman index
            session()->setFlashdata('pesan', 'Data Berhasil diubah!');
            return redirect()->to('/link');
        }
    }

    // function delete data quick link
    public function delete($id)
    {
        // menghapus data
        $hapus = $this->linkModel->delete($id);

        // cek jika proses hapus gagal
        if (!$hapus) {
            // redirect ke halaman create
            session()->setFlashdata('pesan', 'Data Gagal dihapus!');
            return redirect()->to('/link');
        }
        // jika berhasil
        else {
            // redirect ke halaman index
            session()->setFlashdata('pesan', 'Data Berhasil dihapus!');
            return redirect()->to('/link');
        }
    }
}
