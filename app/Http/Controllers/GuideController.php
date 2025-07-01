<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    public function show($id)
    {
        $guide = User::with(['guide', 'reviews.user'])->findOrFail($id);

        return view('guide.show', compact('guide'));
    }
}