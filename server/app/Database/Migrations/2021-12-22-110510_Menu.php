<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Menu extends Migration
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
                'constraint' => 200,
            ],
            'kategori_id' => [
                'type'      => 'INT',
                'unsigned'  => true,
            ],
            'harga' => [
                'type' => 'INT',
                'unsigned' => true
            ],
            'gambar' => [
                'type' => 'TEXT'
            ],
            'status' => [
                'type'  => 'ENUM',
                'constraint' => ['tersedia', 'habis']
            ],
            'created_at' => [
                'type'      => 'DATETIME',
            ],
            'updated_at' => [
                'type'      => 'DATETIME',
            ],
        ]);
        
        $this->forge->addKey('id', true); 
        $this->forge->addForeignKey('kategori_id','tbl_kategori_menu','id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tbl_menu');
       
    }

    public function down()
    {
        $this->forge->dropTable('tbl_menu');
    }
}
