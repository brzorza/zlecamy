<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersSeeder::class);
        $this->call(OfferCategoriesSeeder::class);
        $this->call(OfferTagsSeeder::class);
        $this->call(OffersSeeder::class);
        $this->call(LanguagesSeeder::class);
        $this->call(LanguagesProficiencySeeder::class);
    }
}
