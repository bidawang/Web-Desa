<?php

namespace App\Models;

use CodeIgniter\Model;

class AlamatModel extends Model
{
    protected $table      = 'tb_alamat';
    protected $primaryKey = 'id_alamat';

    protected $allowedFields = [
        'alamat_lengkap', 'rt','rw', 'kelurahan', 'kecamatan', 'kota', 'provinsi', 'kode_pos'
    ];

    // Timestamps if you have created_at and updated_at fields
    protected $useTimestamps = false;

    public function kk()
    {
        return $this->hasMany(KkModel::class, 'id_alamat', 'id_alamat');
    }
}
