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

    use apirespanceTrait;
    public function index()
    {
        $auth_user = Auth::user()->id;
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
            "test"=>$auth_user,
            "status" => 200
        ]);

    }
    public function friend_not_accepted($id_user){
        $auth_user = Auth::user()->id;
        $friends = Friend::
            where('status', '=', false)
            ->where('request_from', '=', $auth_user)
            ->orwhere('request_to', '=', $auth_user)->get();
            $fr = User::find($id_user)->get();

        if (!$friends) {
            return response()->json(null, 404);
        }
        return response()->json([
            "friends" => $friends,
            "status" => 200,
            "data"=>$fr
        ]);
    }

    // public function search_for_one_friend(){
    //     $auth_user = Auth::user()->id;
    //     $friends=Friend:: where('status', '=', true)
    //     ->where('request_from', '=', $auth_user)->get();

    //     if (!$friends) {
    //         return response()->json(null, 404);
    //     }

    //     return response()->json(([
    //         "friend"=>$friends,
    //         "status"=>200,
    //     ]));
    // }

    public function store(Request $request)
    {
        $auth_user = Auth::user()->id;

        // check if user exist in db
        $req_to_id_exist = User::where('id', '=', $request->request_to)->first();

        if ($req_to_id_exist === null) {
            return $this->apirespance(null, 'user not found', 404);
        }
        //check if request already exists
        $request_from_exist = Friend::where('request_from', '=', $auth_user)
            ->where('request_to', '=', $request->request_to)
            ->first();

        $request_to_exist = Friend::where('request_to', '=', $auth_user)
            ->where('request_from', '=', $request->request_to)
            ->first();

        if ($request_from_exist != null || $request_to_exist != null) {
            return $this->apirespance(null, 'request already exists', 404);
        }

        $friends = Friend::create([
            'request_from' => $auth_user,
            'request_to' => $request->request_to,
        ]);

        if (!$friends) {
            return $this->apirespance(null, 'friend request not send', 400);
        } else {
            return $this->apirespance(new Friends($friends), "friend request sent successfully", 200);
        }
    }

    

}