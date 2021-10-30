<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAddUserCourseRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adminUser = User::findOrFail(Auth::user()->id);
        $courses = $adminUser->courses()->get();
        return view('admin.user.index', compact('adminUser', 'courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $adminUser = User::findOrFail(Auth::user()->id);
        if($request->course) {
            $course = Course::findOrFail($request->course);
            return view('admin.user.add', compact('adminUser', 'course'));
        } else {
            $courses = $adminUser->courses()->get();
            return view('admin.user.add', compact('adminUser', 'courses'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminAddUserCourseRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if($user) {
            $course = Course::findOrFail($request->course);
            $course->users()->attach($user->id);
            if ($user->role == User::ROLE['student']) {
                $lessons = $course->lessons()->get();
                foreach ($lessons as $lesson) {
                    $lesson->students()->attach($user->id);
                    $documents = $lesson->documents()->get();
                    foreach ($documents as $document) {
                        $document->students()->attach($user->id);
                    }
                }
            }
            return redirect()->route('admin.users.index');
        } else {
            return redirect()->back()->with('message', 'This email does not exist');;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $data = $request->all();
        $course = Course::findOrFail($data['course_id']);
        $course->users()->detach($id);
        $lessons = $course->lessons()->get();
        foreach ($lessons as $lesson) {
            $lesson->students()->detach($id);
            $documents = $lesson->documents()->get();
            foreach ($documents as $document) {
                $document->students()->detach($id);
            }
        }
        return redirect()->route('admin.courses.show', $data['course_id']);
    }
}
