<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama' => 'Martadah',
                'username' => 'bentdart',
                'password' => password_hash('d3s4d1g', PASSWORD_DEFAULT),
            ]
            ];

            $this->db->table('tb_user')->insertBatch($data);
    }
}
