<?php

namespace App\Models;

use CodeIgniter\Model;

class SyaratModel extends Model
{
    protected $table            = 'tb_syarat';
    protected $primaryKey       = 'id_syarat';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['persyaratan','id_pelayanan'];

    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $updatedField  = 'updated_at';
    protected $createdField  = 'created_at';
    protected $deletedField  = 'deleted_at';

}
