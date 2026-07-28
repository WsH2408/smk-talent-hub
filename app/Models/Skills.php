<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Skills extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'skill_student', 'skill_id', 'student_id');
    }
}