<?php

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
        Schema::create('offerCategory', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('name');
            $table->string('slug');
            $table->mediumText('description');
            $table->boolean('visible')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offerCategory');
    }
};
