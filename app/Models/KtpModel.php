<?php

namespace App\Models;

use CodeIgniter\Model;

class KtpModel extends Model
{
    protected $table      = 'tb_ktp';
    protected $primaryKey = 'id_ktp';

    protected $allowedFields = [
        'nik', 'id_alamat', 'nama_lengkap', 'id_kelahiran', 'jenis_kelamin', 'agama', 'status_perkawinan', 'pekerjaan', 'kewarganegaraan', 'masa_berlaku', 'golongan_darah'
    ];

    protected $useTimestamps = false;

    // Relasi dengan tb_alamat
    public function alamat()
    {
        return $this->belongsTo(AlamatModel::class, 'id_alamat');
    }

    // Relasi dengan tb_kelahiran
    public function kelahiran()
    {
        return $this->belongsTo(KelahiranModel::class, 'id_kelahiran');
    }

    // Relasi dengan tb_anggota_keluarga
    public function anggotaKeluarga()
    {
        return $this->belongsTo(AnggotaKeluargaModel::class, 'nik', 'nik');
    }
}
