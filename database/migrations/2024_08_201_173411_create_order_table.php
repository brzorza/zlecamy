<?php

use App\Enums\OrderStatusEnum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('chat_id')->references('id')->on('chats');
            $table->foreignId('seller_id')->references('id')->on('users');
            $table->foreignId('client_id')->references('id')->on('users');
            $table->string('description');
            $table->integer('price');
            $table->integer('order_ready_in'); //TODO can delete this also in cotroller
            $table->date('available_until');
            $table->date('deadline');
            $table->enum('status', array_column(OrderStatusEnum::TYPES, 'value'))->default(OrderStatusEnum::NEW);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};