<?php

namespace App\Models;

use CodeIgniter\Model;

class KelahiranModel extends Model
{
    protected $table      = 'tb_kelahiran';
    protected $primaryKey = 'id_kelahiran';

    protected $allowedFields = [
        'tempat_lahir', 'tanggal_lahir'
    ];

    // Timestamps if you have created_at and updated_at fields
    protected $useTimestamps = false;
}
