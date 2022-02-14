<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function read($id){
        $notification = Auth::user()->notifications()->findOrFail($id);
        if($notification->unread())
        $notification->markAsRead();

        return redirect()->to($notification->data['url']);
    }
}
