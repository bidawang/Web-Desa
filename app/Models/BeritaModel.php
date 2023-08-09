<?php

namespace App\Models;

use CodeIgniter\Model;

class BeritaModel extends Model
{
    protected $table = 'tb_berita';
    protected $useTimestamps = true;
    protected $allowedFields = ['slug', 'judul_berita', 'isi', 'kategori_berita', 'foto'];
}
