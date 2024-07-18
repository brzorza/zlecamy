<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLanguagesTable extends Migration
{
    public function up()
    {
        Schema::create('user_languages', function (Blueprint $table) {
            $table->primary('id');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('language_id')->constrained()->onDelete('cascade');
            $table->string('proficiency_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_languages');
    }
}
