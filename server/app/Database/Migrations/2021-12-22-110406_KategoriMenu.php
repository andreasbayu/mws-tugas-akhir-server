<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KategoriMenu extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'gambar' => [
                'type'      => 'TEXT'
            ],
            'created_at' => [
                'type'       => 'DATETIME',
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tbl_kategori_menu');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_kategori_menu');
    }
}
