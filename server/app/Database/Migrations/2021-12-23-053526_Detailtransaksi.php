<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Detailtransaksi extends Migration
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
            'id_transaksi' => [
                'type'          => 'INT',
                'unsigned'      => true
            ],
            'menu_id' => [
                'type'      => 'INT',
                'unsigned'  => true,
            ],
            'jumlah' => [
                'type'      => 'INT',
                'unsigned'  => true
            ],
            'created_at' => [
                'type'      => 'DATETIME',
            ],
            'updated_at' => [
                'type'      => 'DATETIME',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('menu_id','tbl_menu','id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_transaksi','tbl_transaksi','id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tbl_detail_transaksi');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_detail_transaksi');
    }
}
