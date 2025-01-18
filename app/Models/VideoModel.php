<?php

namespace App\Models;

use CodeIgniter\Model;

class VideoModel extends Model
{
    protected $table = 'tb_video';
    protected $useTimestamps = true;
    protected $allowedFields = ['judul_video', 'link'];
}


