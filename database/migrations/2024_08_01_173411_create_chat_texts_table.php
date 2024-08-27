<?php

use App\Enums\ChatTextTypeEnum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatTextsTable extends Migration
{
    public function up()
    {
        Schema::create('chat_texts', function (Blueprint $table) {
            $table->id()->primary();
            $table->uuid('chat_id');
            $table->enum('type', array_column(ChatTextTypeEnum::TYPES, 'value'))->default(ChatTextTypeEnum::TEXT);
            // $table->string('type');
            $table->string('value');
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