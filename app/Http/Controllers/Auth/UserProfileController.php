<?php

namespace App\Http\Controllers\Auth;

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
        $user = $request->user();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
        ]);

        $user->update($request->all());
        notify()->success('Update User', 'User updated successfully');
        return redirect()->route('profile');
    }
}
