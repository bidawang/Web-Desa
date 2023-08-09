<?php

namespace App\Models;

use CodeIgniter\Model;

class FotoModel extends Model
{
    protected $table = 'tb_foto';
    protected $useTimestamps = true;
    protected $allowedFields = ['judul_foto', 'nama_foto', 'deskripsi'];
}
