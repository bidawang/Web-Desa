<?php

namespace App\Models;

use CodeIgniter\Model;

class PengaturanModel extends Model
{
    protected $table = 'tb_pengaturan';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_desa', 'sejarah_desa', 'kalimat_ucapan', 'visi', 'misi', 'titik_koordinator', 'jumlah_rt', 'jumlah_penduduk', 'hari', 'waktu_bisnis', 'logo_desa', 'struktur_organisasi', 'img_potensi_wilayah'];
}
