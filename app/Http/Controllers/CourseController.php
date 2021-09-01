<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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

    public function details($id)
    {
        $course = Course::find($id);
        $lessons = $course->lessons()->paginate(config('variables.lesson-pagination'));
        $teachers = $course->teachers()->get();
        return view('course.course_details', compact('course', 'lessons', 'teachers'));
    }

    public function joinCourse($id)
    {
        $course = Course::findOrFail($id);
        $course->students()->attach(Auth::user()->id, ['created_at' => Carbon::now()]);
        $lessons = $course->lessons()->get();
        foreach ($lessons as $lesson) {
            $lesson->students()->attach(Auth::user()->id, ['created_at' => Carbon::now()]);
        }
        return redirect()->route('course.details', $id);
    }

    public function leaveCourse($id)
    {
        $course = Course::findOrFail($id);
        $course->users()->detach(Auth::user()->id);
        $lessons = $course->lessons()->get();
        foreach ($lessons as $lesson) {
            $lesson->students()->detach(Auth::user()->id, ['created_at' => Carbon::now()]);
        }
        return redirect()->route('course.details', $id);
    }
}
