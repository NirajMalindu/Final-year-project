<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {

            $request->user()->sendEmailVerificationNotification();


            if($request->user()-> role === 'admin'){

                 return back()->with('status', 'verification-link-sent');
                
            }
            
            elseif($request->user()-> role === 'guide'){

                return back()->with('status', 'verification-link-sent');
            }


            if($request->user()-> role === 'traveler'){

                 return back()->with('status', 'verification-link-sent');
            
            }

        }
    }
}
