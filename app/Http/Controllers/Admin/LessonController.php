<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAddLessonRequest;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonsUser;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $adminUser = User::findOrFail(Auth::user()->id);
        $course = Course::findOrFail($request->course);
        return view('admin.lesson.add', compact('adminUser', 'course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminAddLessonRequest $request)
    {
        $newLesson = Lesson::create($request->all());
        $adminUser = User::findOrFail(Auth::user()->id);
        LessonsUser::create([
            'lesson_id' => $newLesson->id,
            'user_id' => $adminUser->id,
        ]);
        return redirect()->route('admin.courses.show', $request->course_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $adminUser = User::findOrFail(Auth::user()->id);
        $lesson = Lesson::find($id);
        $documents = $lesson->documents()->get();
        return view('admin.lesson.details', compact('adminUser', 'lesson', 'documents'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $adminUser = User::findOrFail(Auth::user()->id);
        $lesson = Lesson::find($id);
        return view('admin.lesson.edit', compact('adminUser', 'lesson'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminAddLessonRequest $request, $id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->update($request->all());
        $data = $request->all();
        return redirect()->route('admin.courses.show', $data['course_id']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->delete();
        $lessonUser = LessonsUser::where('user_id', Auth::user()->id)->where('lesson_id', $lesson->id);
        $lessonUser->delete();
        return redirect()->back();
    }
}
