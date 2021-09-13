<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Course;
use App\Models\Reply;
use App\Models\User;

class ReplyController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        $reply = Reply::create([
            'content' => $data['write_reply'],
            'review_id' => $data['reviewId'],
            'user_id' => $data['userId'],
        ]);

        return response()->json([
            'content' => $data['write_reply'],
            'avatar' => 'http://localhost:8000/' . $reply->user->avatar,
            'username' => $reply->user->name,
            'timestamp' => $reply->reply_time
        ]);
    }
}
