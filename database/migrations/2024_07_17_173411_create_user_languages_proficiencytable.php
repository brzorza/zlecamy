<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguagesProficiencyTable extends Migration
{
    public function up()
    {
        Schema::create('languages_proficiency', function (Blueprint $table) {
            $table->primary('id');
            $table->string('proficiency');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('languages_proficiency');
    }
}
