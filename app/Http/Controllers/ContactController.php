<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    
    public function index(){

        return view('contact');
    }



    public function sendContact(Request $request){

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
            'phone' => 'required|string|max:13',
        ]);


        //combine names
        $validated['name'] = $validated['first_name']. '' . $validated['last_name'];
        Mail::to('maliduniraj@gmail.com')->send(new ContactMail($validated));

        return back()->with('success', 'Your message has been sent successfully!');
    }

}

