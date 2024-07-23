<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LanguagesProficiencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('language_proficiencies')->insert([
            [
                'name' => 'Ojczysty',
            ],
            [
                'name' => 'Zaawansowany',
            ],
            [
                'name' => 'Komunikatywny',
            ],
            [
                'name' => 'Początkujący',
            ],
        ]);
    }
}
