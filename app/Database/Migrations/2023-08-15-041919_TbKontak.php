<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbKontak extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'deskripsi'  => ['type' => 'TEXT', 'null' => true],
            'email'      => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'no_telp'    => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'alamat'     => ['type' => 'TEXT',  'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tb_kontak');
    }

    public function down()
    {
        $this->forge->dropTable('tb_kontak');
    }
}
