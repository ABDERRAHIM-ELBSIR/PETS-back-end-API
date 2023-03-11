<?php

namespace App\Traits;

use App\Models\Files;

trait imgTrait
{
    public function  upload_img($file,$folder_name){

        $file_id_data = null;
        if ($file != null) {
            $image_path = $file->store($folder_name, 'images');
            $fileExtension =$file->getClientOriginalExtension();

            $data = Files::create([
                "type" => $fileExtension,
                "size" => 20025,
                //change name to refer_to id
                'name' => 'default',
                //add type of refer_to
                "file" => "images/" . $image_path
            ]);
            $file_id_data = $data;
        }

        if ($file_id_data != null) {
            $file_id_data = $file_id_data->id;
        }

        return $file_id_data ;
    }

    public function  get_file_path($file_id){
    if(!$file_id){
        return null;
    }
    $file=Files::find($file_id);
    $file=$file->file;
    return $file;
    }
}
