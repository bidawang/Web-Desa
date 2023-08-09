<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class BeritaController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Berita',
        ];

        return view('berita/index', $data);
    }
}
