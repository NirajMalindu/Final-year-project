<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Attraction;

class PlaceController extends Controller
{
    // Show Destinations and Attractions
    public function index()
    {
        $destinations = Destination::all();
        $attractions = Attraction::with('destination')->get();
        return view('admin.places', compact('destinations', 'attractions'));
    }

    // Store new Destination
    public function storeDestination(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'description' => 'required',
            'image' => 'nullable|image'
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('destinations', 'public') : null;

        Destination::create([
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Destination added successfully.');
    }

    // Update an existing Destination
    public function updateDestination(Request $request, $id)
    {
        $destination = Destination::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'description' => 'required',
            'image' => 'nullable|image'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('destinations', 'public');
            $destination->image = $imagePath;
        }

        $destination->update($request->only('name', 'location', 'description'));

        return redirect()->back()->with('success', 'Destination updated successfully.');
    }

    // Delete a Destination
    public function destroyDestination($id)
    {
        $destination = Destination::findOrFail($id);
        $destination->delete();
        return redirect()->back()->with('success', 'Destination deleted successfully.');
    }

    // Store new Attraction
    public function storeAttraction(Request $request)
    {
        $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|image'
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('attractions', 'public') : null;

        Attraction::create([
            'destination_id' => $request->destination_id,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Attraction added successfully.');
    }

    // Update an existing Attraction
    public function updateAttraction(Request $request, $id)
    {
        $attraction = Attraction::findOrFail($id);

        $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|image'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('attractions', 'public');
            $attraction->image = $imagePath;
        }

        $attraction->update($request->only('destination_id', 'name', 'description'));

        return redirect()->back()->with('success', 'Attraction updated successfully.');
    }

    // Delete an Attraction
    public function destroyAttraction($id)
    {
        $attraction = Attraction::findOrFail($id);
        $attraction->delete();
        return redirect()->back()->with('success', 'Attraction deleted successfully.');
    }
}
