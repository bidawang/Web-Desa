<?php

namespace App\Controllers;

use App\Models\FotoModel;
class Home extends BaseController
{

    public function __construct()
    {
        $this->fotoModel = new FotoModel();
    }

    public function index(): string
    {

        $gallery = $this->fotoModel->getFoto();

        $data = [
            'title' => 'Desa',
            'gallery' => $gallery
        ];
        return view('landingpage/index', $data);
    }
}
