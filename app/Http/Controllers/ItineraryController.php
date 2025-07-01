<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Itinerary;
use App\Models\User;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;


class ItineraryController extends Controller
{
    


    public function create($activityId)
    {

        $activity = Activity::findOrFail($activityId);
        $user_id = auth()->id(); 

        return view('itinerary-create', compact('activity', 'user_id'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'budget' => 'required|numeric',
            'activity_id' => 'required|exists:activities,id',
        ]);

        if(!Auth::check()){
            return redirect()->route('login')->with('error', 'You must be logged in');
        }

        //save itinerary and get the instance
        $itinerary = Itinerary::create([
            'user_id' => Auth::id(),
            'activity_id' => $request->activity_id,
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'budget' => $request->budget,
        ]);

        return redirect()->route('bookings.pay',$itinerary->id)->with('success', 'Itinerary created successfully.');
        
        
    }    


    




    public function index(Request $request) {

        $query = Itinerary::with('user', 'activity');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        $itineraries = $query->get();
        $activities = Activity::all();

        return view('admin.itineraries', compact('itineraries', 'activities'));
    }


    
    public function update(Request $request, $id)
    {
        $itinerary = Itinerary::findOrFail($id);

        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'activity_id' => 'required|exists:activities,id',
            'start_date' => 'required|date',
            'budget' => 'required|numeric',
        ]);

        $itinerary->update([
            'title' => $request->title,
            'description' => $request->description,
            'activity_id' => $request->activity_id,
            'start_date' => $request->start_date,
            'budget' => $request->budget,
        ]);

        return redirect()->back()->with('success', 'Itinerary updated successfully.');
    }

    public function destroy($id)
    {
        Itinerary::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Itinerary deleted successfully.');
    }


/*

    //user side  Itinerary part
     public function createItinerary($activity_id)
        {
            $activity = Activity::findOrFail($activity_id);
            $user_id = auth()->id(); 

            return view('itinerary.create', compact('activity', 'user_id'));
        }
        */
}
