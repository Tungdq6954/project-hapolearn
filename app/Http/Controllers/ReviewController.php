<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Course;
use App\Models\Reply;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        $review = Review::create([
            'content' => $data['write_comment'],
            'rate' => $data['rate'],
            'user_id' => $data['userId'],
            'course_id' => $data['courseId'],
            'lesson_id' => $data['lessonId'],
        ]);

        $course = Course::find($data['courseId']);

        return response()->json([
            'course_id' => $data['courseId'],
            'reviewId' => $review->id,
            'user_id' => $data['userId'],
            'content' => $data['write_comment'],
            'rate' => $data['rate'],
            'avatar' => 'http://localhost:8000/' . $review->user->avatar,
            'username' => $review->user->name,
            'timestamp' => $review->comment_time,
            'numberReviews' => count($course->reviews),
            'rating_overview_score' => $course->rating_overview_score,
            'five_stars_rate_percent' => $course->five_stars_rate_percent,
            'four_stars_rate_percent' => $course->four_stars_rate_percent,
            'three_stars_rate_percent' => $course->three_stars_rate_percent,
            'two_stars_rate_percent' => $course->two_stars_rate_percent,
            'one_star_rate_percent' => $course->one_star_rate_percent,
            'five_stars_rate' => $course->five_stars_rate,
            'four_stars_rate' => $course->four_stars_rate,
            'three_stars_rate' => $course->three_stars_rate,
            'two_stars_rate' => $course->two_stars_rate,
            'one_star_rate' => $course->one_star_rate,
        ]);
    }

    public function edit(Request $request)
    {
        $data = $request->all();
        $review = Review::find($data['reviewId']);
        $isSame = true;

        if($review->content != $data['edit_comment']) {
            $review->content = $data['edit_comment'];
            $review->edit = config('constants.is_edited');
            $review->save();
            $isSame = false;
        }

        return response()->json([
            'review_edit' => $data['edit_comment'],
            'is_same' => $isSame,
        ]);
    }

    public function delete(Request $request)
    {
        $data = $request->all();
        $review = Review::find($data['reviewId']);
        $repliesId = $review->replies->pluck('id')->toArray();
        
        Reply::whereIn('id', $repliesId)->delete();
        $review->delete();

        return response()->json('review is deleted');
    }
}
