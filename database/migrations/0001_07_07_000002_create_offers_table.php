<?php

use App\Enums\PriceTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id()->primary();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('title');
            $table->string('description');
            $table->string('localization');
            // TODO add default offer image
            $table->string('cover')->nullable();
            $table->string('category_id');
            // $table->string('subCategoryId');
            $table->string('all_tags')->nullable();
            $table->integer('price');
            $table->enum('price_type', array_column(PriceTypeEnum::TYPES, 'value'))->default(PriceTypeEnum::HOUR);
            $table->string('delivery_time');
            $table->integer('promoted')->default(0);
            $table->boolean('active')->default(1);  //aktywna/nie aktywna, ale nadal widoczna dla użytkownika
            $table->boolean('visible')->default(1); //usunięte czy coś
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
