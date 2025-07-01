<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Booking;
use App\Models\Review;
use App\Models\Payment;
use App\Models\Destination;
use App\Models\Attraction;
use App\Models\Activity;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class AdminHomeController extends Controller
{
    public function index(){

        return view('admin.dashboard');
    }



    

    public function dashboard()
    {
        // Set the number of days to show on the chart
        $days = 7;
        $labels = [];
        $travelerData = [];
        $guideData = [];

        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i)->toDateString();
            $labels[] = Carbon::parse($date)->format('M d');

            $travelerCount = User::whereDate('created_at', $date)->where('role', 'traveler')->count();
            $guideCount = User::whereDate('created_at', $date)->where('role', 'guide')->count();

            $travelerData[] = $travelerCount;
            $guideData[] = $guideCount;
        }



        // Get booking counts grouped by month and status
        $bookingStats = Booking::selectRaw("DATE_FORMAT(created_at, '%b %Y') as month")
            ->selectRaw("SUM(CASE WHEN status = 'confirmed' THEN 1 ELSE 0 END) as confirmed")
            ->selectRaw("SUM(CASE WHEN status = 'canceled' THEN 1 ELSE 0 END) as canceled")
            ->groupBy('month')
            ->orderByRaw("MIN(created_at)")
            ->get();

        // Prepare arrays for Chart.js
        $months = $bookingStats->pluck('month');
        $confirmedData = $bookingStats->pluck('confirmed');
        $canceledData = $bookingStats->pluck('canceled')->map(fn($c) => -$c); // negative for downward bars


         $months = [];
        $successfulReservations = [];
        $failedReservations = [];

        for ($i = 0; $i < 12; $i++) {
            $month = Carbon::now()->subMonths(11 - $i)->format('Y-m');

            $monthLabel = Carbon::createFromFormat('Y-m', $month)->format('F');

            $months[] = $monthLabel;

            $successCount = Booking::where('status', 'confirmed')
                ->whereYear('date', Carbon::createFromFormat('Y-m', $month)->year)
                ->whereMonth('date', Carbon::createFromFormat('Y-m', $month)->month)
                ->count();

            $failCount = Booking::where('status', 'canceled')
                ->whereYear('date', Carbon::createFromFormat('Y-m', $month)->year)
                ->whereMonth('date', Carbon::createFromFormat('Y-m', $month)->month)
                ->count();

            $successfulReservations[] = $successCount;
            $failedReservations[] = $failCount;
        }

        return view('admin.dashboard', [
            'labels' => $labels,
            'travelerData' => $travelerData,
            'guideData' => $guideData,

            // Include existing dashboard variables
            'totalBookings' => Booking::count(),
            'totalPayments' => Payment::count(),
            'sumOfPayments' => Payment::sum('amount'),
            'totalTravelers' => User::where('role', 'traveler')->count(),
            'totalGuides' => User::where('role', 'guide')->count(),
            'pendingBookings' => Booking::where('status', 'pending')->with('user')->get(),
            'mostAddedActivities' => Activity::withCount('itineraries')->orderByDesc('itineraries_count')->take(5)->get(),
            'topUsers' => User::withCount('bookings')->orderByDesc('bookings_count')->take(5)->get(),
            'user' => auth()->user(),
            'months' => $months,
            'confirmedData' => $confirmedData,
            'canceledData' => $canceledData,
            

        ]);
    }



public function showReservationChart()
{
    $months = [];
    $successfulReservations = [];
    $failedReservations = [];

    for ($i = 0; $i < 12; $i++) {
        $month = Carbon::now()->subMonths(11 - $i)->format('Y-m');

        $monthLabel = Carbon::createFromFormat('Y-m', $month)->format('F');

        $months[] = $monthLabel;

        $successCount = Booking::where('status', 'confirmed')
            ->whereYear('date', Carbon::createFromFormat('Y-m', $month)->year)
            ->whereMonth('date', Carbon::createFromFormat('Y-m', $month)->month)
            ->count();

        $failCount = Booking::where('status', 'canceled')
            ->whereYear('date', Carbon::createFromFormat('Y-m', $month)->year)
            ->whereMonth('date', Carbon::createFromFormat('Y-m', $month)->month)
            ->count();

        $successfulReservations[] = $successCount;
        $failedReservations[] = $failCount;
    }

    return view('admin.dashboard', compact('months', 'successfulReservations', 'failedReservations'));
}



    public function userManagement(){

        
            $travelers = User::where('role', 'traveler')->get();
            $guides = User::where('role', 'guide')->with('guide')->get();
            
            return view('admin.user-management', compact('travelers', 'guides'));
    }



}
