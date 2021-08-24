<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use App\Models\Tag;

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
}
