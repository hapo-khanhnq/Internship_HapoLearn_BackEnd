<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $teachers = User::where('role', User::ROLE['teacher'])->get();
        $tags = Tag::get();
        $courses = Course::orderByDesc('id')->paginate(config('variables.pagination'));
        return view('course.index', compact('courses', 'teachers', 'tags'));
    }

    public function searchCourses(Request $request)
    {
        $teachers = User::where('role', User::ROLE['teacher'])->get();
        $tags = Tag::get();
        $data = $request->all();
        if (isset($data['keyword'])) {
            $keyword = $data['keyword'];
        } else {
            $keyword = '';
        }
        $courses = Course::query()->filter($data)->paginate(config('variables.pagination'));
        return view('course.index', compact('courses', 'teachers', 'keyword', 'tags'));
    }
}
