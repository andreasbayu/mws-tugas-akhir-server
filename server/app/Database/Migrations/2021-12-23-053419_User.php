<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
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
            'username' => [
                'type'          => 'VARCHAR',
                'constraint'    => 30,
                'unique'        => true
            ],
            'password' => [
                'type'      => 'TEXT'
            ],
            'foto_profil' => [
                'type'      => 'TEXT'
            ],
            'role' => [
                'type'      => 'ENUM',
                'constraint'=> ['admin', 'karyawan']
            ],
            'created_at' => [
                'type'      => 'DATETIME',
            ],
            'updated_at' => [
                'type'      => 'DATETIME',
            ],
        ]);
        
        $this->forge->addKey('id', true); 
        $this->forge->createTable('tbl_user');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_user');
    }
}
