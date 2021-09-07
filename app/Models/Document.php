<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'name',
        'type',
        'logo_path',
        'file_path',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'document_users', 'document_id', 'user_id')->withPivot('lesson_id')->withTimestamps();
    }

    public function getIsLearnedAttribute()
    {
        return $this->users()->where('user_id', Auth::id())->first();
    }
}
