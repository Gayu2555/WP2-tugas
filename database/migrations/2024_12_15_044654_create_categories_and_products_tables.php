<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesAndProductsTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Membuat tabel categories
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama kategori
            $table->text('description')->nullable(); // Deskripsi kategori
            $table->timestamps();
        });

        // Membuat tabel products
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id'); // Relasi ke tabel categories
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->text('description')->nullable();
            $table->string('image')->nullable(); // Kolom gambar produk sudah ada saat pembuatan tabel
            $table->timestamps();

            // Definisi foreign key secara eksplisit
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus tabel products terlebih dahulu agar tidak ada konflik dengan foreign key
        Schema::dropIfExists('products');

        // Hapus tabel categories
        Schema::dropIfExists('categories');
    }
}
