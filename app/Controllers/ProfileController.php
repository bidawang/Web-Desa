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
}
