<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('languages')->insert([
            [
                'name' => 'Polski',
            ],
            [
                'name' => 'Angielski',
            ],
            [
                'name' => 'Niemiecki',
            ],
            [
                'name' => 'Hiszpański',
            ],
            [
                'name' => 'Serbski',
            ],
            [
                'name' => 'Czeski',
            ],
        ]);
    }
}
