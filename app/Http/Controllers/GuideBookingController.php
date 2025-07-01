<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class GuideBookingController extends Controller
{


    public function index()
    {
        // Ensure only guides access this page
        if (Auth::user()->role !== 'guide') {
            abort(403, 'Unauthorized');
        }

        // Get bookings assigned to this guide
        $bookings = Booking::where('guide_id', Auth::id())
            ->with(['user']) // eager load traveler info
            ->orderBy('date', 'desc')
            ->get();

        return view('guide.bookings', compact('bookings'));
    }
    

}
