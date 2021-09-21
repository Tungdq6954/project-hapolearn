<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'content', 'rate', 'user_id', 'course_id', 'lesson_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id')->where('course_id', null);
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id')->where('lesson_id', null);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class, 'review_id');
    }

    public function getUsersAttribute()
    {
        return $this->user()->get();
    }

    public function getRepliesAttribute()
    {
        return $this->replies()->get();
    }

    public function getCommentTimeAttribute()
    {
        return date_format($this->created_at, 'M j') . ', ' . date_format($this->created_at, 'Y') . ' at ' . date_format($this->created_at, 'g:i a');
    }

    public function scopeReviewHome($query)
    {
        return $query->join('users', 'user_id', '=', 'users.id')
            ->join('courses', 'course_id', '=', 'courses.id')
            ->where('rate', '>=', config('constants.min_rate_in_feedback_home'))
            ->select('users.name as user_name', 'users.avatar as user_avatar', 'reviews.content as review_content', 'reviews.rate as review_rate', 'courses.title as course_title')->limit(10);
    }
}
