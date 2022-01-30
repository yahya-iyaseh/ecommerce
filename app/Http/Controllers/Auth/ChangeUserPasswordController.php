<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ChangeUserPasswordController extends Controller
{
    public function index(){
        return view('auth.change-password');
    }
    public function update(Request $request){
        $user = $request->user();
        $request->validate([
            'password' => ['required', 'password'],
            'new_password' => ['required', 'min:8', 'confirmed']
        ]);
        $user->forceFill([
            'password' => Hash::make($request->post('new_password')),
            'remember_token' => null,
        ])->save();

        notify()->success('Update password', 'Password Updated successfuly');
        return redirect()->route('profile');
    }
}
