<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Review;


class GuideHomeController extends Controller
{
    public function index(){

        return view('guide.dashboard');
    }




    public function guideDashboard()
    {
        $userId = auth()->id();

        $upcomingBookings = Booking::where('guide_id', $userId)
            ->where('date', '>=', now())
            ->with('user') // eager load user details
            ->orderBy('date')
            ->take(5)
            ->get();

        $totalTrips = Booking::where('guide_id', $userId)->count();
        $pendingReviews = auth()->user()->reviews()->where('status', 'approved')->count();
        $averageRating = auth()->user()->reviews()->where('status', 'approved')->avg('rating');

        //passing notifications
         $notifications = [];
         $unreadNotificationsCount = 0;

        if(auth()->check()){
            $notifications = auth()->user()->notifications()->latest()->take(5)->get();
            $unreadNotificationsCount = auth()->user()->notifications()->where('is_read', false)->count();
        }

        return view('guide.dashboard', [
            'upcomingBookings' => $upcomingBookings,
            'totalTrips' => $totalTrips,
            'pendingReviews' => $pendingReviews,
            'averageRating' => $averageRating,
            'notifications'=>$notifications,
            'unreadNotificationsCount'=> $unreadNotificationsCount,
        ]);
    }



    //return to guide contact us page
     public function guidecontact(){

        return view('guide.guidecontact');
    }

    //return to guide about us page
     public function guideabout(){

        return view('guide.guideabout');
    }
}





