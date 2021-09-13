<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use App\Models\Tag;
use App\Models\CourseUser;
use App\Models\Lesson;
use App\Models\Document;
use App\Models\DocumentUser;
use App\Models\LessonUser;

class LessonController extends Controller
{
    public function detail($courseId, $lessonId)
    {
        
        $course = Course::find($courseId);
        $lesson = Lesson::find($lessonId);
        $percentage = is_null($lesson->progress) ? 0 : $lesson->progress;
        $documents = $lesson->documents;
        $tags = $course->tags;
        $teachers = $course->teacher;
        $otherCourses = Course::query()->otherCourse($courseId)->limit(config('constants.number_other_course_in_detail_course'))->get();

        return view('lessons.detail', compact(['courseId', 'lessonId', 'course', 'lesson', 'tags', 'teachers', 'otherCourses', 'documents', 'percentage']));
    }

    public function search(Request $request, $courseId)
    {
        $data = $request->all();

        if (isset($data['search_form_input'])) {
            $keyword = $data['search_form_input'];
        } else {
            $keyword = '';
        }

        $isJoinedCourse = is_null(CourseUser::query()->checkJoinCourse($courseId)->first()) ? false : true;
        $course = Course::find($courseId);
        $lessons = Lesson::query()->search($data, $courseId)->paginate(config('constants.pagination'));
        $tags = $course->tags;
        $teachers = $course->teacher;
        $otherCourses = Course::query()->otherCourse($courseId)->limit(config('constants.number_other_course_in_detail_course'))->get();
        $reviews = $course->reviews;

        return view('courses.detail', compact(['course', 'lessons', 'tags', 'keyword', 'courseId', 'otherCourses', 'teachers', 'isJoinedCourse', 'reviews']));
    }
}
