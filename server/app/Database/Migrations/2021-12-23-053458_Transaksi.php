<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transaksi extends Migration
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
            'user_id' => [
                'type' => 'INT',
                'unsigned' => true
            ],
            'tunai' => [
                'type' => 'INT',
                'unsigned' => true
            ],
            'created_at' => [
                'type'      => 'DATETIME',
            ],
            'updated_at' => [
                'type'      => 'DATETIME',
            ],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id','tbl_user','id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tbl_transaksi');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_transaksi');
    }
}
