<?php

namespace App\Controllers;

use App\Models\FotoModel;
use App\Controllers\BaseController;

class GalleryPhotoController extends BaseController
{
    protected $fotoModel;

    public function __construct()
    {
        $this->fotoModel = new FotoModel();
    }

    public function index()
    {
        $gallery = $this->fotoModel->getFoto();

        $data = [
            'title' => 'Gallery Photo',
            'gallery' => $gallery
        ];

        return view('galleryphoto/index', $data);
    }

    public function detail($judul_foto)
    {
        $data = [
            'title' => 'Detail Photo',
            'gallery' => $this->fotoModel->getFoto($judul_foto)
        ];

        return view('galleryphoto/detail', $data);
    }

    //function untuk carousel merubah ke 1 
    public function active($id)
{
    $berhasil = $this->fotoModel->update([
        'id' => $id,
        'carousel' => 1
    ]);

    var_dump($berhasil);
    die; 

    if ($berhasil) {
        session()->setFlashdata('pesan', 'Data berhasil diubah');
    } else {
        session()->setFlashdata('errors', 'Gagal mengubah data');
    }

    return redirect()->to('/galleryphoto');
}



    public function create()
    {
        $data = [
            'title' => 'Add Photo',
            'validation' => \Config\Services::validation()
        ];
        return view('galleryphoto/create', $data);
    }

    public function save()
    {
        // validasi input
        $validationRules = [
            'judul_foto' => [
                'rules ' => 'required',
                'errors' => [
                    'required' => 'Judul Foto harus diisi',
                ]
            ],
            'nama_foto' => [
                'rules' => 'max_size[nama_foto,2048]|is_image[nama_foto]|mime_in[nama_foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran foto terlalu besar',
                    'is_image' => 'File yang diupload bukan foto',
                    'mime_in' => 'File yang diupload bukan foto'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi harus diisi'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());

        }

        $judulFoto = $this->request->getVar('judul_foto');
        $data = [
            'judul_foto' => $judulFoto,
            'nama_foto' => $this->request->getFile('nama_foto')->getName(),
            'deskripsi' => $this->request->getVar('deskripsi')
        ];

        if ($this->fotoModel->insert($data)) {
            //pindah ke 
            $this->request->getFile('nama_foto')->move(ROOTPATH . 'public/uploads');
            session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        } else {
            session()->setFlashdata('errors', 'Data gagal ditambahkan');
        }

        return redirect()->to('/galleryphoto');
    }

    public function edit($id)
    {
        $gallery = $this->fotoModel->find($id);
        if (!$gallery) {
            return redirect()->to('/galleryphoto')->with('errors', 'Data tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Photo',
            'validation' => \Config\Services::validation(),
            'gallery' => $gallery
        ];
        return view('galleryphoto/edit', $data);
    }

    public function update($id)
    {
        $validationRules = [
            'judul_foto' => [
                'rules ' => 'required',
                'errors' => [
                    'required' => 'Judul Foto harus diisi',
                ]
            ],
            'nama_foto' => [
                'rules' => 'max_size[nama_foto,2048]|is_image[nama_foto]|mime_in[nama_foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran foto terlalu besar',
                    'is_image' => 'File yang diupload bukan foto',
                    'mime_in' => 'File yang diupload bukan foto'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi harus diisi'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $judulFoto = $this->request->getVar('judul_foto');
        $data = [
            'judul_foto' => $judulFoto,
            'deskripsi' => $this->request->getVar('deskripsi')
        ];

        $file = $this->request->getFile('nama_foto');

        if ($file->isValid()) {
            $newFileName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads', $newFileName);
            $data['nama_foto'] = $newFileName;
        }

        // Lakukan pembaruan data
        if ($this->fotoModel->update($id, $data)) {
            session()->setFlashdata('pesan', 'Data berhasil diperbarui');
        } else {
            session()->setFlashdata('errors', 'Data gagal diperbarui');
        }

        return redirect()->to('/galleryphoto');
    }

    public function delete($id)
    {
        $gallery = $this->fotoModel->find($id);
        if (!$gallery) {
            return redirect()->to('/galleryphoto')->with('errors', 'Data tidak ditemukan');
        }

        if ($this->fotoModel->delete($id)) {
            session()->setFlashdata('pesan', 'Data berhasil dihapus');
        } else {
            session()->setFlashdata('errors', 'Data gagal dihapus');
        }
        return redirect()->to('/galleryphoto');
    }




}