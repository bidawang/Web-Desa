<?php

namespace App\Models;

use CodeIgniter\Model;

class PelayananModel extends Model
{
    protected $table            = 'tb_pelayanan';
    protected $primaryKey       = 'id_pelayanan';
    protected $allowedFields    = [
        'judul_pelayanan',
        'deskripsi_pelayanan'
    ];

    protected $useTimestamps = false;
    
}