<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Destination;
use App\Models\Review;
use App\Models\User;




class TravelerHomeController extends Controller
{

    public function index()
    {
        $activities = Activity::all();
        $travelerCount = User::where('role', 'traveler')->count();
        $guideCount = User::where('role', 'guide')->count();
        $activityCount = Activity::count();
        $reviewCount = Review::count();

        //passing notifications
         $notifications = [];
         $unreadNotificationsCount = 0;

        if(auth()->check()){
            $notifications = auth()->user()->notifications()->latest()->take(5)->get();
            $unreadNotificationsCount = auth()->user()->notifications()->where('is_read', false)->count();
        }

        return view('dashboard', compact('activities','travelerCount', 'guideCount', 'activityCount', 'reviewCount','notifications', 'unreadNotificationsCount'));



    }


    public function showHome()
    {
         $activities = Activity::all();
        $travelerCount = User::where('role', 'traveler')->count();
        $guideCount = User::where('role', 'guide')->count();
        $activityCount = Activity::count();
        $reviewCount = Review::count();
         
        //passing notifications
         $notifications = [];
         $unreadNotificationsCount = 0;

        if(auth()->check()){
            $notifications = auth()->user()->notifications()->latest()->take(5)->get();
            $unreadNotificationsCount = auth()->user()->notifications()->where('is_read', false)->count();
        }

        return view('dashboard', compact('activities','travelerCount', 'guideCount', 'activityCount', 'reviewCount','notifications', 'unreadNotificationsCount'));
    }



   
        // search activities by name and location

        public function search(Request $request)
        {
            $query = $request->input('query');

            $activities = Activity::where('name', 'like', "%$query%")
                ->orWhere('location', 'like', "%$query%")
                ->get();

            $destinations = Destination::with('attractions')
                ->where('name', 'like', "%$query%")
                ->orWhere('location', 'like', "%$query%")
                ->get();

            $travelerCount = User::where('role', 'traveler')->count();
            $guideCount = User::where('role', 'guide')->count();
            $activityCount = Activity::count();
            $reviewCount = Review::count();
             
            //passing notifications
         $notifications = [];
         $unreadNotificationsCount = 0;

        if(auth()->check()){
            $notifications = auth()->user()->notifications()->latest()->take(5)->get();
            $unreadNotificationsCount = auth()->user()->notifications()->where('is_read', false)->count();
        }


            return view('dashboard', compact('activities', 'destinations','travelerCount', 'guideCount', 'activityCount', 'reviewCount','notifications', 'unreadNotificationsCount'));
        }

        
       
    

}
