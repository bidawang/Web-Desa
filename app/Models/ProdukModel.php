<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table         = 'tb_produk';
    protected $useTimestamps = true;
    protected $allowedFields    = ['foto', 'nama_produk', 'deskripsi', 'pemilik_produk','created_at'];

    public function getBySlug($slug)
    {
        return $this->where('nama_produk', $slug)->first();
    }
}
