<?php

namespace App\Models;

use CodeIgniter\Model;

class PopulerModel extends Model
{
    protected $table = 'tb_populer';
    protected $useTimestamps = false;
    protected $allowedFields = ['id_berita','klik'];
    public function getPopulerBerita($limit = 4)
    {
        // Melakukan join tabel tb_populer dengan berita berdasarkan ID berita
        return $this->db->table('tb_populer')
                        ->join('tb_berita', 'tb_berita.id = tb_populer.id_berita') // Join dengan tabel berita
                        ->orderBy('tb_populer.klik', 'DESC') // Mengurutkan berdasarkan klik terbanyak
                        ->limit($limit) // Menampilkan hanya 4 berita terpopuler
                        ->get()
                        ->getResultArray(); // Mengambil hasilnya dalam bentuk array
    }

}
