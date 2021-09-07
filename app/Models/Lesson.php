<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title', 'description', 'requirement', 'content', 'course_id', 'learn_time'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'lesson_id')->where('course_id', null);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'lesson_users', 'lesson_id', 'user_id')->withPivot('learned')->withTimestamps();
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'lesson_id');
    }

    public function getUsersAttribute()
    {

        return $this->users()->get();
    }

    public function getNumberUsersAttribute()
    {
        return $this->users()->count();
    }

    public function getDocumentsAttribute()
    {
        return $this->documents()->get();
    }

    public function getProgressAttribute()
    {
        $isLearnedDocuments = DocumentUser::query()->isLearnedDocuments(Auth::id(), $this->id)->count();
        $allDocumentsOfLesson = ($this->documents()->count() == 0) ? 1 : $this->documents()->count();
        $percentage = ($isLearnedDocuments / $allDocumentsOfLesson) * 100;
        return ($percentage == null) ? 0 : $percentage;
    }

    public function scopeSearch($query, $data, $courseId)
    {
        $query->where([
            ['course_id', '=', $courseId],
            ['title', 'like', '%' . $data['search_form_input'] . '%']
        ]);
    }
}
