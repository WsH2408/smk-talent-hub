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
        Schema::create('skill_student', function (Blueprint $table) {
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade'); // Kita pakai users.id sebagai student_id
            $table->foreignId('skill_id')->constrained()->onDelete('cascade');
            $table->primary(['student_id', 'skill_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skill_student');
    }
};
