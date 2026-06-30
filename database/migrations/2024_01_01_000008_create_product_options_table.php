<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('option_id')
                  ->constrained('options')
                  ->onDelete('cascade');
            $table->foreignId('product_id')
                  ->constrained('products')
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_options');
    }
};
