<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KontakModel;
use App\Models\PengaturanModel;
use App\Models\LinkModel;

class KontakController extends BaseController
{

    protected $kontakModel;
    protected $pengaturanModel;
    protected $linkModel;

    public function __construct()
    {
        $this->kontakModel = new KontakModel();
        $this->pengaturanModel = new PengaturanModel();
        $this->linkModel = new LinkModel();
    }

    public function index()
    {
        $kontak = $this->kontakModel->findAll();
        $data = [
            'title' => 'Kontak',
            'kontak' => $kontak,
        ];
        return view('kontak/index', $data);
    }

    public function pageKontak()
    {

        $kontak = $this->kontakModel->first();
        $link = $this->linkModel->findAll();
        $pengaturan = $this->pengaturanModel->first();
        // dd($pengaturan);
        $data = [
            'title' => 'Kontak',
            'pengaturan' => $pengaturan, //mengambil data dari tabel pengaturan
            'kontak' => $kontak,
            'link' => $link//mengambil data dari tabel link
        ];

        return view('landingpage/pagekontak', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Kontak',
            'validation' => \Config\Services::validation()
        ];

        return view('kontak/tambah', $data);
    }

    public function save()
    {
        $validationRules = [
            'deskripsi_kontak' => 'required',
            'email' => 'required|valid_email',
            'no_telp' => 'required|numeric',
            'alamat' => 'required'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->to('/kontak/create')->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'deskripsi_kontak' => $this->request->getPost('deskripsi_kontak'),
            'email' => $this->request->getPost('email'),
            'no_telp' => $this->request->getPost('no_telp'),
            'alamat' => $this->request->getPost('alamat')
        ];

        $simpan = $this->kontakModel->save($data);

        if ($simpan) {
            session()->setFlashdata('success', 'Data berhasil ditambahkan');
            return redirect()->to('/kontak');
        } else {
            session()->setFlashdata('error', 'Data gagal ditambahkan');
            return redirect()->to('/kontak/create');
        }
    }

    public function edit($id)
    {
        $kontak = $this->kontakModel->find($id);
        $data = [
            'title' => 'Edit Kontak',
            'validation' => \Config\Services::validation(),
            'kontak' => $kontak
        ];

        return view('kontak/edit', $data);
    }

    public function update($id)
    {
        $validationRules = [
            'deskripsi_kontak' => 'required',
            'email' => 'required|valid_email',
            'no_telp' => 'required|numeric',
            'alamat' => 'required'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->to('/kontak/edit/' . $id)->withInput();
        }

       $deskripsi_kontak = $this->request->getPost('deskripsi_kontak');
        $email = $this->request->getPost('email');
        $no_telp = $this->request->getPost('no_telp');
        $alamat = $this->request->getPost('alamat');

       $data = [
           'deskripsi_kontak' => $deskripsi_kontak,
           'email' => $email,
           'no_telp' => $no_telp,
           'alamat' => $alamat
       ];

       $simpan = $this->kontakModel->update($id, $data);

         if ($simpan) {
              session()->setFlashdata('success', 'Data berhasil diubah');
              return redirect()->to('/kontak');
         } else {
              session()->setFlashdata('error', 'Data gagal diubah');
              return redirect()->to('/kontak/edit/' . $id);
         }
    }

    public function delete($id)
    {
        $hapus = $this->kontakModel->delete($id);

        if ($hapus) {
            session()->setFlashdata('success', 'Data berhasil dihapus');
            return redirect()->to('/kontak');
        } else {
            session()->setFlashdata('error', 'Data gagal dihapus');
            return redirect()->to('/kontak');
        }
    }
}
