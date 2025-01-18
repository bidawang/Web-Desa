<?php

namespace App\Models;

use CodeIgniter\Model;

class KkModel extends Model
{
    protected $table      = 'tb_kk';
    protected $primaryKey = 'id_kk';

    protected $allowedFields = [
        'nomor_kk', 'nama_kepala_keluarga', 'id_alamat', 'tanggal_dibuat'
    ];

    protected $useTimestamps = false;

    // Relasi dengan tb_alamat
    public function alamat()
    {
        return $this->belongsTo(AlamatModel::class, 'id_alamat','id_alamat');
    }

    // Relasi dengan tb_anggota_keluarga
    public function anggotaKeluarga()
    {
        return $this->hasMany(AnggotaKkModel::class, 'nomor_kk');
    }
}
