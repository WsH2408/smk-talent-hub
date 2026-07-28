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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'siswa', 'rekruter'])->default('siswa')->after('password');
            $table->string('foto_profil')->nullable()->after('role');
        });
    }

    // Jangan lupa isi down() juga untuk rollback
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'foto_profil']);
        });
    }
};
