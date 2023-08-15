<?php

namespace App\Models;

use CodeIgniter\Model;

class LinkModel extends Model
{
    protected $table            = 'tb_link';
    protected $useTimestamps = false;
    protected $allowedFields    = ['nama', 'link'];
}
