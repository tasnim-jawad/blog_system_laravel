<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriber;
use Brian2694\Toastr\Facades\Toastr;

class SubscriberController extends Controller
{
    public function store(Request $request){
        $validated = $request->validate([
            'email' => 'required|email|unique:subscribers',
        ]);

        $Subscriber = new Subscriber();
        $Subscriber->email = $request->email;
        $Subscriber->save();

        Toastr::success('You Subscrib successfully', 'success');
        return redirect()->back();

    }
}
