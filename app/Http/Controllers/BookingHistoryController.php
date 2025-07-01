<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\User;

class BookingHistoryController extends Controller
{
    // Show booking history for the logged-in user
    public function bookings()
    {
        $bookings = Booking::with(['guide.guide', 'payment']) // include guide info + guide's details from guides table
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('bookinghistory', compact('bookings'));
    }

    

     public function cancel($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'cancelled';
        $booking->save();

        return back()->with('success', 'Booking has been cancelled.');
    }

    public function changeDate(Request $request, $id)
    {
        $request->validate([
            'new_date' => 'required|date|after_or_equal:today',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->date = $request->new_date;
        $booking->save();

        return back()->with('success', 'Booking date updated successfully.');
    }


}