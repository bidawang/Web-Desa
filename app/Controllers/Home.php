<?php

namespace App\Controllers;

use App\Models\BeritaModel;
use App\Models\FotoModel;
use App\Models\LinkModel;
use App\Models\PengaturanModel;
use App\Models\VideoModel;
use App\Models\KontakModel;

class Home extends BaseController
{
    protected $fotoModel;
    protected $beritaModel;
    protected $videoModel;
    protected $pengaturanModel;
    protected $linkModel;
    protected $kontakModel;

    public function __construct()
    {
        $this->fotoModel = new FotoModel();
        $this->beritaModel = new BeritaModel();
        $this->videoModel = new VideoModel();
        $this->pengaturanModel = new PengaturanModel();
        $this->linkModel = new LinkModel();
        $this->kontakModel = new KontakModel();
    }

    public function index(): string
    {

        $gallery = $this->fotoModel->getFoto();
        $berita = $this->beritaModel->findAll();
        $video = $this->videoModel->findAll();
        $pengaturan = $this->pengaturanModel->first();
        $link = $this->linkModel->getLink();
        $kontak = $this->kontakModel->first();
        // dd($kontak[0]['deskripsi']);


        $data = [
            'title' => 'Desa',
            'gallery' => $gallery,
            'berita' => $berita,
            'video' => $video,
            'pengaturan' => $pengaturan,
            'link' => $link,
            'kontak' => $kontak
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
