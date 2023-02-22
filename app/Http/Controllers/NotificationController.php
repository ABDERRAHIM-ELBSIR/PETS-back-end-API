<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function All_Notification_For_User(){
        $auth_user=Auth::user()->id;
        $notification=Notification::where('user_id','=',$auth_user);
        
    }
}
