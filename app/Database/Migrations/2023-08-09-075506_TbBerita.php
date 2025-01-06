<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbBerita extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'slug'          => ['type' => 'VARCHAR', 'constraint' => 255],
            'judul_berita'  => ['type' => 'VARCHAR', 'constraint' => 255],
            'isi'           => ['type' => 'TEXT'],
            'kategori_berita' => ['type' => 'VARCHAR', 'constraint' => 255],
            'foto'          => ['type' => 'VARCHAR', 'constraint' => 255],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tb_berita');
    }

    public function down()
    {
        $this->forge->dropTable('tb_berita');
    }
}
