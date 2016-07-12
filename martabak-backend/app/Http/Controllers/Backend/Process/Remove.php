<?php

namespace App\Http\Controllers\Backend\Process;

use App\Http\Controllers\Backend\Controller;
use App\Http\Controllers\Backend\Config\Error;
use App\Http\Controllers\Backend\Config\Model;
use App\Http\Controllers\Backend\Config\File;
use App\Http\Controllers\Backend\Config\Dir;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;

class Remove extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->error = new Error;
        $this->table = new Model;
        $this->file  = new File;
        $this->dir   = new Dir;
    }

    public function index(Request $request)
    {
        // If request method == POST and user is exist ------------------------
        if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset(Auth::user()->username))
        {
            $process     = $request->input(md5('process-option'));
            $processAct  = $request->input(md5('process-option-remove'));
            $type        = $request->input(md5('process-type'));
            $catchs      = NULL;
            $x           = 0;

            // Type Identifier
            switch($type)
            {
                case md5('post'):
                    $type              = 'post';
                    $tables            = $this->table->posts;
                    $tagRelations      = $this->table->postTags;
                    $categoryRelations = $this->table->postCategories;
                    $commentRelations  = $this->table->postComments;
                    break;

                case md5('page'):
                    $type   = 'page';
                    $tables = $this->table->pages;
                    break;

                case md5('tag'):
                    $type           = 'tag';
                    $tables         = $this->table->tags;
                    $tableRelations = $this->table->postCategories;
                    break;

                case md5('category'):
                    $type           = 'category';
                    $tables         = $this->table->categories;
                    $tableRelations = $this->table->postCategories;
                    break;

                case md5('trash'):
                    $type   = 'trash';
                    $tables = $this->table->trashes;
                    break;

                case md5('theme'):
                    $type   = 'theme';
                    $tables = $this->table->themes;
                    break;

                case md5('comment'):
                    $type   = 'comment';
                    $tables = $this->table->comments;
                    break;

                case md5('notification'):
                    $type   = 'notification';
                    $tables = $this->table->notifications;
                    break;

                case md5('media'):
                    $type      = 'media';
                    $mediaType = $request->input(md5('media-type'));
                    $fileName  = $request->input(md5('file-name'));
                    $tables    = $this->table->media;

                    switch($mediaType)
                    {
                        case md5('picture'):
                            $mediaType = 'picture';
                            break;
                    }
                    break;

                default:
                    $type   = 'undefinied';
                    $tables = NULL;
                    break;
            }

            // Process
            if($tables != NULL)
            {
                if($process == md5('yesIWantToRemove') OR $processAct == md5('yesIWantToRemove'))
                {
                    // Action selected
                    if(!empty($request->input(md5('id'))))
                    {
                        $actArray = explode(',', $request->input(md5('id')));
                    }
                    else
                    {
                        $actArray = array('a', 'b', 'c');
                    }

                    // Delete table
                    foreach($tables->all() as $table)
                    {
                        if($request->input(md5($type) . '-' . md5($table->id)) != NULL OR $request->input(md5('all')) == md5('yes') OR in_array(md5($table->id), $actArray))
                        {
                            if($type == 'trash')
                            {
                                if(md5($table->type) == $request->input(md5('trash-type')))
                                {
                                    $tables->find($table->id)->delete();
                                }
                            }
                            else
                            {
                                if($type == 'media')
                                {
                                    switch($mediaType)
                                    {
                                        case 'picture':
                                            $filePath = realpath($this->file->path($this->dir->picture, $fileName));

                                            if(is_writable($filePath))
                                            {
                                                if(unlink($filePath))
                                                {
                                                    $catchs[$x] = $table->id;
                                                    $tables->find($table->id)->delete();
                                                }
                                            }
                                            else
                                            {
                                                $this->error->err = 1;
                                            }
                                            break;
                                    }
                                }
                                else
                                {
                                    $catchs[$x] = $table->id;
                                    $tables->find($table->id)->delete();

                                    if($type == 'theme')
                                    {
                                        // also delete the file
                                    }
                                }

                                $x++;
                            }
                        }
                    }

                    // Delete table relations
                    if($type != 'trash' AND $type != 'theme' AND $type != 'comment' AND $type != 'notification' AND $type != 'media')
                    {
                        if($type == 'post')
                        {
                            if(count($tagRelations->get()) > 0)
                            {
                                foreach($catchs as $catch)
                                {
                                    $tagRelations->orWhere($type . '_id', $catch)->delete();
                                }
                            }

                            if(count($categoryRelations->get()) > 0)
                            {
                                foreach($catchs as $catch)
                                {
                                    $categoryRelations->orWhere($type . '_id', $catch)->delete();
                                }
                            }

                            if(count($commentRelations->get()) > 0)
                            {
                                foreach($catchs as $catch)
                                {
                                    $commentRelations->orWhere($type . '_id', $catch)->delete();
                                }
                            }
                        }
                        else
                        {
                            if(count($tableRelations->get()) > 0)
                            {
                                foreach($catchs as $catch)
                                {
                                    $tableRelations->orWhere($type . '_id', $catch)->delete();
                                }
                            }
                        }
                    }
                }
                else
                {
                    $this->error->errProcess = '<p>Undefined process.</p>';
                    $this->error->err         = 1;
                }
            }
            else
            {
                $this->error->errTable = '<p>Table not found.</p>';
                $this->error->err      = 1;
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
            $report = $this->error->errMethod . $this->error->errDelete . $this->error->errProcess;
        }

        // Done
        return $report;
    }
}
