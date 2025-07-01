<?php

namespace App\Http\Controllers;

use App\Models\Itinerary;
use App\Models\Activity;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // Show payment page
    public function showPaymentPage($id)
    {
        $itinerary = Itinerary::with('activity')->findOrFail($id);
        $activity = $itinerary->activity;

        return view('payment', compact('itinerary', 'activity'));
    }



    // Handle payment and save booking + payment
    public function processPayment(Request $request, $id)
    {
        $request->validate([
            'method' => 'required|in:card,paypal,bank',
            'transaction_id' => 'nullable|string|max:100',
            'activity_id' => 'required|exists:activities,id',

        ]);

        $itinerary = Itinerary::findOrFail($id);

        // Store booking
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'activity_id'=> $request->activity_id,
            'date' => $itinerary->start_date,
            'status' => 'pending',
        ]);

        
        // Store payment
        Payment::create([
            'booking_id' => $booking->id,
            'amount' => $request->amount,
            'status' => 'successful',
            'method' => $request->method,
            'transaction_id' => $request->transaction_id,
        ]);

        return redirect()->route('itinerariesshow')->with('success', 'Trip booked and payment successful!');
    }
}

