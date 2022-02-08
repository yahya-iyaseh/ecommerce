<?php

namespace App\Http\Controllers\Auth;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function index(){
        $user = Auth::user();
        return view('auth.user-profile', compact('user'));
    }


    public function update(Request $request){
        // dd($request->address);
        $user = $request->user();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'birth_date' => ['date', 'before:today'],
        ]);

        $user->update($request->all());
        $profile = $user->profile;

        if(!$profile->exists){
            $request->merge(['user_id' => $user->id]);
            $profile = Profile::create($request->all());
        }else{
            $profile->update($request->all());
        }

        notify()->success('Update User', 'User updated successfully');
        return redirect()->route('profile');
    }
}
