<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('user.home');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/courses', [CourseController::class, 'index'])->name('courses');
Route::get('/search-course', [CourseController::class, 'searchCourses'])->name('courses.search');
Route::get('/course-details/{id}', [CourseController::class, 'showCourseDetails'])->name('course.details');
Route::get('/search-course-details/{id}', [CourseController::class, 'searchLessonsOfCourseDetail'])->name('course.details.search-lessons');
