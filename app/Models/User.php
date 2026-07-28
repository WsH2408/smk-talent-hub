<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'foto_profil',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // RELASI
    public function profile(): HasOne
    {
        return $this->hasOne(StudentProfile::class);
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    // Tambahkan relasi skills ini (MANY-TO-MANY)
    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skills::class, 'skill_student', 'student_id', 'skill_id');
    }

    // Helper untuk cek role
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
    public function isSiswa()
    {
        return $this->role === 'siswa';
    }
    public function isRekruter()
    {
        return $this->role === 'rekruter';
    }
}