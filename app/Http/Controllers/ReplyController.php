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
            'user_id' => $data['userId'],
            'replyId' => $reply->id,
            'content' => $data['write_reply'],
            'avatar' => 'http://localhost:8000/' . $reply->user->avatar,
            'username' => $reply->user->name,
            'timestamp' => $reply->reply_time
        ]);
    }

    public function edit(Request $request)
    {
        $data = $request->all();
        $reply = Reply::find($data['replyId']);
        $isSame = true;

        if($reply->content != $data['edit_reply_content']) {
            $reply->content = $data['edit_reply_content'];
            $reply->edit = config('constants.is_edited');
            $reply->save();
            $isSame = false;
        }

        return response()->json([
            'edit_reply_content' => $data['edit_reply_content'],
            'is_same' => $isSame,
        ]);
    }

    public function delete(Request $request)
    {
        $data = $request->all();
        $reply = Reply::find($data['replyId']);
        $reply->delete();

        return response()->json('reply is deleted');
    }
}
