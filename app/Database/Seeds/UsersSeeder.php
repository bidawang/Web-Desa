<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama' => 'Udin',
                'username' => 'admin',
                'password' => password_hash('admin', PASSWORD_DEFAULT),
            ]
            ];

            $this->db->table('tb_user')->insertBatch($data);
    }
}
