<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
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
        if($request->user()->hasVerifiedEmail()){
            if(Auth::check() && Auth::user()->role->id ==1){
                return redirect()->intended(RouteServiceProvider::ADMIN_DASHBOARD);

            }elseif(Auth::check() && Auth::user()->role->id ==2){
                return redirect()->intended(RouteServiceProvider::AUTHOR_DASHBOARD);
            }
        }else{
            view('auth.verify-email');
        }
    }
}
