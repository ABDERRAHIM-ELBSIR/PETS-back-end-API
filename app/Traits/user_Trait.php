<?php

namespace App\Traits;
use App\Models\User;
use App\Traits\imgTrait;
trait user_Trait
{
    use imgTrait;
    public  function  get_user_info($user_id){
        $user=User::find($user_id)->first();
            $user_name=$user->name;     
            $user_img=$this->get_file_path($user->profile_img);
            return [$user_name, $user_img];
    }
}
