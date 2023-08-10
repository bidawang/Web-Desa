<?php

namespace App\Models;

use CodeIgniter\Model;

class FotoModel extends Model
{
    protected $table = 'tb_foto';
    protected $useTimestamps = true;
    protected $allowedFields = ['judul_foto', 'nama_foto', 'deskripsi'];


    public function getFoto($judul_foto = false )
    {
        if ($judul_foto == false) {
            return $this->findAll();
        }
        return $this->where(['judul_foto' => $judul_foto])->first();
        
    }
    



}
