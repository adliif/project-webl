<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kamar extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'      => 'INT',
                'constarint'=> 11,
                'unsigned'  => true,
                'auto_increment'    =>true,
            ],
            'nama_kamar'    =>[
                'type'      => 'VARCHAR',
                'constraint'=> '220',
            ],
            'type_kamar' => [
                'type'      => 'INT',
                'constarint'=> 11,
                'unsigned'  => true,
            ],
            'status'    =>[
                'type'      => 'INT',
                'constarint'=> 11,
                'unsigned'  => true,
            ],
            'harga'    =>[
                'type'      => 'INT',
                'constarint'=> 11,
                'unsigned'  => true,
            ],
            'created_at' => [
                'type'  => 'DATETIME',
                'null'  => true,
            ],
            'updated_at'=> [
                'type'  =>'DATETIME',
                'null'  => true,
            ],
            'deleted_at'=> [
                'type'  =>'DATETIME',
                'null'  => true,
            ],
        ]);

        $this->forge->addKey('id',true,true);
        $this->forge->addForeignKey('type_kamar','jeniskamar','id');
        $this->forge->addForeignKey('status','statuskamar','id');
        $this->forge->createTable('kamar');
    }

    public function down()
    {
        $this->forge->dropTable('kamar',true);
    }
}