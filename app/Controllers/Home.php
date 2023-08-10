<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Desa',
        ];
        return view('landingpage/index', $data);
    }
}
