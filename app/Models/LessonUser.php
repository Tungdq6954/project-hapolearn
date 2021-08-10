<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class LessonUser extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'lesson_id', 'used_id', 'learned'
    ];
}
