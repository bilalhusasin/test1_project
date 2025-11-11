<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSoldToProductsTable extends Migration
{
    public function up(): void
    {
        $fields = [
            'sold' => [
                'type'           => 'TINYINT',
                'constraint'     => 1,
                'default'        => 0,
                'comment'        => 'Mark product as sold/verkocht',
            ],
        ];

        $this->forge->addColumn('products', $fields);
    }

    public function down(): void
    {
        $this->forge->dropColumn('products', 'sold');
    }
}
