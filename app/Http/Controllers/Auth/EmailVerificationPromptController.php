<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {


        if($request->user()-> role === 'admin'){

            return $request->user()->hasVerifiedEmail()
            ? redirect()->intended(route('admin/dashboard'))
            : view('auth.verify-email');
            
        }
        elseif($request->user()-> role === 'guide'){

            return $request->user()->hasVerifiedEmail()
            ? redirect()->intended(route('guide/dashboard'))
            : view('auth.verify-email');
        }


        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(route('dashboard'))
                    : view('auth.verify-email');
    }
}
