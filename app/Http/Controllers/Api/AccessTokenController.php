<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Laravel\Sanctum\PersonalAccessToken;

class AccessTokenController extends Controller
{
    /**
     *  Authenticate User and return access token
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'device_name' => ['nullable'],
            'scopes' => ['nullable'],
        ]);
        $user =   User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $name = $request->post('device_name', $request->header('user-agent'));

            // scopes: categories.edit, categories.create, profile,update
            if ($request->post('scopes')) {
                $abilities = explode(',', $request->post('scopes'));
            } else {
                $abilities = ['*'];
            }
            $token = $user->createToken($name, $abilities);

            return Response::json([
                'token' => $token->plainTextToken,
                'user' => $user,
            ], 201);
        }

        return Response::json([
            'message' => __('Invalid credentials!')
        ], 401);
    }

    public function destroy($token = null)
    {
        $user = Auth::guard('sanctum')->user();

        //Revoke a specifed token
        if ($token) {
            if ($token == 'All') {
                //Logout from all devices
                $user->tokens()->delete();

                return;
            }
            $user->tokens()->where('token', '=', hash('sha256', $token));
            $token  =  PersonalAccessToken::findToken($token);

            if ($token->tokenable_id != $user->id || $token->tokenable_type != get_class($user)) {
                abort(403);
            }
            $token->delete();
            return;
        } else {
            //Logout from current device
            $user->currentAccessToken()->delete();
        }


        return ['Logout'];
    }
}
