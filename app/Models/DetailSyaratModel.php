<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailSyaratModel extends Model
{
    protected $table            = 'tb_detail_syarat';
    protected $primaryKey       = 'id_detail_syarat';
        protected $allowedFields    = ['syarat'];

        protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

}
