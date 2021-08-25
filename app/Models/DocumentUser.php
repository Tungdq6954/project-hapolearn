<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentUser extends Model
{
    use HasFactory;

    protected $fillable = ['document_id', 'user_id', 'lesson_id'];

    public function scopeIsLearned($query, $documentId, $userId, $lessonId)
    {
        return $query->where([
            ['user_id', '=', $userId],
            ['document_id', '=', $documentId],
            ['lesson_id', '=', $lessonId]
        ]);
    }

    public function scopeIsLearnedDocuments($query, $userId, $lessonId)
    {
        return $query->where([
            ['user_id', '=', $userId],
            ['lesson_id', '=', $lessonId]
        ])->get();
    }
}
