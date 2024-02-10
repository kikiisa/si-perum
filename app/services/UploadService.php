<?php

namespace App\services;

use Illuminate\Support\Facades\File;

class UploadService
{
    CONST PATH = 'data/syarat/';
    public function uploadFile($file)
    {
       $name = $file->hashName();
       $move = $file->move(self::PATH,$name);
       $result = self::PATH . $name;
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

    public function removedOneFiles($name)
    {
        return File::delete($name);
    }

}