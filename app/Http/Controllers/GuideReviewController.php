<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;

class GuideReviewController extends Controller
{
    public function index()
{
    $guideId = auth()->user()->id;

    $reviews = Review::with('user')
        ->where('guide_id', $guideId)
        ->where('status', 'approved') //  Only show approved
        ->latest()
        ->get();

    $totalReviews = $reviews->count();
    $averageRating = $reviews->avg('rating');

    // Rating count breakdown
    $ratingCounts = Review::with('user')
        ->where('guide_id', $guideId)
        ->where('status', 'approved')
        ->selectRaw('rating, COUNT(*) as count')
        ->groupBy('rating')
        ->pluck('count', 'rating')
        ->all();

    return view('guide.review', compact('reviews', 'totalReviews', 'averageRating', 'ratingCounts'));


}

}
