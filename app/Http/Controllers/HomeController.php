<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Course;
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
        $mainCourses = Course::query()->mainCourse()->get();
        $otherCourses = Course::query()->otherCourse()->get();
        $reviews = Review::query()->reviewHome()->get();

        return view('home', compact(['mainCourses', 'otherCourses', 'reviews']));
    }
}
