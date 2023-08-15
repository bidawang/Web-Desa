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

    public function page_gallery()
    {
        $gallery = $this->fotoModel->getFoto();

        $data = [
            'title' => 'Gallery Photo',
            'gallery' => $gallery
        ];

        return view('landingpage/page-gallery', $data);
    }

    public function carousel()
    {
       $gallery = $this->fotoModel->getCarousel();


        $data = [
            'title' => 'Carousel Photo',
            'gallery' => $gallery
        ];

        return view('landingpage/index', $data);
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
        $fotoModel = new FotoModel();

        // Ambil data foto berdasarkan ID
        $photo = $fotoModel->find($id); // Ganti dengan metode yang sesuai di model

        if ($photo) {
            // Jika foto ditemukan, ubah nilai atribut carousel menjadi 1
            $data = ['carousel' => 1];
            $fotoModel->update($id, $data);


            return redirect()->to(base_url('galleryphoto'))->with('success', 'Atribut carousel telah diubah.');
        } else {
            return redirect()->to(base_url('galleryphoto'))->with('error', 'Foto tidak ditemukan.');
        }
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
            ],
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());

        }

        $judulFoto = $this->request->getVar('judul_foto');
        $data = [
            'judul_foto' => $judulFoto,
            'nama_foto' => $this->request->getFile('nama_foto')->getName(),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'carousel' => 1,
        ];

        if ($this->fotoModel->insert($data)) {
            //pindah ke 
            $this->request->getFile('nama_foto')->move(ROOTPATH . 'public/uploads');
            session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        } else {
            session()->setFlashdata('errors', 'Data gagal ditambahkan');
        }

        return redirect()->to('/photo');
    }

    public function edit($id)
    {
        $gallery = $this->fotoModel->find($id);
        if (!$gallery) {
            return redirect()->to('/photo')->with('errors', 'Data tidak ditemukan');
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

        return redirect()->to('/photo');
    }

    public function delete($id)
    {
        $gallery = $this->fotoModel->find($id);
        if (!$gallery) {
            return redirect()->to('/photo')->with('errors', 'Data tidak ditemukan');
        }

        if ($this->fotoModel->delete($id)) {
            session()->setFlashdata('pesan', 'Data berhasil dihapus');
        } else {
            session()->setFlashdata('errors', 'Data gagal dihapus');
        }
        return redirect()->to('/photo');
    }




}