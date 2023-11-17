<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
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

            if(Auth::check() && Auth::user()->role->id ==1){
                // return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
                return redirect()->intended(RouteServiceProvider::ADMIN_DASHBOARD.'?verified=1');

            }elseif(Auth::check() && Auth::user()->role->id ==2){
                return redirect()->intended(RouteServiceProvider::AUTHOR_DASHBOARD.'?verified=1');
            }

        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        // return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');

        if(Auth::check() && Auth::user()->role->id ==1){
            // return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
            return redirect()->intended(RouteServiceProvider::ADMIN_DASHBOARD.'?verified=1');

        }elseif(Auth::check() && Auth::user()->role->id ==2){
            return redirect()->intended(RouteServiceProvider::AUTHOR_DASHBOARD.'?verified=1');
        }
    }
}
