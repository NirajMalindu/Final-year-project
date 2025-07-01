<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\guide;


class BookingManagementController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->search;

        $bookings = Booking::with(['user', 'guide'])
            ->when($search, function ($query, $search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->orderBy('date', 'desc')
            ->get();

            $approvedGuides = Guide::where('status', 'approved')->with('user')->get();

        return view('admin.booking', compact('bookings', 'search', 'approvedGuides'));
    }


    public function update(Request $request, $id){

        $request->validate([
            'date' => 'required|date',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'guide_id' => 'nullable|exists:users,id',
        ]);

        $booking = Booking::findOrFail($id);

        $booking->update([
            'date' => $request->date,
            'status' => $request->status,
            'guide_id' => $request->guide_id,
        ]);

        return redirect()->back()->with('success', 'Booking updated successfully.');
    }


    
    public function confirm($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'confirmed';
        $booking->save();

        return redirect()->back()->with('success', 'Booking confirmed!');
    }


    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'cancelled';
        $booking->save();

        return redirect()->back()->with('success', 'Booking cancelled!');
    }


    public function delete($id)
    {
        Booking::destroy($id);
        return redirect()->back()->with('success', 'Booking deleted successfully!');
    }
}
