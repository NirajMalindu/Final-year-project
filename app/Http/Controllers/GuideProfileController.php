<?php

namespace App\Http\Controllers;

use App\Models\Guide;
use Illuminate\Http\Request;

class GuideProfileController extends Controller
{
    public function edit()
    {
        // Check if the authenticated user is a guide
        if (auth()->user()->role !== 'guide') {
            return redirect()->route('home')->with('error', 'You are not authorized to access this page.');
        }

        return view('profile.edit'); // View where the form is rendered
    }

   
        public function update(Request $request)
    {
        $user = auth()->user();

        // Validate fields
        $validated = $request->validate([
            'description' => ['nullable', 'string'],
            'experience' => ['nullable', 'string'],
            'availability' => ['nullable', 'string'],
        ]);

        // Check if user has a guide record
        if ($user->guide) {
            // If guide exists, update it
            $user->guide->update($validated);
        } else {
            // If guide does not exist, create one
            $user->guide()->create($validated);
        }

        return redirect()->back()->with('status', 'Guide profile updated successfully!');
    }
}
