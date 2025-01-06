<?php

namespace App\Models;

use CodeIgniter\Model;

class FotoModel extends Model
{
    protected $table = 'tb_foto';
    protected $useTimestamps = true;
    protected $allowedFields = ['judul_foto', 'nama_foto', 'deskripsi', 'carousel'];


    public function getFoto($judul_foto = false)
    {
        if ($judul_foto == false) {
            return $this->findAll();
        }
        return $this->where(['judul_foto' => $judul_foto])->first();

    }

    public function getCarousel()
    {
        return $this->where(['carousel' => 1])->findAll();
    }

    public function get_photo_by_id($id)
    {
        // Ambil data foto berdasarkan ID
        return $this->where('id', $id)->first();
    }

    public function update_photo($id, $data)
    {
        // Update data foto berdasarkan ID
        $this->where('id', $id)->set($data)->update();
    }

    public function setActiveCarousel($id)
    {
        $this->where('id', $id)
            ->set(['carousel' => 1])
            ->update();

    }





}