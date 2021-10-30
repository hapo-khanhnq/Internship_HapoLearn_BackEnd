<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCourseRequest;
use App\Models\Course;
use App\Models\CoursesUser;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
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
        return view('admin.course.index', compact('adminUser', 'courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $adminUser = User::findOrFail(Auth::user()->id);
        $tags = Tag::all();
        return view('admin.course.add', compact('adminUser', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddCourseRequest $request)
    {
        if ($request->hasFile('image')) {
            $imageFile = $request->image;
            $image = time() . '.' . $imageFile->getClientOriginalExtension();
            $request->image->move('storage\courses', $image);
        }
        $newCourse = Course::create([
            'name' => $request->name,
            'image_path' => $image,
            'description' => $request->description,
            'price' => $request->price,
        ]);
        CoursesUser::create([
            'course_id' => $newCourse->id,
            'user_id' => Auth::user()->id,
        ]);
        $tags = $request->tag;
        $oldTags = [];
        if(isset($tags)) {
            foreach($tags as $tag) {
                if (Tag::where('id', $tag)->doesntExist()) {
                    $newTag = Tag::create([
                        'name' => $tag,
                    ]);
                    $newCourse->tags()->attach($newTag->id);
                } else {
                    if(!in_array($tag, $oldTags)) {
                        $newCourse->tags()->attach($tag);
                    }
                }
            }
        }

        return redirect()->route('admin.courses.index');
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
        $course = Course::find($id);
        $lessons = $course->lessons()->get();
        return view('admin.course.details', compact('adminUser', 'course', 'lessons'));
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
        $course = Course::find($id);
        $tags = Tag::all();
        return view('admin.course.edit', compact('adminUser', 'course', 'tags'));
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
        $course = Course::findOrFail($id);
        if ($request->hasFile('image')) {
            $oldImage = Course::findOrFail($id)->image_path;
            $image = time() . "." . $request->image->getClientOriginalExtension();
            unlink(public_path('storage\courses/' . $oldImage));
            $request->image->move('storage\courses', $image);
            $course->update(['image_path' => $image]);
        }
        $course->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);
        $tags = $request->tag;
        $oldTags = [];
        foreach($course->tags as $tag) {
            array_push($oldTags, $tag->id);
        }
        $oldTagsCollection = new Collection($oldTags);
        $diffOldTags = $oldTagsCollection->diff($tags)->all();
        if(isset($tags)) {
            foreach($tags as $tag) {
                if (Tag::where('id', $tag)->doesntExist()) {
                    $newTag = Tag::create([
                        'name' => $tag,
                    ]);
                    $course->tags()->attach($newTag->id);
                } else {
                    if(!in_array($tag, $oldTags)) {
                        $course->tags()->attach($tag);
                    }
                }
            }
        }
        if(isset($diffOldTags)) {
            $course->tags()->detach($diffOldTags);
        }
        return redirect()->route('admin.courses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        $courseUser = CoursesUser::where('user_id', Auth::user()->id)->where('course_id', $course->id);
        $courseUser->delete();
        // $course->users()->detach();
        $course->tags()->detach();
        return redirect()->route('admin.courses.index');
    }
}
