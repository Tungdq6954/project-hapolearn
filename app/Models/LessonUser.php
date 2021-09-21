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
        'lesson_id', 'user_id', 'learned'
    ];

    public function scopeIsLearned($query, $userId, $lessonId)
    {
        return $query->where([
            ['user_id', '=', $userId],
            ['lesson_id', '=', $lessonId]
        ]);
    }
}
