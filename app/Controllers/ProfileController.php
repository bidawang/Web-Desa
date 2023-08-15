<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PengaturanModel;

class ProfileController extends BaseController
{
    protected $pengaturanModel;

    public function __construct()
    {
        $this->pengaturanModel = new PengaturanModel();
    }

    public function VillageHistory()
    {
        $pengaturan = $this->pengaturanModel->first();
        $data = [
            'title' => 'Sejarah Desa',
            'pengaturan' => $pengaturan
        ];

        return view('landingpage/villagehistory', $data);
    }

    public function VisionMission()
    {
        $pengaturan = $this->pengaturanModel->first();
        $data = [
            'title' => 'Visi dan Misi',
            'pengaturan' => $pengaturan
        ];

        return view('landingpage/visimisi', $data);
    }

    public function RegionalPotential()
    {
        $pengaturan = $this->pengaturanModel->first();
        $data = [
            'title' => 'Potensi Wilayah',
            'pengaturan' => $pengaturan
        ];

        return view('landingpage/potensiwilayah', $data);
    }
}
