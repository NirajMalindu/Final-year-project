<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;


class GalleryController extends Controller
{
     
    public function index()
    {

        $galleryAll = Gallery::all();
        $allTags = Gallery::pluck('tag')->filter()->unique();

        $tags = [];

        foreach ($allTags as $tagString) {
            $individualTags = array_map('trim', explode(',', $tagString));
            $tags = array_merge($tags, $individualTags);
        }

        $tags = array_unique($tags);
        sort($tags);

        // Prepare galleries grouped by tag
        $galleriesByTag = [];

        foreach ($tags as $tag) {
            // Get galleries where 'tags' contain this tag
            $galleriesByTag[$tag] = Gallery::where('tag', 'LIKE', '%' . $tag . '%')->get();
        }

        // Pass variables to the view
        return view('gallery', compact('galleryAll', 'tags', 'galleriesByTag'));
    }
}

