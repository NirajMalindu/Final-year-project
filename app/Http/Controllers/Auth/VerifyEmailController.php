<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
                    if ($request->user()->hasVerifiedEmail()) {

                        if($request->user()-> role === 'admin'){

                            return redirect()->intended(route('admin/dashboard').'?verified=1');
                        }

                        elseif($request->user()-> role === 'guide'){
                
                            return redirect()->intended(route('guide/dashboard').'?verified=1');
                        }

                        return redirect()->intended(route('dashboard').'?verified=1');
                    }




                    if ($request->user()->markEmailAsVerified()) {

                        event(new Verified($request->user()));
                    }

        

        if($request->user()-> role === 'admin'){

            return redirect()->intended(route('admin/dashboard').'?verified=1');
        }

        elseif($request->user()-> role === 'guide'){

            return redirect()->intended(route('guide/dashboard').'?verified=1');
        }

        return redirect()->intended(route('dashboard').'?verified=1');

    }
}
