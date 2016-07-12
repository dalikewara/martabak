<?php

namespace App\Http\Controllers\Backend\Config;

class File
{
    public function path($target, $filename)
    {

        return $target . '/' . basename($filename);
    }

    public function type($target)
    {

        return pathinfo($target, PATHINFO_EXTENSION);
    }

    public function checkImg($tmpName)
    {

        return getimagesize($tmpName);
    }

    public function moveUploaded($tmpName, $target)
    {
        return move_uploaded_file($tmpName, $target);
    }
}
