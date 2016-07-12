<?php

namespace App\Http\Controllers\Backend\Process;

use App\Http\Controllers\Backend\Controller;
use App\Http\Controllers\Backend\Config\Error;
use App\Http\Controllers\Backend\Config\Model;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;

class Edit extends Controller
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
            $process = $request->input(md5('process-option'));
            $type    = $request->input(md5('process-type'));
            $dateNow = date('Y-m-d') . ' ' . date('H:i:s');

            // Type identifier
            switch($type)
            {
                case md5('post'):
                    $type              = 'post';
                    $tables            = $this->table->posts;
                    $tableRelations[0] = $this->table->postTags;
                    $tableRelations[1] = $this->table->postCategories;
                    $mainRelations[0]  = $this->table->tags;
                    $mainRelations[1]  = $this->table->categories;
                    $tableName         = 'title';
                    $tableSlug         = 'slug';
                    $relationId        = 'tag_id';
                    $relationId2       = 'category_id';
                    $typeRelations     = 'tag';
                    $typeRelations2    = 'category';
                    $dateTime          = $request->input(md5('time'));
                    break;

                case md5('page'):
                    $type     = 'page';
                    $tables   = $this->table->pages;
                    $dateTime = $request->input(md5('time'));
                    break;

                case md5('tag'):
                    $type              = 'tag';
                    $tables            = $this->table->tags;
                    $tableRelations[0] = $this->table->postTags;
                    $tableRelations[1] = NULL;
                    $mainRelations[0]  = $this->table->posts;
                    $mainRelations[1]  = NULL;
                    $tableName         = 'tag_name';
                    $tableSlug         = 'tag_slug';
                    $relationId        = 'post_id';
                    $relationId2       = NULL;
                    $typeRelations     = 'post';
                    $typeRelations2    = NULL;
                    break;

                case md5('category'):
                    $type              = 'category';
                    $tables            = $this->table->categories;
                    $tableRelations[0] = $this->table->postCategories;
                    $tableRelations[1] = NULL;
                    $mainRelations[0]  = $this->table->posts;
                    $mainRelations[1]  = NULL;
                    $tableName         = 'category_name';
                    $tableSlug         = 'category_slug';
                    $relationId        = 'post_id';
                    $relationId2       = NULL;
                    $typeRelations     = 'post';
                    $typeRelations2    = NULL;
                    break;

                case md5('media'):
                    $type      = 'media';
                    $tables    = $this->table->media;
                    $mediaType = $request->input(md5('media-type'));
                    break;

                default:
                    $tables = NULL;
                    break;
            }

            if($process == md5('yesIWantToEdit'))
            {
                foreach($tables->all() as $table)
                {
                    if($request->input(md5($type) . '-' . md5($table->id)) != NULL)
                    {
                        $edit = $table->find($table->id);

                        if($type != 'media')
                        {
                            // Table name data validation
                            if(
                                preg_match('/[^a-zA-Z0-9-_ ]/', $request->input(md5('name'))) OR
                                preg_match('/-$/', $request->input(md5('name'))) OR
                                preg_match('/^-/', $request->input(md5('name'))) OR
                                preg_match('/_$/', $request->input(md5('name'))) OR
                                preg_match('/^_/', $request->input(md5('name')))
                              )
                            {
                                $this->error->errName = '<p>Wrong name format.</p>';
                                $this->error->err     = 1;
                            }
                            else
                            {
                                $edit->$tableName = $request->input(md5('name'));
                            }

                            // Table slug data validation
                            if(
                                preg_match('/[^a-zA-Z0-9-_]/', $request->input(md5('slug'))) OR
                                preg_match('/-$/', $request->input(md5('slug'))) OR
                                preg_match('/^-/', $request->input(md5('slug'))) OR
                                preg_match('/_$/', $request->input(md5('slug'))) OR
                                preg_match('/^_/', $request->input(md5('slug')))
                              )
                            {
                                $this->error->errSlug = '<p>Wrong slug format.</p>';
                                $this->error->err     = 1;
                            }
                            else
                            {
                                if($request->input(md5('slug')) != NULL)
                                {
                                    $edit->$tableSlug = $request->input(md5('slug'));
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

                                    $edit->$tableSlug = $result;
                                }
                            }

                            // Table date data validation
                            if($type == 'post' OR $type == 'page')
                            {
                                // date and time
                                if($dateTime != NULL)
                                {
                                    if(preg_match('/[0-9]{4}[-][0-9]{2}[-][0-9]{2}[ ][0-9]{2}[:][0-9]{2}/', $dateTime) OR
                                       preg_match('/[0-9]{4}[-][0-9]{2}[-][0-9]{2}[ ][0-9]{2}[:][0-9]{2}[:][0-9]{2}/', $dateTime))
                                    {
                                        $dateTime = explode(' ', $dateTime);

                                        if($dateTime[0] != NULL AND $dateTime[1] != NULL)
                                        {
                                            // Date
                                            $dateArray   = explode('-', $dateTime[0]);
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
                                                            $this->error->errDate = '<p>Error with <strong>date format</strong>. Please ensure you have enter the correct one.</p>';
                                                            $this->error->err     = 1;
                                                        }
                                                    }
                                                    else
                                                    {
                                                        if(in_array($dateArray[1], $dayChar28) AND $dateArray[2] > $day28)
                                                        {
                                                            $this->error->errDate = '<p>Error with <strong>date format</strong>. Please ensure you have enter the correct one.</p>';
                                                            $this->error->err     = 1;
                                                        }
                                                    }

                                                    if(in_array($dateArray[1], $dayChar30) AND $dateArray[2] > $day30)
                                                    {
                                                        $this->error->errDate = '<p>Error with <strong>date format</strong>. Please ensure you have enter the correct one.</p>';
                                                        $this->error->err     = 1;
                                                    }

                                                    if(in_array($dateArray[1], $dayChar31) AND $dateArray[2] > $day31)
                                                    {
                                                        $this->error->errDate = '<p>Error with <strong>date format</strong>. Please ensure you have enter the correct one.</p>';
                                                        $this->error->err     = 1;
                                                    }

                                                    if($this->error->err != 1)
                                                    {
                                                        $dateTime[0] = $dateArray[0] . '-' . $dateArray[1] . '-' . $dateArray[2];
                                                    }
                                                }
                                                else
                                                {
                                                    $this->error->errDate = '<p>Error with <strong>date format</strong>. Please ensure you have enter the correct one.</p>';
                                                    $this->error->err     = 1;
                                                }
                                            }
                                            else
                                            {
                                                $this->error->errDate = '<p>Error with <strong>date format</strong>. Please ensure you have enter the correct one.</p>';
                                                $this->error->err     = 1;
                                            }

                                            // Time
                                            $timeArray = explode(':', $dateTime[1]);
                                            $hourTop   = 24;
                                            $minuteTop = 60;

                                            if($timeArray[0] > $hourTop)
                                            {
                                                $this->error->errTime = '<p>Error with <strong>time format</strong>. Please ensure you have enter the correct one.</p>';
                                                $this->error->err     = 1;
                                            }

                                            if($timeArray[1] > $minuteTop)
                                            {
                                                $this->error->errTime = '<p>Error with <strong>time format</strong>. Please ensure you have enter the correct one.</p>';
                                                $this->error->err     = 1;
                                            }

                                            if(!empty($timeArray[2]) AND $timeArray[2] > $minuteTop)
                                            {
                                                $this->error->errTime = '<p>Error with <strong>time format</strong>. Please ensure you have enter the correct one.</p>';
                                                $this->error->err     = 1;
                                            }

                                            if($this->error->err != 1)
                                            {
                                                if(!empty($timeArray[2]))
                                                {
                                                    $dateTime[1] = $dateTime[1];
                                                }
                                                else
                                                {
                                                    $dateTime[1] = $dateTime[1] . ':00';
                                                }
                                            }

                                            $customCreatedAt = $dateTime[0] . ' ' . $dateTime[1];
                                            $customUpdatedAt = $customCreatedAt;
                                        }

                                        if($this->error->err != 1)
                                        {
                                            $edit->created_at = $customCreatedAt;
                                            $edit->updated_at = $customUpdatedAt;

                                            if($customCreatedAt > $dateNow)
                                            {
                                                $edit->status_id  = 3;
                                            }
                                        }
                                        else
                                        {
                                            $this->error->errStatus = "<p>Can't process to update. Errors found.</p>";
                                            $this->error->err       = 1;
                                        }
                                    }
                                    else
                                    {
                                        $this->error->errDate = '<p>Error with <strong>date & time format</strong>. Please ensure you have enter the correct one.</p>';
                                        $this->error->err     = 1;
                                    }

                                }
                                else
                                {
                                    $this->error->errFill = '<p>Date & time can not be empty.</p>';
                                    $this->error->err     = 1;
                                }
                            }

                            // Optional table
                            switch($type)
                            {
                                case 'post':
                                    if($request->input(md5('content')) != NULL)
                                    {
                                        $edit->content = $request->input(md5('description'));
                                    }
                                    break;
                                case 'category':
                                    $edit->category_description = $request->input(md5('description'));
                                    break;
                                default:
                                    break;
                            }

                            // Table relations
                            for($x = 0; $x < 2; $x++)
                            {
                                $y = 0;
                                $z = 0;
                                $a = 0;
                                $b = 0;
                                $c = 0;

                                if($x == 1)
                                {
                                    $relationId    = $relationId2;
                                    $typeRelations = $typeRelations2;
                                }

                                if(($mainRelations[$x] != NULL OR count($mainRelations[$x]) > 0) AND $tableRelations[$x] != NULL)
                                {
                                    $relations[$x] = $tableRelations[$x]->where($type . '_id', $table->id)->get();

                                    // Catch default inputs
                                    foreach($mainRelations[$x]->all() as $mainRelation)
                                    {
                                        if($request->input(md5($typeRelations) . '-' . md5('relation') . '-' . md5($mainRelation->id)) != NULL OR $request->input(md5($typeRelations)) == md5($mainRelation->id))
                                        {
                                            $inputs[$x][$y] = $mainRelation->id;
                                        }

                                        $y++;
                                    }

                                    // Get default relations
                                    if(count($relations[$x]) > 0)
                                    {
                                        foreach($relations[$x] as $relation)
                                        {
                                            $items[$x][$z] = $relation->$relationId;

                                            $z++;
                                        }
                                    }

                                    // Process to final relations
                                    if(!empty($inputs[$x]))
                                    {
                                        if(!empty($items[$x]))
                                        {
                                            foreach($items[$x] as $item)
                                            {
                                                if(!in_array($item, $inputs[$x]))
                                                {
                                                    $values[$x][$a] = $item;
                                                }

                                                $a++;
                                            }

                                            foreach($inputs[$x] as $input)
                                            {
                                                if(!in_array($input, $items[$x]))
                                                {
                                                    $tableRelations[$x]->insert(
                                                    [
                                                        $relationId   => $input,
                                                        $type . '_id' => $table->id
                                                    ]);
                                                }
                                            }
                                        }
                                        else
                                        {
                                            foreach($inputs[$x] as $input)
                                            {
                                                $tableRelations[$x]->insert(
                                                [
                                                    $relationId   => $input,
                                                    $type . '_id' => $table->id
                                                ]);
                                            }
                                        }
                                    }
                                    else
                                    {
                                        if(!empty($items[$x]))
                                        {
                                            foreach($items[$x] as $item)
                                            {
                                                $values[$x][$b] = $item;

                                                $b++;
                                            }
                                        }
                                    }

                                    if(!empty($values[$x]))
                                    {
                                        foreach($relations[$x] as $relation)
                                        {
                                            if(in_array($relation->$relationId, $values[$x]))
                                            {
                                                $finals[$x][$c] = $relation->id;
                                            }

                                            $c++;
                                        }
                                    }
                                }
                            }
                        }
                        else
                        {
                            switch($mediaType)
                            {
                                case md5('picture'):
                                    $edit->meta_1 = $request->input(md5('media-title'));
                                    $edit->meta_2 = $request->input(md5('media-caption'));
                                    $edit->meta_3 = $request->input(md5('media-alt'));
                                    $edit->meta_4 = $request->input(md5('media-desc'));
                                    break;
                            }
                        }

                        // Save data
                        if($this->error->err == 0)
                        {
                            $edit->save();
                        }
                    }
                }

                if($type != 'media')
                {
                    // Deleting table relations
                    for($d = 0; $d < 2; $d++)
                    {
                        if(!empty($finals[$d]))
                        {
                            foreach($finals[$d] as $final)
                            {
                                if(!empty($tableRelations[$d]))
                                {
                                    $tableRelations[$d]->where('id', $final)->orWhere('id', $final)->delete();
                                }
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

        // If request method == GET or (not POST) and user is not exist
        else
        {
            $this->error->errMethod = '<p>Method not allowed.</p>';
            $this->error->err     = 1;
        }
        // END request method and user checker---------------------------------

        // Final errors handler
        if($this->error->err == 0)
        {
            $report = 'success';
        }
        else
        {
            $report = $this->error->errMethod . $this->error->errDelete . $this->error->errName .
                      $this->error->errSlug . $this->error->errProcess . $this->error->errDate .
                      $this->error->errStatus . $this->error->errFill;
        }

        // Done
        return $report;
    }
}
