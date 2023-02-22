<?php

namespace App\Http\Controllers\api;

trait apirespanceTrait
{
    public function apirespance($data=null,$message=null,$status=null){
        $array=[
            'data'=>$data,
            'message'=>$message,
            'status'=>$status
        ];
        return response($array,$status);

    }

}
