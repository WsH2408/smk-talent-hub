<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Cek apakah tabel sudah ada, jika belum buat baru
        if (! Schema::hasTable('skill_student')) {
            Schema::create('skill_student', function (Blueprint $table) {
                $table->id();
                $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
                $table->foreignId('skill_id')->constrained('skills')->onDelete('cascade');
                $table->timestamps();

                $table->unique(['student_id', 'skill_id']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('skill_student');
    }
};
