<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BeritaModel;
use App\Models\PengaturanModel;
use App\Models\LinkModel;
use App\Models\KontakModel;
use App\Models\PopulerModel;
use CodeIgniter\Config\Services;

class BeritaController extends BaseController
{
    protected $beritaModel;
    protected $pengaturanModel;
    protected $linkModel;
    protected $kontakModel;

    protected $PopulerModel;


    public function __construct()
    {
        $this->beritaModel = new BeritaModel();
        $this->pengaturanModel = new PengaturanModel();
        $this->linkModel = new LinkModel();
        $this->kontakModel = new KontakModel();
        $this->PopulerModel = new PopulerModel();
    }

    // public function pageNews()
    // {
    //     $berita = $this->beritaModel->findAll();
    //     $pengaturan = $this->pengaturanModel->first();
    //     $link = $this->linkModel->getLink();
    //     $kontak = $this->kontakModel->first();
    //     $data = [
    //         'title' => 'Berita',
    //         'berita' => $berita,
    //         'pengaturan' => $pengaturan,
    //         'link' => $link,
    //         'kontak' => $kontak
    //     ];

    //     return view('landingpage/pagenews', $data);
    // }
    public function pageNews()
{
    $perPage = 4; // Jumlah berita per halaman
    $search = $this->request->getVar('search'); // Ambil keyword pencarian

    // Jika ada pencarian, filter berita berdasarkan judul
    if ($search) {
        $berita = $this->beritaModel
            ->like('judul_berita', $search)
            ->paginate($perPage, 'berita');
    } else {
        $berita = $this->beritaModel->paginate($perPage, 'berita'); // Tanpa filter
    }

    $pager = $this->beritaModel->pager; // Objek pager

    // Data tambahan
    $pengaturan = $this->pengaturanModel->first();
    $link = $this->linkModel->getLink();
    $kontak = $this->kontakModel->first();

    // Ambil data populer berita tanpa limit
    $PopulerModel = $this->PopulerModel->getPopulerBerita();

    // Data untuk view
    $data = [
        'title' => 'Berita',
        'berita' => $berita,
        'pager' => $pager,
        'pengaturan' => $pengaturan,
        'link' => $link,
        'kontak' => $kontak,
        'populerBerita' => $PopulerModel,
        'search' => $search, // Keyword pencarian
    ];

    return view('landingpage/pagenews', $data);
}

    


public function pageDetailNews($slug)
{
    $berita = $this->beritaModel->getBySlug($slug);
$pengaturan = $this->pengaturanModel->first();
$link = $this->linkModel->getLink();
$kontak = $this->kontakModel->first();
if ($berita) {
    // Tambahkan 1 ke jumlah klik di tabel populer
    $this->PopulerModel
        ->where('id_berita', $berita['id'])
        ->set('klik', 'klik + 1', false) // Increment nilai 'klik'
        ->update();
} else {
    // Handle jika berita tidak ditemukan
    throw new \CodeIgniter\Exceptions\PageNotFoundException('Berita tidak ditemukan.');
}



    $days = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
    $months = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

    $created_at = strtotime($berita['created_at']);
    $day_name = $days[date('w', $created_at)];
    $month_name = $months[date('n', $created_at)];

    $formatted_date = $day_name . ', ' . date('d', $created_at) . ' ' . $month_name . ' ' . date('Y H:i', $created_at);

    $data = [
        'title' => 'Berita ' . ucwords(strtolower($berita['judul_berita'])),
        'berita' => $berita,
        'pengaturan' => $pengaturan,
        'formatted_date' => $formatted_date,
        'link' => $link,
        'kontak' => $kontak
    ];

    return view('landingpage/detailpagenews', $data);
}




