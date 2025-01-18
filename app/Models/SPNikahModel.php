<?php

namespace App\Models;

use CodeIgniter\Model;

class SPNikahModel extends Model
{
    protected $table            = 'tb_surat_pengantar_nikah';
    protected $primaryKey       = 'id_spn';
    protected $allowedFields    = [
        'nomor_surat',
        'nik_pengaju',
        'nama_calon_pasangan',
        'status_pasangan',
        'nama_pasangan_terdahulu',
        'pasangan_ke',
        'id_pelayanan',
        'nik_pasangan',
        'nik_pasangan_terdahulu',
        ];
    protected $useTimestamps = false;
}
