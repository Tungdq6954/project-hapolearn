<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class CourseUser extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['course_id', 'user_id'];

    public function scopeCheckJoinCourse($query, $courseId)
    {
        return $query->where([
            ['user_id', '=', Auth::id()],
            ['course_id', '=', $courseId]
        ]);
    }
}
