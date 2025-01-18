<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbFoto extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'judul_foto' => ['type' => 'VARCHAR', 'constraint' => 255],
            'nama_foto' => ['type' => 'VARCHAR', 'constraint' => 255],
            'deskripsi' => ['type' => 'TEXT'],
            'carousel' => ['type' => 'VARCHAR', 'constraint' => 10, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tb_foto');
    }

    public function down()
    {
        $this->forge->dropTable('tb_foto');
    }
}