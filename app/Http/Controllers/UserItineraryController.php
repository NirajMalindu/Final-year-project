<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Itinerary;
use Illuminate\Support\Facades\Auth;

class UserItineraryController extends Controller
{

    
    //open itinerary form page
    public function showItinerarypage(){

            $user_id = auth()->id(); 
            return view('itinerary-create', compact( 'user_id'));
    }



    //show itinerary history in traveler page
    public function showUserItineraries(){
            
        $user = auth()->user();
        $itineraries = Itinerary::with('activity')
            ->where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->get();

        return view('itinerariesshow', compact('itineraries'));
    }





    // UPDATE Itinerary
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'budget' => 'required|numeric|min:0',
        ]);

        $itinerary = Itinerary::where('id', $id)
                              ->where('user_id', Auth::id())
                              ->firstOrFail();

        $itinerary->update([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'budget' => $request->budget,
        ]);

        return redirect()->back()->with('success', 'Itinerary updated successfully!');
    }



    
    // DELETE Itinerary
    public function destroy($id)
    {
        $itinerary = Itinerary::where('id', $id)
                              ->where('user_id', Auth::id())
                              ->firstOrFail();

        $itinerary->delete();

        return redirect()->back()->with('success', 'Itinerary deleted successfully!');
    }




}
