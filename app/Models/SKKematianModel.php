<?php

namespace App\Models;

use CodeIgniter\Model;

class SKKematianModel extends Model
{
    protected $table            = 'tb_surat_keterangan_kematian';
    protected $primaryKey       = 'id_sk_kematian';
    protected $allowedFields    = [
        'nik_kematian',
        'nomor_surat',
        'datetime_kematian',
        'lokasi_kematian',
        'penyebab_kematian',
        'nik_pengaju',
        'hubungan',
        'id_pelayanan',
        'status',
        ];

    protected $useTimestamps = false;

}
