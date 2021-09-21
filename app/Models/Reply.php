<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'content', 'user_id', 'review_id'
    ];

    public function review()
    {
        return $this->belongsTo(Review::class, 'review_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getUserAttribute()
    {
        return $this->user()->first();
    }

    public function getReplyTimeAttribute()
    {
        return date_format($this->created_at, 'M j') . ', ' . date_format($this->created_at, 'Y') . ' at ' . date_format($this->created_at, 'g:i a');
    }
}
