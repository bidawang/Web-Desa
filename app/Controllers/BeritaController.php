<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BeritaModel;
use App\Models\PengaturanModel;

class BeritaController extends BaseController
{
    protected $beritaModel;
    protected $pengaturanModel;

    public function __construct()
    {
        $this->beritaModel = new BeritaModel();
        $this->pengaturanModel = new PengaturanModel();
    }

    public function pageNews()
    {
        $berita = $this->beritaModel->findAll();
        $pengaturan = $this->pengaturanModel->first();
        $data = [
            'title' => 'Berita',
            'berita' => $berita,
            'pengaturan' => $pengaturan
        ];

        return view('landingpage/pagenews', $data);
    }

    public function index()
    {
        $berita = $this->beritaModel->findAll();
        $data = [
            'title' => 'Berita',
            'berita' => $berita
        ];

        return view('berita/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Berita',
            'validation' => \Config\Services::validation()
        ];

        return view('berita/tambah', $data);
    }

    public function save()
    {
        $validationRules = [
            'judul_berita' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Judul berita harus diisi.'
                ]
            ],
            'isi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi berita harus diisi.'
                ]
            ],
            'kategori_berita' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kategori berita harus diisi.'
                ]
            ],
            'foto' => [
                'rules' => 'uploaded[foto]|max_size[foto,2048]|is_image[foto]',
                'errors' => [
                    'uploaded' => 'Pilih file gambar untuk foto.',
                    'max_size' => 'Ukuran file gambar maksimal 2MB.',
                    'is_image' => 'File harus berupa gambar (jpg, jpeg, png, gif).'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $judulBerita = $this->request->getVar('judul_berita');
        $slug = url_title($judulBerita, '-', true);

        $data = [
            'slug' => $slug,
            'judul_berita' => $judulBerita,
            'isi' => $this->request->getVar('isi'),
            'kategori_berita' => $this->request->getVar('kategori_berita'),
            'foto' => $this->request->getFile('foto')->getName(),
        ];

        if ($this->beritaModel->insert($data)) {
            // Move uploaded file
            $this->request->getFile('foto')->move(ROOTPATH . 'public/uploads');

            session()->setFlashdata('success', 'Data Berita Berhasil ditambahkan!');
        } else {
            session()->setFlashdata('error', 'Gagal menambahkan data berita.');
        }

        return redirect()->to('/news');
    }

    public function edit($id)
    {
        $berita = $this->beritaModel->find($id);
        if (!$berita) {
            return redirect()->to('/news')->with('error', 'Berita not found.');
        }

        $data = [
            'title' => 'Edit Berita',
            'validation' => \Config\Services::validation(),
            'berita' => $berita
        ];

        return view('berita/edit', $data);
    }

    public function update($id)
    {
        $validationRules = [
            'judul_berita' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Judul berita harus diisi.'
                ]
            ],
            'isi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi berita harus diisi.'
                ]
            ],
            'kategori_berita' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kategori berita harus diisi.'
                ]
            ]
        ];

        // Check if a new photo is uploaded
        if ($this->request->getFile('foto')->isValid()) {
            $validationRules['foto'] = [
                'rules' => 'uploaded[foto]|max_size[foto,2048]|is_image[foto]',
                'errors' => [
                    'uploaded' => 'Pilih file gambar untuk foto.',
                    'max_size' => 'Ukuran file gambar maksimal 2MB.',
                    'is_image' => 'File harus berupa gambar (jpg, jpeg, png, gif).'
                ]
            ];
        }

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $berita = $this->beritaModel->find($id);
        if (!$berita) {
            return redirect()->to('/news')->with('error', 'Berita not found.');
        }

        $judulBerita = $this->request->getVar('judul_berita');
        $slug = url_title($judulBerita, '-', true);

        $data = [
            'slug' => $slug,
            'judul_berita' => $judulBerita,
            'isi' => $this->request->getVar('isi'),
            'kategori_berita' => $this->request->getVar('kategori_berita'),
        ];

        if ($this->request->getFile('foto')->isValid()) {
            $data['foto'] = $this->request->getFile('foto')->getName();
            // Move uploaded file
            $this->request->getFile('foto')->move(ROOTPATH . 'public/uploads');
        }

        if ($this->beritaModel->update($id, $data)) {
            session()->setFlashdata('success', 'Data Berita Berhasil diupdate!');
        } else {
            session()->setFlashdata('error', 'Gagal mengupdate data berita.');
        }

        return redirect()->to('/news');
    }

    public function delete($id)
    {
        $berita = $this->beritaModel->find($id);
        if (!$berita) {
            return redirect()->to('/news')->with('error', 'Berita not found.');
        }

        if ($this->beritaModel->delete($id)) {
            session()->setFlashdata('success', 'Data Berita Berhasil dihapus!');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus data berita.');
        }

        return redirect()->to('/news');
    }
}
