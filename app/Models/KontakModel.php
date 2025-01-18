<?php

namespace App\Models;

use CodeIgniter\Model;

class KontakModel extends Model
{
    protected $table           = 'tb_kontak';
    protected $useTimestamps = true;
    protected $allowedFields = ['deskripsi_kontak', 'email', 'no_telp', 'alamat'];
 
}
