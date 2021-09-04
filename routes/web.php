<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/courses', [CourseController::class, 'index'])->name('courses');
Route::get('/search-course', [CourseController::class, 'searchCourses'])->name('courses.search');
Route::get('/course-details/{id}', [CourseController::class, 'details'])->name('course.details');
Route::get('/search-lessons-of-course/{id}', [LessonController::class, 'search'])->name('lesson.search');
Route::post('take-course', [CourseController::class, 'join'])->name('course.join');
Route::post('leave-course', [CourseController::class, 'leave'])->name('course.leave');
Route::post('course/store-review', [ReviewController::class, 'storeCourseReview'])->name('review.course.store');
Route::post('course/update-review', [ReviewController::class, 'update'])->name('review.update');
Route::delete('course/delete-review', [ReviewController::class, 'destroy'])->name('review.destroy');
