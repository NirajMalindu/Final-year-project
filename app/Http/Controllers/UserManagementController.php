<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Guide;


class UserManagementController extends Controller
{
    

    public function index() {
        $travelers = User::where('role', 'traveler')->get();
        $guides = User::where('role', 'guide')->with('guide')->get();

        return view('admin.users.index', compact('travelers', 'guides'));
    }


    public function userManagement(Request $request){

            
        $search = $request->input('search');

        $travelers = User::where('role', 'traveler')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->get();

        $guides = User::where('role', 'guide')
            ->with('guide')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
                });
            })
        
            ->get();

        return view('admin.user-management', compact('travelers', 'guides', 'search'));
    
    }



    public function suspendTraveler($id) {
        $traveler = User::findOrFail($id);
        $traveler->is_suspended = !$traveler->is_suspended;
        $traveler->save();

        return back()->with('success', 'Traveler status updated.');
    }


    public function deleteTraveler($id) {
        $traveler = User::findOrFail($id);
        $traveler->delete();

        return back()->with('success', 'Traveler deleted.');
    }


    public function approveGuide($id) {

        $guide = Guide::where('user_id', $id)->first(); // use user_id, not id

        if (!$guide) {
            return back()->with('error', 'Guide not found.');
        }

        $guide->status = 'approved';
        $guide->save();

        return back()->with('success', 'Guide approved successfully.');
    }



    public function rejectGuide($id) {

        $guide = Guide::where('user_id', $id)->first(); // use user_id, not id

        if (!$guide) {
            return back()->with('error', 'Guide not found.');
        }

        $guide->status = 'rejected';
        $guide->save();

        return back()->with('success', 'Guide rejected.');

    }



    public function updateGuide(Request $request, $id) {
        // Fetch the guide using the user_id as the primary key
        $guide = Guide::where('user_id', $id)->first();

        if (!$guide) {
            return back()->with('error', 'Guide not found');
        }

        // Update the guide's information
        $guide->availability = $request->input('availability', $guide->availability);
        $guide->experience = $request->input('experience', $guide->experience);
        $guide->description = $request->input('description', $guide->description);

        // Save the updated guide information
        $guide->save();

        return back()->with('success', 'Guide information updated');
    }

    





    public function deleteGuide($id)
    {
        $user = User::findOrFail($id);
    
        if ($user->guide) {
            $user->guide->delete();
        }
        $user->delete();
    
        return back()->with('success', 'Guide deleted successfully.');
    }
    



   


}
