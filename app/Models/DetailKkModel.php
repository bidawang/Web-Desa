<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailKkModel extends Model
{
    protected $table      = 'tb_detail_kk';
    protected $primaryKey = 'id_detail_kk';

    protected $allowedFields = [
        'no_paspor','no_kitas_kitap','nama_ayah','nama_ibu'
    ];

    protected $useTimestamps = false;
}
