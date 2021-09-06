<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Requests\ReviewUserRequest;

class ReviewController extends Controller
{
    public function storeCourseReview(ReviewUserRequest $request)
    {
        $data = $request->all();
        Review::create([
            "content" => $data['review_message'],
            'rate' => $request->rate,
            'user_id' => Auth::user()->id,
            'location_id' => $data['course_id'],
            'locationType' => Review::LOCATION_TYPE['course'],
        ]);
        return redirect()->back();
    }

    public function storeLessonReview(ReviewUserRequest $request)
    {
        $data = $request->all();
        Review::create([
            "content" => $data['review_message'],
            'rate' => $request->rate,
            'user_id' => Auth::user()->id,
            'location_id' => $data['lesson_id'],
            'locationType' => Review::LOCATION_TYPE['lesson'],
        ]);
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $review = Review::findOrFail($id);
        $review->update([
            'content' => $data['edit_review_message'],
            'rate' => $request->rate,
            'updated_at' => Carbon::now(),
        ]);
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $review = Review::findOrFail($request->id);
        $review->delete();
        return redirect()->back();
    }
}
