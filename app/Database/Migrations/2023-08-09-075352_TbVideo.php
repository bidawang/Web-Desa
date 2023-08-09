<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbVideo extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'judul_video' => ['type' => 'VARCHAR', 'constraint' => 255],
            'link'        => ['type' => 'VARCHAR', 'constraint' => 255],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tb_video');
    }

    public function down()
    {
        $this->forge->dropTable('tb_video');
    }
}
