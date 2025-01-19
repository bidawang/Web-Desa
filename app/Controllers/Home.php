<?php

namespace App\Controllers;

use App\Models\BeritaModel;
use App\Models\FotoModel;
use App\Models\LinkModel;
use App\Models\PengaturanModel;
use App\Models\VideoModel;
use App\Models\KontakModel;
use App\Models\PelayananModel;
use App\Models\ProdukModel;
use App\Models\PopulerModel;
use App\Models\SKDomisiliModel;
use App\Models\SKKelahiranModel;
use App\Models\SKKematianModel;
use App\Models\KkModel;

class Home extends BaseController
{
    protected $fotoModel;
    protected $beritaModel;
    protected $videoModel;
    protected $pengaturanModel;
    protected $linkModel;
    protected $kontakModel;
    protected $produkModel;
    protected $populerModel;
    protected $pelayananModel;
    protected $skkelahiranModel;
    protected $skkematianModel;
    protected $skdomisiliModel;
    protected $kkModel;

    public function __construct()
    {
        $this->fotoModel = new FotoModel();
        $this->beritaModel = new BeritaModel();
        $this->videoModel = new VideoModel();
        $this->pengaturanModel = new PengaturanModel();
        $this->linkModel = new LinkModel();
        $this->kontakModel = new KontakModel();
        $this->produkModel = new ProdukModel();
        $this->pelayananModel = new PelayananModel();
        $this->populerModel = new PopulerModel();
        $this->skdomisiliModel = new SKDomisiliModel();
        $this->skkelahiranModel = new SKKelahiranModel();
        $this->skkematianModel = new SKKematianModel();
        $this->kkModel = new KkModel();

    }

    // Pastikan model PopulerModel sudah di-load dengan benar
    public function index(): string
    {
        // Ambil data lainnya
        $gallery = $this->fotoModel->orderBy('created_at', 'DESC')->findAll(3);  // Ambil 4 foto terbaru
        $video = $this->videoModel->orderBy('created_at', 'DESC')->findAll(3);  // Ambil 4 video terbaru
        $pengaturan = $this->pengaturanModel->first();
        $link = $this->linkModel->getLink();
        $kontak = $this->kontakModel->first();
        $produk = $this->produkModel->orderBy('created_at', 'DESC')->findAll(6);  // Ambil 6 produk unggulan terbaru
        $pelayanan = $this->pelayananModel->findAll();
    
        // Mengambil 6 berita terpopuler berdasarkan klik menggunakan metode dari model PopulerModel
        $topBerita = $this->populerModel->getPopulerBerita(6); // Ambil 6 berita terpopuler
    
        // Siapkan data yang akan dikirim ke view
        $data = [
            'title' => 'Pemerintah Desa Bentok Darat',
            'gallery' => $gallery,  // 4 foto terbaru
            'berita' => $topBerita, // 6 berita berdasarkan klik terbanyak
            'video' => $video,      // 4 video terbaru
            'pengaturan' => $pengaturan,
            'link' => $link,
            'kontak' => $kontak,
            'produk' => $produk,    // 6 produk unggulan terbaru
            'pelayanan' => $pelayanan
        ];
    
        // Return tampilan (view)
        return view('landingpage/index', $data);
    }
    



    public function Dashboard(): string
    {

        $totalKK = $this->kkModel->countAllResults();
        $totalSKKelahiran = $this->skkelahiranModel->countAllResults();
        $totalSKKematian = $this->skkematianModel->countAllResults();
        $totalSKDomisili = $this->skdomisiliModel->countAllResults();

        $data = [
            'title' => 'Dashboard',
            'totalKK' => $totalKK,
            'totalSKKelahiran' => $totalSKKelahiran,
            'totalSKKematian' => $totalSKKematian,
            'totalSKDomisili' => $totalSKDomisili,
        ];

        return view('dashboard/index', $data);
    }
}
