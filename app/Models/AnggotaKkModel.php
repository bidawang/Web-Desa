<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggotaKkModel extends Model
{
    protected $table      = 'tb_anggota_keluarga';
    protected $primaryKey = 'id_anggota';

    protected $allowedFields = [
        'id_kk', 
        'nama_lengkap', 
        'nik', 
        'id_kelahiran', 
        'jenis_kelamin',
        'pendidikan',
        'agama', 
        'pekerjaan',
        'hubungan_keluarga', 
        'status_perkawinan', 
        'kewarganegaraan', 
        'id_detail_kk',
    ];

    protected $useTimestamps = false;

    // Relasi dengan tb_kk
    public function kk()
    {
        return $this->belongsTo(KkModel::class, 'id_kk');
    }

    // Relasi dengan tb_kelahiran
    public function kelahiran()
    {
        return $this->belongsTo(KelahiranModel::class, 'id_kelahiran');
    }
    public function detailkk()
    {
        return $this->belongsTo(DetailKkModel::class, 'id_detail_kk');
    }
}
