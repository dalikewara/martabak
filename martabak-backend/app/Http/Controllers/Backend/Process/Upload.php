<?php

namespace App\Http\Controllers\Backend\Process;

use App\Http\Controllers\Backend\Controller;
use App\Http\Controllers\Backend\Config\Error;
use App\Http\Controllers\Backend\Config\Model;
use App\Http\Controllers\Backend\Config\Dir;
use App\Http\Controllers\Backend\Config\File;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;

class Upload extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->error = new Error;
        $this->table = new Model;
        $this->dir   = new Dir;
        $this->file  = new File;
    }

    public function index(Request $request)
    {
        // If request method == POST and user is exist ------------------------
        if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset(Auth::user()->username))
        {
            $tables   = $this->table->media;
            $process  = $request->input(md5('process-option'));
            $type     = $request->input(md5('process-type'));
            $file     = $_FILES[md5('name')];
            $name     = $file['name'];
            $fType    = $file['type'];
            $tmpName  = $file['tmp_name'];
            $error    = $file['error'];
            $size     = $file['size'];

            // Type Identifier
            switch($type)
            {
                case md5('picture'):
                    $type     = 'picture';
                    $filePath = $this->file->path($this->dir->picture, $name);
                    break;
            }

            // Defining file type
            $fileType = $this->file->type($filePath);

            // Process
            if($tables != NULL)
            {
                if($process == md5('yesIWantToUpload'))
                {
                    if($type == 'picture')
                    {
                        $checkImg   = $this->file->checkImg($tmpName);
                        $imgFormats = array('png', 'gif', 'jpg', 'jpeg');

                        // Check image
                        if($checkImg === FALSE)
                        {
                            $this->error->errCheck = 'File is not an image.';
                            $this->error->err      = 1;
                        }

                        // Check if image already exists
                        if(file_exists($filePath))
                        {
                            $this->error->errExists = 'File already exists.';
                            $this->error->err       = 1;
                        }

                        // Filter image based on it formats
                        if(!in_array($fileType, $imgFormats))
                        {
                            $this->error->errFormat = 'Wrong file format.';
                            $this->error->err       = 1;
                        }

                        // Filter image size
                        if($size < 0 AND $size > 2000000)
                        {
                            $this->error->errSize = 'Your file is too large.';
                            $this->error->err     = 1;
                        }
                    }
                    else
                    {
                        //
                    }
                }
                else
                {
                    $this->error->errProcess = 'Undefined process.';
                    $this->error->err         = 1;
                }
            }
            else
            {
                $this->error->errTable = 'Table not found.';
                $this->error->err      = 1;
            }

            // Saving and move uploaded file
            if($this->error->err == 0)
            {
                if($type == 'picture')
                {
                    $tables->type = 1;
                }
                else
                {
                    //
                }

                $tables->file_name = $name;
                $tables->file_type = $fType;
                $tables->tmp_name  = $tmpName;
                $tables->error     = $error;
                $tables->size      = $size;

                if($tables->save())
                {
                    if($this->file->moveUploaded($tmpName, $filePath))
                    {
                        //
                    }
                    else
                    {
                        $this->error->errUpload = 'There was an error, uploading failed.';
                        $this->error->err = 1;
                    }
                }
                else
                {
                    $this->error->errSave = 'There was an error, saving failed.';
                    $this->error->err = 1;
                }
            }
        }

        // If request method == GET or (not POST) and user is not exist
        else
        {
            $this->error->errMethod = '<p>Method not allowed.</p>';
            $this->error->err       = 1;
        }
        // END request method and user checker---------------------------------

        // Final error handling
        if($this->error->err == 0)
        {
            $report = 'success';
        }
        else
        {
            $report = $this->error->errMethod . $this->error->errTable . $this->error->errProcess .
                      $this->error->errCheck . $this->error->errExists . $this->error->errFormat .
                      $this->error->errSize . $this->error->errSave . $this->error->errUpload;
        }

        // Done
        return $report;
    }
}
