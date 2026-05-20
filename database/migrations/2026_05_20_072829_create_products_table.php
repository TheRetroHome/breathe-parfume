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
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('brand');
            $table->text('short_description');
            $table->longText('description');
            $table->string('gender'); // male, female, unisex
            $table->decimal('price', 10, 2);
            $table->decimal('old_price', 10, 2)->nullable();
            $table->integer('volume_ml');
            $table->string('main_image');
            $table->integer('stock')->default(0);
            $table->integer('views')->default(0);
            $table->integer('orders_count')->default(0);
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('reviews_count')->default(0);
            $table->boolean('is_new')->default(false);
            $table->boolean('is_bestseller')->default(false);
            $table->boolean('is_active')->default(true);
            $table->string('concentration')->nullable(); // EDP, EDT, EDP Intense, etc.
            $table->string('country')->nullable();
            $table->timestamps();

            $table->index('gender');
            $table->index('price');
            $table->index('rating');
            $table->index('is_active');
            $table->index('is_new');
            $table->index('is_bestseller');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
