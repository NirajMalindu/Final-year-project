<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;


class NotificationManagementController extends Controller
{
    public function index()
    {
        $notifications = Notification::with('user')->latest()->get();
        return view('admin.notifications', compact('notifications'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Notification::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Notification sent successfully.');
    }

    public function destroy($id)
    {
        Notification::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Notification deleted.');
    }
}
