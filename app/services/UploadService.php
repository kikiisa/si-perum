<?php

namespace App\services;

use Illuminate\Support\Facades\File;

class UploadService
{
    CONST PATH = 'data/syarat/';
    CONST IMAGE = 'data/cover/';
    public function uploadFile($file)
    {
       $name = $file->hashName();
       $move = $file->move(self::PATH,$name);
       $result = self::PATH . $name;
       return $result;
    }

    public function uploadImage($file)
    {
       $name = $file->hashName();
       $move = $file->move(self::IMAGE,$name);
       $result = self::IMAGE . $name;
       return $result;
    }

    public function removedFiles($file,$oldFile)
    {
        File::delete($oldFile);
        $name = $file->hashName();
        $move = $file->move(self::PATH,$name);
        $result = self::PATH . $name;
        return $result;
    }

    public function removedFilesProfile($file,$oldFile,$path)
    {
        File::delete($oldFile);
        $name = $file->hashName();
        $move = $file->move($path,$name);
        $result = $path . $name;
        return $result;
    }

    public function removedOneFiles($name)
    {
        return File::delete($name);
    }

 

}