<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use App\Models\Tag;
use App\Models\CourseUser;

class CourseController extends Controller
{
    public function index()
    {
        $teachers = User::teachers()->get();
        $tags = Tag::get();
        $courses = Course::paginate(config('constants.pagination'));
        return view('courses.index', compact(['courses', 'teachers', 'tags']));
    }

    public function searchCourse(Request $request)
    {
        $data = $request->all();
        if (isset($data['search_form_input'])) {
            $keyword = $data['search_form_input'];
        } else {
            $keyword = '';
        }

        $teachers = User::teachers()->get();
        $tags = Tag::get();
        $courses = Course::query()->filter($data)->paginate(config('constants.pagination'));

        return view('courses.index', compact(['courses', 'teachers', 'tags', 'keyword']));
    }

    public function detail($courseId)
    {
        $isJoinedCourse = is_null(CourseUser::query()->checkJoinCourse($courseId)->first()) ? false : true;
        $course = Course::find($courseId);
        $lessons = $course->lessons;
        $tags = $course->tags;
        $teachers = $course->teacher;
        $otherCourses = Course::query()->otherCourse($courseId)->limit(config('constants.number_other_course_in_detail_course'))->get();

        return view('courses.detail', compact(['course', 'lessons', 'tags', 'courseId', 'otherCourses', 'teachers', 'isJoinedCourse']));
    }

    public function join($courseId)
    {
        $course = Course::find($courseId);
        $course->users()->attach(Auth::id(), ['created_at' => Carbon::now()]);

        return redirect()->route('courses.detail', [$courseId]);
    }
}
