<?php

namespace App\Helpers;

class FileHelper
{
    public static function save($file, $path){
        // $fileName = 'file-'.time().'.'.$file->getClientOriginalExtension();
        
        // $file->storeAs($path, $fileName);

        // dd($path.$fileName);

        // return $path.$fileName;

            $filename = $file->getClientOriginalName();
            $Path = public_path().$path;
             $file->move($Path, $filename);
             return $path.$filename;
    } 
    
}