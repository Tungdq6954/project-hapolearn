<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    const ROLE = [
        'student' => 0,
        'teacher' => 1,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar',
        'phone',
        'birthday',
        'address',
        'aboutMe'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The courses that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_users', 'user_id', 'course_id')->withTimestamps();
    }

    /**
     * Get all of the reviews for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany(Review::class, 'user_id');
    }

    public function documents()
    {
        return $this->belongsToMany(Document::class, 'document_users', 'user_id', 'document_id')->withPivot('lesson_id')->withTimestamps();
    }

    /**
     * The users that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_users', 'used_id', 'lesson_id')->withPivot('learned')->withTimestamps();
    }

    public function replies()
    {
        return $this->hasMany(Reply::class, 'user_id');
    }

    public function getCoursesAttribute()
    {
        return $this->courses()->get();
    }

    public function scopeTeachers($query)
    {
        $query->where('role', config('constants.role.teacher'));
    }
}
