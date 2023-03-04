<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\apirespanceTrait;
use Illuminate\Http\Request;
use App\Http\Resources\Friends;
use App\Models\Friend;
use App\Models\User;

use Validator;
use Illuminate\Support\Facades\Auth;

class FriendsController extends Controller
{
    //show my friend by default
    public function index()
    {

        $auth_user = Auth::user()->id;
        //find  my friend 
        $friends = Friend::
            where('status', '=', true)
            ->where('request_from', '=', $auth_user)
            ->orwhere('request_to', '=', $auth_user)
            ->get();

        if (!$friends) {
            return response()->json(null, 404);
        }
        return response()->json([
            "friends" => $friends,
            "status" => 200
        ]);

    }
    public function friend_not_accepted($id_user)
    {
        //find friend not acceptable
        $auth_user = Auth::user()->id;
        $friends = Friend::
            where('status', '=', false)
            ->where('request_from', '=', $auth_user)
            ->orwhere('request_to', '=', $auth_user)->get();

        if (!$friends) {
            return response()->json(null, 404);
        }
        return response()->json([
            "friends" => $friends,
            'message'=>'friend funded',
            "status" => 200,
        ]);
    }

    public function store(Request $request)
    {
        $auth_user = Auth::user()->id;

        // check if user exist in db
        $req_to_id_exist = User::where('id', '=', $request->request_to)->first();

        if ($req_to_id_exist === null) {
            return response()->json(['user' => null, 'message' => 'user not found', 'status' => 404]);
        }
        //check if request already exists
        $request_from_exist = Friend::where('request_from', '=', $auth_user)
            ->where('request_to', '=', $request->request_to)
            ->first();

        $request_to_exist = Friend::where('request_to', '=', $auth_user)
            ->where('request_from', '=', $request->request_to)
            ->first();
        if ($request_from_exist != null || $request_to_exist != null) {
            return response()->json([
                'user' => null,
                'message' => 'request already exists'
                ,
                'status' => 404
            ]);
        }

        $friends = Friend::create([
            'request_from' => $auth_user,
            'request_to' => $request->request_to,
            'status'=>$request->status,
        ]);

        if (!$friends) {
            return response()->json(['message' => 'friend request not send', 'status' => 404]);

        } else {
            return response()->json([
                'friend_info' => $friends,
                'message' => "friend request sent successfully",
                'status' => 200
            ]);
        }
    }



}