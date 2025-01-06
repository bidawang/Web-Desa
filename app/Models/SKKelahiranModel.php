<?php

namespace App\Models;

use CodeIgniter\Model;

class SKKelahiranModel extends Model
{
    protected $table            = 'tb_surat_keterangan_kelahiran';
    protected $primaryKey       = 'id_skk';
    protected $allowedFields    = [
        'datetime_kelahiran',
        'tempat_lahir_anak',
        'nik_pengaju',
        'kelamin_anak',
        'nama_anak',
        'nomor_surat',
        'anak_ke', //dari ibu
        'hubungan_dengan_bayi', //hubungan pelapor
        'id_pelayanan',
        'status',
        ];

    protected $useTimestamps = false;

}