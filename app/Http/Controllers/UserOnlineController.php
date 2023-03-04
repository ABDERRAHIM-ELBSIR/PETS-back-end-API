<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Friend;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserOnlineController extends Controller
{
    public function User_Online()
    {
        $auth_user = Auth::user()->id;
        $user_online=[];
        $friends = Friend::
            where('status', '=', true)
            ->where('request_from', '=', $auth_user)
            ->orwhere('request_to', '=', $auth_user)
            ->get();

        if (!$friends) {
            return response()->json([
                'message' => 'friend not found',
                'status' => 200,
            ]);
        }
        // $user_create_post = Auth::user();
        foreach ($friends as $friend) {
            $users = User::where('id', '=', $friend->request_to)
            ->orwhere('id', '=', $friend->request_from)
            ->get();
            if ($users->isOnline()) {
                array_push($user_online,$users);
            } else {
                echo 'User is offline';
            }
        }
        
    }

}