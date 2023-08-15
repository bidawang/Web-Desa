<?php

namespace App\Controllers;

use App\Models\BeritaModel;
use App\Models\FotoModel;
use App\Models\PengaturanModel;
use App\Models\VideoModel;

class Home extends BaseController
{
    protected $fotoModel;
    protected $beritaModel;
    protected $videoModel;
    protected $pengaturanModel;

    public function __construct()
    {
        $this->fotoModel = new FotoModel();
        $this->beritaModel = new BeritaModel();
        $this->videoModel = new VideoModel();
        $this->pengaturanModel = new PengaturanModel();
    }

    public function index(): string
    {

        $gallery = $this->fotoModel->getFoto();
        $berita = $this->beritaModel->findAll();
        $video = $this->videoModel->findAll();
        $pengaturan = $this->pengaturanModel->first();

        $data = [
            'title' => 'Desa',
            'gallery' => $gallery,
            'berita' => $berita,
            'video' => $video,
            'pengaturan' => $pengaturan
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
