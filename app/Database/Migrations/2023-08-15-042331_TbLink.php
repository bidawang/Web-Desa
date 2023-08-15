<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbLink extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'   => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'nama' => ['type' => 'VARCHAR', 'constraint' => 100],
            'link' => ['type' => 'VARCHAR', 'constraint' => 255],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tb_link');
    }

    public function down()
    {
        $this->forge->dropTable('tb_link');
    }
}
