<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_categories')->insert([
            [
                'name' => 'kuliner kering',
            ],
            [
                'name' => 'kuliner basah',
            ],
            [
                'name' => 'fashion',
            ],
            [
                'name' => 'jasa',
            ],
            [
                'name' => 'craft',
            ],
            [
                'name' => 'drink',
            ],
            [
                'name' => 'beauty',
            ],
            [
                'name' => 'furniture',
            ]
        ]);
    }
}
