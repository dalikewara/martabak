<?php

namespace App\Http\Controllers\Backend\Process;

use App\Http\Controllers\Backend\Controller;
use App\Http\Controllers\Backend\Config\Error;
use App\Http\Controllers\Backend\Config\Model;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;

class Create extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->error = new Error;
        $this->table = new Model;
    }

    public function index(Request $request)
    {
        // If request method == POST and user is exist ------------------------
        if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset(Auth::user()->username))
        {
            // Defining variabels
            $process         = $request->input(md5('process-option'));
            $type            = $request->input(md5('process-type'));
            $name            = $request->input(md5('name'));
            $slug            = $request->input(md5('slug'));
            $content         = $request->input(md5('content'));
            $description     = $request->input(md5('description'));
            $commentRole     = $request->input(md5('comment-role'));
            $contentStatus   = $request->input(md5('content-status'));
            $typePage        = $request->input(md5('type-page'));
            $customDate      = $request->input(md5('custom-date'));
            $customTime      = $request->input(md5('custom-time'));
            $dateNow         = date('Y-m-d') . ' ' . date('H:i:s');
            $typeName        = 'name';
            $typeSlug        = 'slug';
            $typeDescription = 'description';
            $typeTitle       = 'title';
            $typeContent     = 'content';

            // Type Identifier
            switch($type)
            {
                case md5('post'):
                    $type   = 'post';
                    $tables = $this->table->posts;
                    break;

                case md5('page'):
                    $type   = 'page';
                    $tables = $this->table->pages;
                    break;

                case md5('tag'):
                    $type     = 'tag';
                    $tables   = $this->table->tags;
                    $typeName = $type . '_name';
                    $typeSlug = $type . '_slug';
                    break;

                case md5('category'):
                    $type            = 'category';
                    $tables          = $this->table->categories;
                    $typeName        = $type . '_name';
                    $typeSlug        = $type . '_slug';
                    $typeDescription = $type . '_description';
                    break;

                default:
                    $type   = 'undefinied';
                    $tables = NULL;
                    break;
            }

            if($tables != NULL)
            {
                if($process == md5('yesIWantToCreate'))
                {
                    // Slug process
                    if($slug != NULL)
                    {
                        if(preg_match('/[^a-zA-Z0-9-_]/', $slug) OR preg_match('/^-/', $slug) OR preg_match('/^_/', $slug) OR preg_match('/-$/', $slug) OR preg_match('/_$/', $slug))
                        {
                            $this->error->errName = '<p>Wrong name format.</p>';
                            $this->error->err = 1;
                        }
                    }
                    else
                    {
                        $length    = 62;
                        $result    = '';
                        $chars     = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890-_';
                        $charArray = str_split($chars);

                        for($i = 0; $i <= $length; $i++)
                        {
                            $random  = array_rand($charArray);
                            $result .= ''.$charArray[$random];
                        }

                        $slug = $result;
                    }

                    if($type == 'post' OR $type == 'page')
                    {
                        // Post title
                        if($name == NULL)
                        {
                            $name = 'Untitled';
                        }

                        // Post comment role
                        if($commentRole == md5('yesAllowed'))
                        {
                            $commentRole = 1;
                        }
                        elseif($commentRole == md5('notAllowed'))
                        {
                            $commentRole = 2;
                        }
                        else
                        {
                            $this->error->err     = 1;
                            $this->error->errRole = '<p>Invalid Role.</p>';
                        }

                        // Post status
                        if($contentStatus == md5('yesIWantToPublish'))
                        {
                            $contentStatus = 1;
                        }
                        elseif($contentStatus == md5('yesIWantToDraft'))
                        {
                            $contentStatus = 2;
                        }
                        else
                        {
                            $this->error->err       = 1;
                            $this->error->errStatus = '<p>Invalid Status.</p>';
                        }
                    }
                    else
                    {
                        if($name != NULL)
                        {
                            if(preg_match('/[^a-zA-Z0-9-_ &]/', $name) OR preg_match('/^-/', $name) OR preg_match('/^_/', $name) OR preg_match('/-$/', $name) OR preg_match('/_$/', $name))
                            {
                              $this->error->errName = '<p>Wrong name format.</p>';
                              $this->error->err     = 1;
                            }
                        }
                        else
                        {
                            $this->error->errName = '<p>Name must be filled.</p>';
                            $this->error->err     = 1;
                        }
                    }
                }
                else
                {
                    $this->error->errProcess = '<p>Undefined process.</p>';
                    $this->error->err         = 1;
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

        // Save decision and final error handling
        if($this->error->err == 0)
        {
            // Insert datas
            if($type == 'post' OR $type == 'page')
            {
                $tables->title         = $name;
                $tables->slug          = $slug;
                $tables->content       = $content;
                $tables->allow_comment = $commentRole;
                $tables->status_id     = $contentStatus;
                $tables->user_id       = $this->table->users->where('username', Auth::user()->username)->first()->id;

                // Custom date and time
                if($customDate != NULL AND $customTime != NULL)
                {
                    if(preg_match('/[0-9]{4}[-][0-9]{2}[-][0-9]{2}/', $customDate))
                    {
                        $dateArray   = explode('-', $customDate);
                        $i           = 0;
                        $yearTop     = 2050;
                        $yearBottom  = 1993;
                        $day28       = 28;
                        $day29       = 29;
                        $day30       = 30;
                        $day31       = 31;
                        $monthTop    = 12;
                        $monthBottom = '01';
                        $dayChar28   = array('02');
                        $dayChar29   = array('02');
                        $dayChar30   = array('04', '06', '09', '11');
                        $dayChar31   = array('01', '03', '05', '07', '08', '10', '12');

                        if($dateArray[0] >= $yearBottom AND $dateArray[0] <= $yearTop)
                        {
                            if($dateArray[1] <= $monthTop AND $dateArray[1] >= $monthBottom)
                            {
                                while($yearBottom < $yearTop)
                                {
                                    $yearBottom  = $yearBottom + 3;
                                    $yearCab[$i] = $yearBottom;

                                    $i++;
                                    $yearBottom++;
                                }

                                if(in_array($dateArray[0], $yearCab))
                                {
                                    if(in_array($dateArray[1], $dayChar29) AND $dateArray[2] > $day29)
                                    {
                                        $this->error->errDate = '<p>Error with <strong>custom date</strong>. Please ensure you have enter the correct format.</p>';
                                        $this->error->err     = 1;
                                    }
                                }
                                else
                                {
                                    if(in_array($dateArray[1], $dayChar28) AND $dateArray[2] > $day28)
                                    {
                                        $this->error->errDate = '<p>Error with <strong>custom date</strong>. Please ensure you have enter the correct format.</p>';
                                        $this->error->err     = 1;
                                    }
                                }

                                if(in_array($dateArray[1], $dayChar30) AND $dateArray[2] > $day30)
                                {
                                    $this->error->errDate = '<p>Error with <strong>custom date</strong>. Please ensure you have enter the correct format.</p>';
                                    $this->error->err     = 1;
                                }

                                if(in_array($dateArray[1], $dayChar31) AND $dateArray[2] > $day31)
                                {
                                    $this->error->errDate = '<p>Error with <strong>custom date</strong>. Please ensure you have enter the correct format.</p>';
                                    $this->error->err     = 1;
                                }

                                if($this->error->err != 1)
                                {
                                    $customDate = $dateArray[0] . '-' . $dateArray[1] . '-' . $dateArray[2];
                                }
                            }
                            else
                            {
                                $this->error->errDate = '<p>Error with <strong>custom date</strong>. Please ensure you have enter the correct format.</p>';
                                $this->error->err     = 1;
                            }
                        }
                        else
                        {
                            $this->error->errDate = '<p>Error with <strong>custom date</strong>. Please ensure you have enter the correct format.</p>';
                            $this->error->err     = 1;
                        }
                    }
                    else
                    {
                        $this->error->errDate = '<p>Error with <strong>custom date</strong>. Please ensure you have enter the correct format.</p>';
                        $this->error->err     = 1;
                    }

                    if(preg_match('/[0-9]{2}[:][0-9]{2}/', $customTime))
                    {
                        $timeArray = explode(':', $customTime);
                        $hourTop   = 24;
                        $minuteTop = 60;

                        if($timeArray[0] > $hourTop)
                        {
                            $this->error->errTime = '<p>Error with <strong>custom time</strong>. Please ensure you have enter the correct format.</p>';
                            $this->error->err     = 1;
                        }

                        if($timeArray[1] > $minuteTop)
                        {
                            $this->error->errTime = '<p>Error with <strong>custom time</strong>. Please ensure you have enter the correct format.</p>';
                            $this->error->err     = 1;
                        }

                        if($this->error->err != 1)
                        {
                            $customTime = $customTime . ':00';
                        }
                    }
                    else
                    {
                        $this->error->errTime = '<p>Error with <strong>custom time</strong>. Please ensure you have enter the correct format.</p>';
                        $this->error->err     = 1;
                    }

                    $customCreatedAt = $customDate . ' ' . $customTime;
                    $customUpdatedAt = $customCreatedAt;

                    $tables->created_at = $customCreatedAt;
                    $tables->updated_at = $customUpdatedAt;

                    if($customCreatedAt > $dateNow)
                    {
                        $tables->status_id = 3;
                    }
                }
                else
                {
                    if(($request->input(md5('custom-date')) == NULL AND $request->input(md5('custom-time')) != NULL) OR ($request->input(md5('custom-date')) != NULL AND $request->input(md5('custom-time')) == NULL))
                    {
                        $this->error->errFill = '<p>If you use <b>Custom Date Publish</b>, you have to fill all (two) inputs of it.</p>';
                        $this->error->err     = 1;
                    }
                }

                if($type == 'page' AND $typePage == 'custom')
                {
                   //Create file
                }
            }
            elseif($type == 'tag')
            {
                $tables->$typeName = $name;
                $tables->$typeSlug = $slug;
            }
            elseif($type == 'category')
            {
                $tables->$typeName        = $name;
                $tables->$typeSlug        = $slug;
                $tables->$typeDescription = $description;
            }
            else
            {
               //
            }

            if($this->error->err != 1 AND $tables->save())
            {
                if($type == 'post')
                {
                    // Post tags
                    foreach($this->table->tags->all() as $tag)
                    {
                        if($request->input(md5('tag') . '-' . md5($tag->id)) != NULL AND $request->input(md5('tag') . '-' . md5($tag->id)) == md5($tag->id))
                        {
                            $this->table->postTags->insert(
                            [
                                  'post_id'    => $this->table->posts->id,
                                  'tag_id'     => $tag->id,
                                  'created_at' => $this->table->posts->created_at,
                                  'updated_at' => $this->table->posts->updated_at
                            ]);
                        }
                    }

                    // Post categories
                    foreach($this->table->categories->all() as $category)
                    {
                        if($request->input(md5('category') . '-' . md5($category->id)) != NULL AND $request->input(md5('category') . '-' . md5($category->id)) == md5($category->id))
                        {
                            $this->table->postCategories->insert(
                            [
                                  'post_id'     => $this->table->posts->id,
                                  'category_id' => $category->id,
                                  'created_at'  => $this->table->posts->created_at,
                                  'updated_at'  => $this->table->posts->updated_at
                            ]);
                        }
                    }
                }

                $report = 'success';
            }
            else
            {
                $this->error->errSave = "<p>Errors found, can not save.</p>";
            }
        }
        else
        {
            $report = $this->error->errName . $this->error->errRole . $this->error->errStatus .
                      $this->error->errMethod . $this->error->errDate . $this->error->errTime .
                      $this->error->errFill . $this->error->errSave . $this->error->errProcess;
        }

        // Done
        return $report;
    }
}
