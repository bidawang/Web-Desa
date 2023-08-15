<?php

namespace App\Models;

use CodeIgniter\Model;

class LinkModel extends Model
{
    protected $table         = 'tb_link';
    protected $useTimestamps = false;
    protected $allowedFields    = ['nama', 'link'];

    // query limit data
    public function getLink()
    {
        $builder = $this->table('tb_link');
        $builder->limit(5);
        return $builder->get()->getResultArray();
    }
}
