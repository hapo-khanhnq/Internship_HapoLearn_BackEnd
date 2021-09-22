<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeNotLoginController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

Auth::routes(['verify' => true]);

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/courses', [CourseController::class, 'index'])->name('courses');
Route::get('/search-course', [CourseController::class, 'searchCourses'])->name('courses.search');
Route::get('/course-details/{id}', [CourseController::class, 'details'])->name('course.details');
Route::get('/search-lessons-of-course/{id}', [LessonController::class, 'search'])->name('lesson.search');
Route::post('take-course', [CourseController::class, 'join'])->name('course.join')->middleware(['auth', 'verified']);
Route::post('leave-course', [CourseController::class, 'leave'])->name('course.leave');
Route::post('course/store-review', [ReviewController::class, 'storeCourseReview'])->name('review.course.store')->middleware(['auth', 'verified']);
Route::post('lesson/store-review', [ReviewController::class, 'storeLessonReview'])->name('review.lesson.store');
Route::post('course/update-review', [ReviewController::class, 'update'])->name('review.update');
Route::delete('course/delete-review', [ReviewController::class, 'destroy'])->name('review.destroy');
Route::get('/lesson-details/{id}', [LessonController::class, 'details'])->name('lesson.details')->middleware(['auth', 'verified']);
Route::post('take-lesson', [LessonController::class, 'take'])->name('lesson.take');
Route::post('/document/upload', [DocumentController::class, 'upload'])->name('document.upload');
Route::get('/document/download/{file}', [DocumentController::class, 'download'])->name('document.download');
Route::get('/document-details/{id}', [DocumentController::class, 'details'])->name('document.details');
Route::post('/document-learn', [DocumentController::class, 'learn'])->name('document.learn');
Route::get('user/profile', [UserController::class, 'show'])->name('user.show')->middleware(['auth', 'verified']);
Route::put('user/profile/update-avatar/{id}', [UserController::class, 'updateAvatar'])->name('user.update.avatar');
Route::put('user/profile/update', [UserController::class, 'updateInformation'])->name('user.update.information');
