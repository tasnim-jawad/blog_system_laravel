<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
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
            // return redirect()->intended(RouteServiceProvider::HOME);
            if(Auth::check() && Auth::user()->role->id ==1){
                return redirect()->intended(RouteServiceProvider::ADMIN_DASHBOARD);

            }elseif(Auth::check() && Auth::user()->role->id ==2){
                return redirect()->intended(RouteServiceProvider::AUTHOR_DASHBOARD);
            }
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
