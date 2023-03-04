<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\Groups_members;
use Illuminate\Http\Request;

class Group_MembersController extends Controller
{
    public function get_all_member($id){ //get all member of groupe give it  id 
        $members=Groups_members::where('group_id',"=",$id)->get();
        if (!$members) {
            return response()->json([
                "message" => "not member in this group",
                "status" => 406,
            ]);
        }

        return response()->json([
            'data'=>$members,
            "message" => "member find",
            "status" => 200,
        ]);
    }

    public function join_to_group(Request $request){

        $auth_user=Auth::user()->id;
        $validate = Validator::make($request->all(), [
            'user_id' => 'required',
            'group_id' => 'required',
            'role' => 'required',
            'accepted' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors()->toJson(), 400);
        }

        $group_member =Groups_members::create([
            'user_id' => $auth_user,
            'group_id'=>$request->group_id,
            'role'=>$request->role,
            'accepted' => $request->accepted,
        ]);

        if (!$group_member) {
            return response()->json([
                "message" => "user not join to group",
                "status" => 406,
            ]);
        }

        return response()->json([
            'data'=>$group_member,
            "message" => "user join to group",
            "status" => 200,
        ]);
    }

    public function delete_member($id)
    {
        $auth_user=Auth::user()->id;
        $group_member=Groups_members::where('group_id',"=",$id)
        ->where('user_id','=',$auth_user);

        if (!$group_member) {
            return response()->json([
                "message" => "user not join to group",
                "status" => 404,
            ]);
        }
        
        $group_member->delete();

        return response()->json([
            "message" => "user sgn out  to group",
            "status" => 200,
        ]);
    }


}
