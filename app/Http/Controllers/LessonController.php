<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $lessons = Lesson::query()->search($data, $id)->paginate(config('variables.lesson_pagination'));
        $teachers = $course->teachers()->get();
        return view('course.course_details', compact('course', 'lessons', 'keyword', 'teachers'));
    }

    public function details($id)
    {
        $lesson = Lesson::findOrFail($id);
        $documents = $lesson->documents()->get();
        // $progressOfLesson = $lesson->learning_progress;
        return view('lesson.lesson_details', compact('lesson', 'documents'));
    }

    public function take(Request $request)
    {
        $lesson = Lesson::findOrFail($request->id);
        $numberOfDocument = $lesson->documents()->count();
        if ($numberOfDocument > 0) {
            $lesson->students()->updateExistingPivot(Auth::user()->id, array('learned' => config('variables.learning_lesson')));
        } else {
            $lesson->students()->updateExistingPivot(Auth::user()->id, array('learned' => config('variables.learned_lesson')));
        }
        // $documents = $lesson->documents()->get();
        // foreach ($documents as $document) {
        //     $document->students()->attach(Auth::user()->id);
        // }
        return redirect()->route('lesson.details', $request->id);
    }
}
