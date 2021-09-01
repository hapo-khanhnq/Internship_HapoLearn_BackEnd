<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function search(Request $request, $id)
    {
        $data = $request->all();
        if (isset($data['keyword'])) {
            $keyword = $data['keyword'];
        } else {
            $keyword = '';
        }
        $course = Course::find($id);
        $lessons = Lesson::query()->search($data, $id)->paginate(config('variables.lesson-pagination'));
        $teachers = $course->teachers()->get();
        return view('course.course_details', compact('course', 'lessons', 'keyword', 'teachers'));
    }
}
