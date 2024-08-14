<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->unsignedBigInteger('offer_id');
            $table->unsignedBigInteger('seller_id');
            $table->unsignedBigInteger('client_id');
            $table->timestamps();

            //Add forein keys
            $table->foreign('offer_id')->references('id')->on('offers');
            $table->foreign('seller_id')->references('id')->on('users');
            $table->foreign('client_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chats');
    }
}
