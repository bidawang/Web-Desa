<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KontakModel;
use App\Models\PengaturanModel;
use App\Models\VideoModel;
use App\Models\LinkModel;


class GaleriVideoController extends BaseController
{
    protected $videoModel;
    protected $pengaturanModel;
    protected $linkModel;
    protected $kontakModel;


    public function __construct()
    {
        $this->videoModel = new VideoModel;
        $this->pengaturanModel = new PengaturanModel();
        $this->linkModel = new LinkModel();
        $this->kontakModel = new KontakModel();
    }

    public function pageVideoGallery()
    {
        $video = $this->videoModel->findAll();
        $pengaturan = $this->pengaturanModel->first();
        $link = $this->linkModel->getLink();
        $kontak = $this->kontakModel->first();
        $data = [
            'title' => 'Galeri Video',
            'video' => $video,
            'pengaturan' => $pengaturan,
            'link' => $link,
            'kontak' => $kontak
        ];

        return view('landingpage/pagevideogallery', $data);
    }
    public function index()
    {
        
        $video = $this->videoModel->findAll();
        
        $data = [
            'title' => 'Galeri Video',
            'video' => $video,
            
        ];

        return view('videogaleri/index', $data);
    }

    // function tampil halaman tambah data video
    public function create()
    {
        $data = [
            'title' => 'Tambah Data Video',
            'validation' => \Config\Services::validation()
        ];

        return view('videogaleri/tambah', $data);
    }

    // function save data video
    public function save()
    {
        $validationRules = [

            'judul_video' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Judul Video Harus Diisi',
                ]
            ],
            'link' => [
                'rules' => 'required|valid_url_strict',
                'errors' => [
                    'required' => 'Kolom Link Harus Diisi',
                    'valid_url_strict' => 'Kolom Harus Diisi Dengan Link yang Berasal Dari youtube.com'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // ambil data dari form
        $judul_video = $this->request->getPost('judul_video');
        $link = $this->request->getPost('link');

        // membuat array collection yang disiapkan untuk insert ke table
        $data = [
            'judul_video' => $judul_video,
            'link' => $link,
        ];

        // insert ke table
        $simpan = $this->videoModel->insert($data);


        // cek jika proses simpan gagal
        if (!$simpan) {
            // redirect ke halaman create
            session()->setFlashdata('pesan', 'Data Gagal ditambahkan!');
            return redirect()->to('/video/create');
        }
        // jika berhasil
        else {
            // redirect ke halaman index
            session()->setFlashdata('pesan', 'Data Berhasil ditambahkan!');
            return redirect()->to('/video/gallery');
        }
    }

    // function edit data video
    public function edit($id)
    {

        $data = [
            'title' => 'Edit Data Video',
            'validation' => \Config\Services::validation(),
            'video' => $this->videoModel->find($id)
        ];

        return view('videogaleri/edit', $data);
    }

    // function update data video
    public function update($id)
    {
        $validationRules = [

            'judul_video' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Judul Video Harus Diisi',
                ]
            ],
            'link' => [
                'rules' => 'required|valid_url_strict',
                'errors' => [
                    'required' => 'Kolom Link Harus Diisi',
                    'valid_url_strict' => 'Kolom Harus Diisi Dengan Link yang Berasal Dari youtube.com'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // ambil data dari form
        $judul_video = $this->request->getPost('judul_video');
        $link = $this->request->getPost('link');

        // membuat array collection yang disiapkan untuk insert ke table
        $data = [
            'judul_video' => $judul_video,
            'link' => $link,
        ];

        // insert ke table
        $ubah = $this->videoModel->update($id, $data);


        // cek jika proses simpan gagal
        if (!$ubah) {
            // redirect ke halaman create
            session()->setFlashdata('pesan', 'Data Gagal diubah!');
            return redirect()->to('/edit-video-gallery');
        }
        // jika berhasil
        else {
            // redirect ke halaman index
            session()->setFlashdata('pesan', 'Data Berhasil diubah!');
            return redirect()->to('/video/gallery');
        }
    }

    // function delete data video
    public function delete($id)
    {
        // menghapus data
        $hapus = $this->videoModel->delete($id);

        // cek jika proses hapus gagal
        if (!$hapus) {
            // redirect ke halaman create
            session()->setFlashdata('pesan', 'Data Gagal dihapus!');
            return redirect()->to('/video/gallery');
        }
        // jika berhasil
        else {
            // redirect ke halaman index
            session()->setFlashdata('pesan', 'Data Berhasil dihapus!');
            return redirect()->to('/video/gallery');
        }
    }
}
