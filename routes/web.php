<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LessonController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();
Route::get('courses/search', [CourseController::class, 'searchCourse'])->name('courses.search');
Route::get('courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('courses/detail/{courseId}', [CourseController::class, 'detail'])->name('courses.detail');
Route::get('courses/detail/{courseId}/search', [LessonController::class, 'search'])->name('courses.search_lesson');
Route::get('courses/detail/{courseId}/join', [CourseController::class, 'join'])->name('courses.join_course')->middleware('auth');
