<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('deskripsi');
            $table->string('thumbnail'); // Nama file gambar
            $table->string('link_demo')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('approved'); // Nanti bisa diubah ke pending untuk sistem approve admin
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
