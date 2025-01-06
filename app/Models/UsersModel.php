<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'tb_user';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'username', 'password'];
}
