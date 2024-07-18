<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OfferTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('offerTags')->insert([
            [
                'name' => 'tag1',
            ],
            [
                'name' => 'tag2',
            ],
            [
                'name' => 'tag3',
            ],
            [
                'name' => 'tag4',
            ],
            [
                'name' => 'tag5',
            ],
            [
                'name' => 'tag6',
            ],
        ]);
    }
}
