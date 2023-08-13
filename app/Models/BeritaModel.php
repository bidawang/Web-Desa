<?php

namespace App\Models;

use CodeIgniter\Model;

class BeritaModel extends Model
{
    protected $table = 'tb_berita';
    protected $useTimestamps = true;
    protected $allowedFields = ['slug', 'judul_berita', 'isi', 'kategori_berita', 'foto'];

    // public function getBeritaWithLimitedContent($limit = 100)
    // {
    //     // Mendapatkan helper 'text' dari CI
    //     helper('text');

    //     $beritas = $this->findAll();

    //     foreach ($beritas as &$berita) {
    //         $berita['isi'] = word_limiter($berita['isi'], $limit);
    //     }

    //     return $beritas;
    // }
}
