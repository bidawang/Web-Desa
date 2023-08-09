<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbPengaturan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'              => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'sejarah_desa'    => ['type' => 'TEXT'],
            'kalimat_ucapan'  => ['type' => 'TEXT'],
            'visi'            => ['type' => 'TEXT'],
            'misi'            => ['type' => 'TEXT'],
            'titik_koordinator' => ['type' => 'VARCHAR', 'constraint' => 255],
            'jumlah_rt'       => ['type' => 'INT', 'constraint' => 5],
            'jumlah_penduduk' => ['type' => 'INT', 'constraint' => 10],
            'created_at'      => ['type' => 'DATETIME', 'null' => true],
            'updated_at'      => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'      => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tb_pengaturan');
    }

    public function down()
    {
        $this->forge->dropTable('tb_pengaturan');
    }
}
