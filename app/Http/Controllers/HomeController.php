<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            $request->session()->flash('success', 'You are logged in!');
        }
        $numberOfCourses = Course::all()->count();
        $numberOfLessons = Lesson::all()->count();
        $numberOfLearners = User::where('role', User::ROLE['student'])->count();
        $mainCourses = Course::orderBy('id', 'asc')->take(3)->get();
        $otherCourses = Course::orderBy('id', 'desc')->take(3)->get();
        $reviews = Review::where('locationType', Review::LOCATION_TYPE['course'])->take(5)->get();
        return view('user.home', compact('numberOfCourses', 'numberOfLessons', 'numberOfLearners', 'mainCourses', 'otherCourses', 'reviews'));
    }
}
