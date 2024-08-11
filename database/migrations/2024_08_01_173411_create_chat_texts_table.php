<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatTextsTable extends Migration
{
    public function up()
    {
        Schema::create('chat_texts', function (Blueprint $table) {
            $table->id()->primary();
            $table->uuid('chat_id');
            $table->string('text');
            $table->integer('sender_id');
            $table->timestamps();

            $table->foreign('chat_id')->references('id')->on('chats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_texts');
    }
}