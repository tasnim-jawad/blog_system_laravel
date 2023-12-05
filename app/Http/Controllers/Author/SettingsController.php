<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index(){
        return view('author.settings');
    }

    public function updateProfile(Request $request){

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'image' => 'required|image|mimes:jpg,bmp,png,jpeg',
            'about' => 'required',

        ]);
        $image = $request->file('image');
        $slug = Str::slug($request->name);
        $user = User::findOrFail(Auth::id());

        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('profile')){
                Storage::disk('public')->makeDirectory('profile');
            }

            $profileImage = Image::make($image)->resize(500,500)->save();
            Storage::disk('public')->put('profile/'.$imageName,$profileImage);

            if(Storage::disk('public')->exists('profile/'.$user->image)){
                Storage::disk('public')->delete('profile/'.$user->image);
            }

        }else{
            $imageName = $user->image;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = $imageName;
        $user->about = $request->about;

        $user->save();

        Toastr::success('Profile successfully Updated', 'success');
        return redirect()->back();
    }

    public function updatePassword(Request $request){
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);


        $hashedPassword = Auth::user()->password;

        if(Hash::check($request->old_password, $hashedPassword)){
            if(!Hash::check($request->password, $hashedPassword)){
                $user = User::findOrFail(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();

                Toastr::success('Password successfully Updated', 'success');
                Auth::logout();
                return redirect()->back();
            }else{
                Toastr::error('New Password cannot be the same as old password', 'ERROR');
                return redirect()->back();
            }
        }else{
            Toastr::error('Current Password dose not match.', 'ERROR');
            return redirect()->back();
        }

    }
}
