<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'guide_id' => 'required|exists:users,id',
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'guide_id' => $request->guide_id,
            'comment' => $request->comment,
            'rating' => $request->rating,
            'status' => 'pending',
        ]);

        return redirect()->route('guide.show', $request->guide_id)->with('success', 'Review submitted and pending approval.');
    }

    public function edit($id)
    {
        $review = Review::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('guide.edit_review', compact('review'));
    }

    public function update(Request $request, $id)
    {
        $review = Review::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review->update([
            'comment' => $request->comment,
            'rating' => $request->rating,
            'status' => 'pending',
        ]);

        return redirect()->route('guide.show', $review->guide_id)->with('success', 'Review updated successfully.');
    }

    public function destroy($id)
    {
        $review = Review::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $guideId = $review->guide_id;
        $review->delete();

        return redirect()->route('guide.show', $guideId)->with('success', 'Review deleted successfully.');
    }
}