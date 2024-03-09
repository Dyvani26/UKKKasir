<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

    
        $categories =[
            ['nama' => 'elektronik'],
            ['nama' => 'makanan'],
            ['nama' => 'kesehatan'],

        ];
        DB::table('categoris')->insert($categories);

    }
}
