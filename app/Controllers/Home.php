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

class Home extends BaseController
{
    protected $fotoModel;
    protected $beritaModel;
    protected $videoModel;
    protected $pengaturanModel;
    protected $linkModel;
    protected $kontakModel;
    protected $produkModel;

    protected $pelayananModel;

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
    }

    public function index(): string
    {

        $gallery = $this->fotoModel->getFoto();
        $berita = $this->beritaModel->findAll();
        $video = $this->videoModel->findAll();
        $pengaturan = $this->pengaturanModel->first();
        $link = $this->linkModel->getLink();
        $kontak = $this->kontakModel->first();
        $produk = $this->produkModel->findAll();
        $pelayanan = $this->pelayananModel->findAll();
        // dd($kontak[0]['deskripsi']);


        $data = [
            'title' => 'Pemerintah Desa Bentok Darat',
            'gallery' => $gallery,
            'berita' => $berita,
            'video' => $video,
            'pengaturan' => $pengaturan,
            'link' => $link,
            'kontak' => $kontak,
            'produk' => $produk,
            'pelayanan' => $pelayanan
        ];
        return view('landingpage/index', $data);
    }


    public function Dashboard(): string
    {
        $data = [
            'title' => 'Dashboard'
        ];
        return view('dashboard/index', $data);
    }
}
