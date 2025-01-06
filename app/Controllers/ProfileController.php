<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PengaturanModel;
use App\Models\LinkModel;
use App\Models\KontakModel;

class ProfileController extends BaseController
{
    protected $pengaturanModel;
    protected $linkModel;
    protected $kontakModel;

    public function __construct()
    {
        $this->pengaturanModel = new PengaturanModel();
        $this->linkModel = new LinkModel();
        $this->kontakModel = new KontakModel();
    }

    public function VillageHistory()
    {
        $pengaturan = $this->pengaturanModel->first();
        $link = $this->linkModel->getLink();
        $kontak = $this->kontakModel->first();
        $data = [
            'title' => 'Sejarah Desa',
            'pengaturan' => $pengaturan,
            'link' => $link,
            'kontak' => $kontak
        ];

        return view('landingpage/villagehistory', $data);
    }

    public function VisionMission()
    {
        $pengaturan = $this->pengaturanModel->first();
        $link = $this->linkModel->getLink();
        $kontak = $this->kontakModel->first();
        $data = [
            'title' => 'Visi dan Misi',
            'pengaturan' => $pengaturan,
            'link' => $link,
            'kontak' => $kontak
        ];

        return view('landingpage/visimisi', $data);
    }

    public function RegionalPotential()
    {
        $pengaturan = $this->pengaturanModel->first();
        $link = $this->linkModel->getLink();
        $kontak = $this->kontakModel->first();
        $data = [
            'title' => 'Potensi Wilayah',
            'pengaturan' => $pengaturan,
            'link' => $link,
            'kontak' => $kontak
        ];

        return view('landingpage/potensiwilayah', $data);
    }

    public function StructureOrganization()
    {
        $pengaturan = $this->pengaturanModel->first();
        $link = $this->linkModel->getLink();
        $kontak = $this->kontakModel->first();
        $data = [
            'title' => 'Struktur Organisasi',
            'pengaturan' => $pengaturan,
            'link' => $link,
            'kontak' => $kontak
        ];

        return view('landingpage/strukturorganisasi', $data);
    }
}


