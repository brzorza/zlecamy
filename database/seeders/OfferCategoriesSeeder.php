<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OfferCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('offerCategory')->insert([
            [
                'name' => 'Marketing',
                'slug'=> 'marketing',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus euismod, elit sit amet scelerisque scelerisque, dui arcu pharetra quam, sit amet pulvinar libero lorem vitae nisi. Fusce in dignissim urna, in vestibulum metus. Nullam aliquam nunc ut nisl vulputate, a accumsan urna dapibus. Cras maximus, ex id varius malesuada, eros lacus tristique ex, nec iaculis leo lectus at elit. Nulla facilisi. Integer et ante sit amet tortor gravida fringilla. Vestibulum malesuada felis non ante vestibulum, eget aliquam nulla tempor. Morbi lacinia, lorem vel ullamcorper efficitur, sapien sem congue mi, sed finibus elit risus a lorem.',
            ],
            [
                'name' => 'Programowanie',
                'slug'=> 'programowanie',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus euismod, elit sit amet scelerisque scelerisque, dui arcu pharetra quam, sit amet pulvinar libero lorem vitae nisi. Fusce in dignissim urna, in vestibulum metus. Nullam aliquam nunc ut nisl vulputate, a accumsan urna dapibus. Cras maximus, ex id varius malesuada, eros lacus tristique ex, nec iaculis leo lectus at elit. Nulla facilisi. ',
            ],
            [
                'name' => 'Animacje',
                'slug'=> 'animacje',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus euismod, elit sit amet scelerisque scelerisque, dui arcu pharetra quam, sit amet pulvinar libero lorem vitae nisi. Fusce in dignissim urna, in vestibulum metus. Nullam aliquam nunc ut nisl vulputate, a accumsan urna dapibus. Cras maximus, ex id varius malesuada, eros lacus tristique ex, nec iaculis leo lectus at elit. Nulla facilisi. Integer et ante sit amet tortor gravida fringilla. ',
            ],
            [
                'name' => 'Grafika',
                'slug'=> 'grafika',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus euismod, elit sit amet scelerisque scelerisque, dui arcu pharetra quam, sit amet pulvinar libero lorem vitae nisi. Fusce in dignissim urna, in vestibulum metus. Nullam aliquam nunc ut nisl vulputate, a accumsan urna dapibus. Cras maximus, ex id varius malesuada, eros lacus tristique ex, nec iaculis leo lectus at elit. Nulla facilisi. Integer et ante sit amet tortor gravida fringilla. Vestibulum malesuada felis non ante vestibulum, eget aliquam nulla tempor.',
            ],
            [
                'name' => 'Aktorstwo',
                'slug'=> 'aktorstwo',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.  Morbi lacinia, lorem vel ullamcorper efficitur, sapien sem congue mi, sed finibus elit risus a lorem. ',
            ],
            [
                'name' => 'Manualne',
                'slug'=> 'manualne',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus euismod, elit sit amet scelerisque scelerisque, dui arcu pharetra quam, sit amet pulvinar libero lorem vitae nisi. Fusce in dignissim urna, in vestibulum metus. Nullam aliquam nunc ut nisl vulputate, a accumsan urna dapibus. Cras maximus, ex id varius malesuada, eros lacus tristique ex, nec iaculis leo lectus at elit. Nulla facilisi. Integer et ante sit amet tortor gravida fringilla. Vestibulum malesuada felis non ante vestibulum, eget aliquam nulla tempor. ',
            ],
        ]);
    }
}
