<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $coursesNumber = Course::count();
        $lessonsNumber = Lesson::count();
        $learnersNumber = User::count();
        $mainCourses = Course::query()->mainCourse()->get();
        $otherCourses = Course::query()->otherCourse(config('constants.id_zero'))->limit(config('constants.number_other_course_in_home'))->get();
        $reviews = Review::query()->reviewHome()->get();

        return view('home', compact(['mainCourses', 'otherCourses', 'reviews', 'coursesNumber', 'lessonsNumber', 'learnersNumber']));
    }
}
