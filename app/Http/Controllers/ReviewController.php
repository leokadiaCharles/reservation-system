<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use App\Models\Table; // Make sure to import Table model if not already imported

class ReviewController extends Controller
{
    public function create()
    {
        $table = Table::first(); // Example: Fetch the table instance you want to review
        return view('hotelViews.newReview', compact('table'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'reviewable_type' => 'required|string',
            'reviewable_id' => 'required|integer',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
        ]);

        $review = new Review();
        $review->reviewable_type = $request->reviewable_type;
        $review->reviewable_id = $request->reviewable_id;
        $review->user_id = Auth::id(); // Assuming you are using Laravel's authentication
        $review->rating = $request->rating;
        $review->review = $request->review;
        $review->save();

        return redirect()->back()->with('success', 'Review submitted successfully.');
    }
}
