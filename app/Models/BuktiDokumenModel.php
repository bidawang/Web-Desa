<?php

namespace App\Models;

use CodeIgniter\Model;

class BuktiDokumenModel extends Model
{
    protected $table = 'tb_bukti_dokumen'; // Nama tabel
    protected $primaryKey = 'id_bukti_dokumen'; // Primary key tabel

    protected $allowedFields = [
        'id_persyaratan',
        'nik_pengaju',
        'nama_file',
        'jenis_dokumen'
    ];

    // Optional: Mengaktifkan fitur timestamps jika ingin otomatis mengelola waktu created_at dan updated_at
    protected $useTimestamps = false;

    public function saveBuktiDokumen(array $data)
    {
        return $this->insert($data);
    }
    public function getByNik($nik)
    {
        return $this->where('nik_pengaju', $nik)->findAll();
    }
}
