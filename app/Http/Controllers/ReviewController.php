<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReviewController extends Controller
{
    public function storeCourseReview(Request $request)
    {
        $data = $request->all();
        Review::create([
            "content" => $data['review_message'],
            'rate' => $data['rate'],
            'user_id' => Auth::user()->id,
            'location_id' => $data['course_id'],
            'locationType' => Review::LOCATION_TYPE['course'],
            'created_at' => Carbon::now(),
        ]);
        return redirect()->back();
    }

    public function updateReview(Request $request, $id)
    {
        $data = $request->all();
        $review = Review::findOrFail($id);
        $review->update([
            'content' => $data['review_message'],
            'rate' => $data['rate'],
            'updated_at' => Carbon::now(),
        ]);
        return redirect()->back();
    }

    public function destroyReview($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        return redirect()->back();
    }
}
