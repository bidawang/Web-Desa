<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PengaturanModel;
use App\Models\LinkModel;

class ProfileController extends BaseController
{
    protected $pengaturanModel;
    protected $linkModel;

    public function __construct()
    {
        $this->pengaturanModel = new PengaturanModel();
        $this->linkModel = new LinkModel();
    }

    public function VillageHistory()
    {
        $pengaturan = $this->pengaturanModel->first();
        $link = $this->linkModel->getLink();
        $data = [
            'title' => 'Sejarah Desa',
            'pengaturan' => $pengaturan,
            'link' => $link
        ];

        return view('landingpage/villagehistory', $data);
    }

    public function VisionMission()
    {
        $pengaturan = $this->pengaturanModel->first();
        $link = $this->linkModel->getLink();
        $data = [
            'title' => 'Visi dan Misi',
            'pengaturan' => $pengaturan,
            'link' => $link
        ];

        return view('landingpage/visimisi', $data);
    }

    public function RegionalPotential()
    {
        $pengaturan = $this->pengaturanModel->first();
        $link = $this->linkModel->getLink();
        $data = [
            'title' => 'Potensi Wilayah',
            'pengaturan' => $pengaturan,
            'link' => $link
        ];

        return view('landingpage/potensiwilayah', $data);
    }
}
