<?php

namespace App\Models;

use CodeIgniter\Model;

class SKDomisiliModel extends Model
{
    protected $table            = 'tb_surat_keterangan_domisili';
    protected $primaryKey       = 'id_skd';
    protected $allowedFields    = ['nik_pengaju','keperluan', 'nomor_surat', 'id_pelayanan','id_anggota_keluarga','status'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $updatedField  = 'updated_at';
}
