<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Traits\imgTrait;
use Validator;
use App\Models\Groups;
use Illuminate\Support\Facades\Auth;
use App\Models\Files;
use App\Models\Groups_members;
use Illuminate\Http\Request;

class GroupsController extends Controller
{
    use imgTrait;


    public function get_all_group()
    {
        $auth_user = Auth::user()->id; 
        $groups = Groups::all();
        foreach ($groups as $group) {
            $is_on_group = Groups_members::where('user_id', $auth_user)
                ->where('group_id', '=', $group->id)->where('accepted', true)->first();
            if ($is_on_group == null) {
                $group["is_on_group"] = false;
            } else {
                $group["is_on_group"] = true;
            }

            $group["members_count"] = Groups_members::where('group_id', '=', $group->id)
                ->where('role', 'user')
                ->where('accepted', true)
                ->count();
            $group["admins_count"] = Groups_members::where('group_id', '=', $group->id)
                ->where('role', 'admin')
                ->where('accepted', true)
                ->count();
        }

        return response()
            ->json([
                'groups' => $groups,
                'xxxx' => $is_on_group,
            ]);
    }
    public function get_spisifique_group($group_id)
    {
        $auth_user = auth()->user()->id;
        $group = Groups::find($group_id);
        $is_on_group = Groups_members::where('user_id', $auth_user)
            ->where('group_id', '=', $group->id)->where('accepted', true)->get();
        if ($is_on_group) {
            $group["is_on_group"] = true;
        }
        $group["members_count"] = Groups_members::where('group_id', '=', $group->id)
            ->where('role', 'user')
            ->where('accepted', true)
            ->count();
        $group["admins_count"] = Groups_members::where('group_id', '=', $group->id)
            ->where('role', 'admin')
            ->where('accepted', true)
            ->count();

        return response()
            ->json([
                'data' => $group
            ]);
    }
    public function get_group_for_user()
    {
        $auth_user = Auth::user()->id;
        $members = Groups_members::where('user_id', '=', $auth_user)->get();
        $groups = [];
        foreach ($members as $member) {

            $group = Groups::where('id', $member->group_id)->first();
            $group["members_count"] = Groups_members::where('group_id', '=', $group->id)
                ->where('role', 'user')
                ->where('accepted', true)
                ->count();
            $group["admins_count"] = Groups_members::where('group_id', '=', $group->id)
                ->where('role', 'admin')
                ->where('accepted', true)
                ->count();
            array_push($groups, $group);
        }


        return response()
            ->json([
                'groups' => $groups,
            ]);
    }

    public function join_to_group($group_id)
    {
        $auth_user = Auth::user()->id;
        $group_member = Groups_members::create([
            'user_id' => $auth_user,
            'group_id' => $group_id,
            'role' => 'admin',
            'accepted' => true,
        ]);

        if (!$group_member)
            return false;
        return true;
    }

    //create a group with user
    public function create_group(Request $request)
    {
        $id=time();
        // check if user uploaded a profile image 
        $profile_img = $request->file('profile_img');
        $profile_img_id = $this->upload_img($profile_img, "group/profile",$id,"geoup_profile");
        $cover_img = $request->file('cover_img');
        $cover_img_id = $this->upload_img($cover_img, "group/cover",$id,"geoup_cover");

        $validate = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors()->toJson(), 400);
        }

        $groups = Groups::create([
            'id'=>$id,
            'name' => $request->name,
            'profile_img' => $profile_img_id,
            'cover_img' => $cover_img_id,
            'description' => $request->description,
        ]);
        if (!$groups) {
            return response()->json([
                "message" => "groupe not created",
                "status" => 406,
            ]);
        }


        //======================================================================
        if ($this->join_to_group($groups->id)) {
            return response()->json([
                'data' => $groups,
                "message" => "group creted",
                "status" => 200,
            ]);
        } else {
            return response()->json([
                "message" => "something went wrong",
            ]);
        }

        //======================================================================


    }



    public function delete_group($id)
    { //find group you whant deleted

        $group = Groups::find($id);

        if (!$group) {
            return response()->json([
                "message" => "group not found",
                "status" => 404,
            ]);
        }
        $group->delete();

        return response()->json([
            "message" => "group deleted",
            "status" => 201,
        ]);
    }
}