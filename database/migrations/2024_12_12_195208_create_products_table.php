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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('default_name');
            $table->string('default_location');
            $table->string('default_phone');
            $table->string('default_open_at');
            $table->string('default_closed_at');
            $table->text('default_activities'); 
            $table->decimal('default_rating', 3, 2)->nullable();
            $table->string('default_image')->nullable();
            $table->timestamps();
        });

        Schema::create('product_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->string('locale'); // Language code
            $table->string('name');
            $table->string('location');
            $table->string('phone');
            $table->string('open_at');
            $table->string('closed_at');
            $table->text('activities'); 
            $table->timestamps();
        });

        Schema::create('product_translation_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_translation_images');
        Schema::dropIfExists('product_translations');
        Schema::dropIfExists('products');    }
};
