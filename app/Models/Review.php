<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Stmt\ElseIf_;

class Review extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'content', 'rate', 'user_id','course_id', 'lesson_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id', 'id')->where('course_id', null);
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id')->where('lesson_id', null);
    }
}