    public function index()
    {
        $berita = $this->beritaModel->findAll();
        
        $data = [
            'title' => 'Berita',
            'berita' => $berita,
            
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
    // public function save()
    // {
    //     $validationRules = [
    //         'judul_berita' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Judul berita harus diisi.'
    //             ]
    //         ],
    //         'isi' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Isi berita harus diisi.'
    //             ]
    //         ],
    //         'kategori_berita' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Kategori berita harus diisi.'
    //             ]
    //         ],
    //         'foto' => [
    //             'rules' => 'uploaded[foto]|max_size[foto,2048]|is_image[foto]',
    //             'errors' => [
    //                 'uploaded' => 'Pilih file gambar untuk foto.',
    //                 'max_size' => 'Ukuran file gambar maksimal 2MB.',
    //                 'is_image' => 'File harus berupa gambar (jpg, jpeg, png, gif).'
    //             ]
    //         ]
    //     ];

    //     if (!$this->validate($validationRules)) {
    //         return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    //     }

    //     $judulBerita = $this->request->getVar('judul_berita');
    //     $slug = url_title($judulBerita, '-', true);

    //     $image = $this->request->getFile('foto');

    //     // Check if an image was uploaded
    //     if ($image->isValid()) {
    //         $imagePath = ROOTPATH . '../public_html/uploads/';

    //         // Generate a unique file name
    //         $newName = $image->getRandomName();

    //         // Move the uploaded file
    //         $image->move($imagePath, $newName);

    //         // Perform image manipulation (e.g., resizing)
    //         $image = Services::image()
    //             ->withFile($imagePath . $newName)
    //             ->fit(600, 400) // Resize the image to your desired dimensions
    //             ->save($imagePath . $newName);

    //         $data = [
    //             'slug' => $slug,
    //             'judul_berita' => $judulBerita,
    //             'isi' => $this->request->getVar('isi'),
    //             'kategori_berita' => $this->request->getVar('kategori_berita'),
    //             'foto' => $newName, // Save the new image name
    //         ];
    //     } else {
    //         // Handle the case when no new image is uploaded
    //         $data = [
    //             'slug' => $slug,
    //             'judul_berita' => $judulBerita,
    //             'isi' => $this->request->getVar('isi'),
    //             'kategori_berita' => $this->request->getVar('kategori_berita'),
    //         ];
    //     }

    //     if ($this->beritaModel->insert($data)) {
    //         session()->setFlashdata('success', 'Data Berita Berhasil ditambahkan!');
    //     } else {
    //         session()->setFlashdata('error', 'Gagal menambahkan data berita.');
    //     }

    //     return redirect()->to('/news');
    // }

    public function save()
{
    // Validasi input
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

    // Cek validasi
    if (!$this->validate($validationRules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $judulBerita = $this->request->getVar('judul_berita');
    $slug = url_title($judulBerita, '-', true);

    $image = $this->request->getFile('foto');
    $imagePath = FCPATH . 'uploads/'; // Path upload gambar

    $data = [
        'slug' => $slug,
        'judul_berita' => $judulBerita,
        'isi' => $this->request->getVar('isi'),
        'kategori_berita' => $this->request->getVar('kategori_berita'),
    ];

    // Cek jika ada gambar yang diupload
    if ($image->isValid()) {
        // Generate nama file baru
        $newName = $image->getRandomName();

        // Pindahkan gambar ke folder uploads
        $image->move($imagePath, $newName);

        // Manipulasi gambar (resize)
        $image = Services::image()
            ->withFile($imagePath . $newName)
            ->fit(600, 400) // Ukuran gambar yang diinginkan
            ->save($imagePath . $newName);

        // Tambahkan nama gambar ke data
        $data['foto'] = $newName;
    }

    // Simpan data ke database
    if ($this->beritaModel->insert($data)) {
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

        // Check if a new photo is uploaded
        if ($this->request->getFile('foto')->isValid()) {
            $imagePath = ROOTPATH . '../public_html/uploads/';

            // Generate a unique file name
            $newName = $this->request->getFile('foto')->getRandomName();

            // Move the uploaded file
            $this->request->getFile('foto')->move($imagePath, $newName);

            // Perform image manipulation (e.g., resizing)
            $image = Services::image()
                ->withFile($imagePath . $newName)
                ->fit(600, 400) // Resize the image to your desired dimensions
                ->save($imagePath . $newName);

            $data['foto'] = $newName; // Save the new image name
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