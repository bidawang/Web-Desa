<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KontakModel;
use App\Models\LinkModel;
use App\Models\PengaturanModel;
use App\Models\ProdukModel;

class ProdukController extends BaseController
{
    protected $produkModel;
    protected $pengaturanModel;
    protected $linkModel;
    protected $kontakModel;

    public function __construct()
    {
        $this->produkModel = new ProdukModel();
        $this->linkModel = new LinkModel();
        $this->pengaturanModel = new PengaturanModel();
        $this->kontakModel = new KontakModel();
    }

    public function pageProduk()
    {
        $search = $this->request->getVar('search'); // Ambil keyword pencarian
        $perPage = 6; // Jumlah data per halaman
    
        if ($search) {
            // Jika ada pencarian
            $produk = $this->produkModel
                ->like('nama_produk', $search)
                ->paginate($perPage, 'produk');
        } else {
            // Jika tidak ada pencarian
            $produk = $this->produkModel->paginate($perPage, 'produk');
        }
    
        $pager = $this->produkModel->pager; // Objek pager untuk pagination
        $pengaturan = $this->pengaturanModel->first();
        $link = $this->linkModel->getLink();
        $kontak = $this->kontakModel->first();
    
        $data = [
            'title' => 'Produk',
            'produk' => $produk,
            'pager' => $pager,
            'pengaturan' => $pengaturan,
            'link' => $link,
            'kontak' => $kontak,
            'search' => $search, // Keyword pencarian
        ];
    
        return view('landingpage/pageproduk', $data);
    }
    

    public function pageDetailProduk($slug)
{
    $produk = $this->produkModel->getBySlug($slug);

        $pengaturan = $this->pengaturanModel->first();
        $link = $this->linkModel->getLink();
        $kontak = $this->kontakModel->first();

    $days = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
    $months = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

    $created_at = strtotime($produk['created_at']);
    $day_name = $days[date('w', $created_at)];
    $month_name = $months[date('n', $created_at)];

    $formatted_date = $day_name . ', ' . date('d', $created_at) . ' ' . $month_name . ' ' . date('Y H:i', $created_at);

    $data = [
        'title' => 'Produk ' . ucwords(strtolower($produk['nama_produk'])),
        'berita' => $produk,
        'pengaturan' => $pengaturan,
        'formatted_date' => $formatted_date,
        'link' => $link,
        'kontak' => $kontak
    ];

    return view('landingpage/detailpageproduk', $data);
}


    public function index()
    {
        $produk = $this->produkModel->findAll();

        $data = [
            'title' => 'Produk',
            'produk' => $produk,

        ];

        return view('produk/index', $data);
    }
    public function create()
    {
        $data = [
            'title' => 'Tambah Data Produk',
            'validation' => \Config\Services::validation()
        ];

        return view('produk/tambah', $data);
    }

    public function save()
    {
        $validationRules = [
            'foto' => [
                'rules' => 'uploaded[foto]|max_size[foto,2048]|is_image[foto]',
                'errors' => [
                    'uploaded' => 'Pilih file gambar untuk foto.',
                    'max_size' => 'Ukuran file gambar maksimal 2MB.',
                    'is_image' => 'File harus berupa gambar (jpg, jpeg, png, gif).'
                ]
            ],
            'nama_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Produk harus diisi.'
                ]
            ],
            'deskripsi' => [  // Corrected field name
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi harus diisi.'
                ]
            ],
            'pemilik_produk' => [  // Corrected field name
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pemilik harus diisi.'
                ]
            ],
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'foto' => $this->request->getFile('foto')->getName(),
            'nama_produk' => $this->request->getPost('nama_produk'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'pemilik_produk' => $this->request->getPost('pemilik_produk')
        ];

        // dd($data);

        if ($this->produkModel->insert($data)) {
            // Move uploaded file
            $this->request->getFile('foto')->move(ROOTPATH . '../public_html/uploads');

            session()->setFlashdata('success', 'Data Produk Berhasil ditambahkan!');
        } else {
            session()->setFlashdata('error', 'Gagal menambahkan data Produk.');
        }

        return redirect()->to('/produk');
    }

    public function edit($id)
    {
        $produk = $this->produkModel->find($id);
        if (!$produk) {
            return redirect()->to('/news')->with('error', 'Produk not found.');
        }

        $data = [
            'title' => 'Edit Berita',
            'validation' => \Config\Services::validation(),
            'produk' => $produk
        ];

        return view('produk/edit', $data);
    }

    public function update($id)
    {
        $validationRules = [
            'foto' => [
                'rules' => 'uploaded[foto]|max_size[foto,2048]|is_image[foto]',
                'errors' => [
                    'uploaded' => 'Pilih file gambar untuk foto.',
                    'max_size' => 'Ukuran file gambar maksimal 2MB.',
                    'is_image' => 'File harus berupa gambar (jpg, jpeg, png, gif).'
                ]
            ],
            'nama_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Produk harus diisi.'
                ]
            ],
            'deskripsi' => [  // Corrected field name
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi harus diisi.'
                ]
            ],
            'pemilik_produk' => [  // Corrected field name
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pemilik harus diisi.'
                ]
            ],
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

        $produk = $this->produkModel->find($id);
        if (!$produk) {
            return redirect()->to('/news')->with('error', 'Produk not found.');
        }

        $data = [
            'foto' => $this->request->getFile('foto')->getName(),
            'nama_produk' => $this->request->getPost('nama_produk'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'pemilik_produk' => $this->request->getPost('pemilik_produk')
        ];

        if ($this->request->getFile('foto')->isValid()) {
            $data['foto'] = $this->request->getFile('foto')->getName();
            // Move uploaded file
            $this->request->getFile('foto')->move(ROOTPATH . '../public_html/uploads');
        }

        if ($this->produkModel->update($id, $data)) {
            session()->setFlashdata('success', 'Data Produk Berhasil diupdate!');
        } else {
            session()->setFlashdata('error', 'Gagal mengupdate data Produk.');
        }

        return redirect()->to('/produk');
    }

    public function delete($id)
    {
        $produk = $this->produkModel->find($id);
        if (!$produk) {
            return redirect()->to('/produk')->with('error', 'Produk not found.');
        }

        if ($this->produkModel->delete($id)) {
            session()->setFlashdata('success', 'Data Produk Berhasil dihapus!');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus data Produk.');
        }

        return redirect()->to('/produk');
    }
}
