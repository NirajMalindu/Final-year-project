<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class GalleryManagementController extends Controller
{
   

    public function index()
    {
        $galleries = Gallery::latest()->get();
        return view('admin.gallery', compact('galleries'));
    }



    public function upload(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'tag' => 'nullable|string|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imageName = time() . '_' . uniqid() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('uploads/gallery'), $imageName);

        Gallery::create([
            'title' => $request->title,
            'tag' => $request->tag,
            'image' => $imageName,
        ]);

        return redirect()->back()->with('success', 'Image uploaded successfully.');
    }


    
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        $imagePath = public_path('uploads/gallery/' . $gallery->image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $gallery->delete();

        return redirect()->back()->with('success', 'Image deleted successfully.');
    }


}
