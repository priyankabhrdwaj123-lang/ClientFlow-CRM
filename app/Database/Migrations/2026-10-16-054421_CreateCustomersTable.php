<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCustomersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'  => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' =>true,
            ],
            'name' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'email' =>[
                'type' => 'VARCHAR',
                'constraint' => 150,
                'unique' => true,
            ],
             'phone' =>[
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
            ],
             'company' =>[
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => true,
            ],
             'created_at' =>[
                'type' => 'DATETIME',
                'NULL' => true,
            ],
            
        ]);

        $this->forge->addkey('id',true);
        $this->forge->createTable('customers');
    }

    public function down()
    {
        $this->forge->dropTable('customers');
    }
}
