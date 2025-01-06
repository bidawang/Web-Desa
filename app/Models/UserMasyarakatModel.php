<?php

namespace App\Models;

use CodeIgniter\Model;

class UserMasyarakatModel extends Model
{
    protected $table = 'tb_user_masyarakat'; // Nama tabel
    protected $primaryKey = 'id_user_masyarakat'; // Primary key tabel
    protected $allowedFields = [
        'username',
        'password',
        'no_hp',
        'email',
        'id_anggota_keluarga',
    ]; // Kolom yang diizinkan untuk operasi insert/update
    protected $useTimestamps = false; // Matikan timestamps jika tidak ada created_at/updated_at
}
