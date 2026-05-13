<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            TyphoonMythsSeeder::class,
            ChecklistRulesSeeder::class,
            PreparednessTipsSeeder::class,
            GoBagItemsSeeder::class,
        ]);
    }
}