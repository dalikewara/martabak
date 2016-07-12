<?php

namespace App\Http\Controllers\Backend\Process;

use App\Http\Controllers\Backend\Controller;
use App\Http\Controllers\Backend\Config\Error;
use App\Http\Controllers\Backend\Config\Model;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;

class Status extends Controller
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
            $process = $request->input(md5('process-option-status'));
            $type     = $request->input(md5('process-type'));
            $status   = $request->input(md5('status'));
            $dateNow  = date('Y-m-d') . ' ' . date('H:i:s');

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

                case md5('theme'):
                    $type         = 'theme';
                    $tables       = $this->table->themes;
                    $activeStatus = $request->input(md5('active-status'));

                    if($activeStatus ==  md5('active'))
                    {
                        $activeStatus = 1;
                    }
                    else
                    {
                        $activeStatus = 0;
                    }
                    break;

                case md5('notification'):
                      $type   = 'notification';
                      $tables = $this->table->notifications;
                      break;

                default:
                    $type   = 'undefinied';
                    $tables = NULL;
                    break;
            }

            // Process
            if($tables != NULL)
            {
                if($process == md5('yesIWantToChangeStatus'))
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

                    // Change status
                    foreach($tables->all() as $table)
                    {
                        if($type == 'post' || $type == 'page')
                        {
                            if(in_array(md5($table->id), $actArray))
                            {
                                $edit = $tables->find($table->id);

                                switch($status)
                                {
                                    case md5('publish'):
                                        $edit->status_id  = 1;
                                        $edit->created_at = $dateNow;
                                        $edit->updated_at = $dateNow;
                                        break;

                                    case md5('draft'):
                                        $edit->status_id = 2;
                                        break;

                                    case md5('schedule'):
                                        $scheduleDate = $request->input(md5('schedule-date-action'));

                                        // Schedule date and time
                                        if($scheduleDate != NULL)
                                        {
                                            if(preg_match('/[0-9]{4}[-][0-9]{2}[-][0-9]{2}[ ][0-9]{2}[:][0-9]{2}/', $scheduleDate))
                                            {
                                                if($scheduleDate > $dateNow)
                                                {
                                                    $scheduleDate = explode(' ', $scheduleDate);

                                                    if($scheduleDate[0] != NULL AND $scheduleDate[1] != NULL)
                                                    {
                                                        // Date
                                                        $dateArray   = explode('-', $scheduleDate[0]);
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
                                                                    $scheduleDate[0] = $dateArray[0] . '-' . $dateArray[1] . '-' . $dateArray[2];
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
                                                        $timeArray = explode(':', $scheduleDate[1]);
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

                                                        if($this->error->err != 1)
                                                        {
                                                            $scheduleDate[1] = $scheduleDate[1] . ':00';
                                                        }

                                                        $customCreatedAt = $scheduleDate[0] . ' ' . $scheduleDate[1];
                                                        $customUpdatedAt = $customCreatedAt;
                                                    }

                                                    if($this->error->err != 1)
                                                    {
                                                        $edit->created_at = $customCreatedAt;
                                                        $edit->updated_at = $customUpdatedAt;
                                                        $edit->status_id  = 3;
                                                    }
                                                    else
                                                    {
                                                        $this->error->errStatus = "<p>Can't process to create schedule. Errors found.</p>";
                                                        $this->error->err       = 1;
                                                    }
                                                }
                                                else
                                                {
                                                    $this->error->errRole = '<p>You must enter <strong>date & time</strong> that newer from now.</p>';
                                                    $this->error->err     = 1;
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
                                            $this->error->errFill = '<p>You have to set date & time (newer from now) to can make schedule.</p>';
                                            $this->error->err     = 1;
                                        }
                                        break;
                                    default:
                                        break;
                                }

                                if($this->error->err != 1)
                                {
                                    if($edit->save())
                                    {
                                      $this->error->err = 0;
                                    }
                                    else
                                    {
                                        $this->error->errSave = '<p>Update failed, errors found.</p>';
                                        $this->error->err     = 1;
                                    }
                                }
                            }
                        }
                        elseif($type == 'theme')
                        {
                            if($request->input(md5($type) . '-' . md5($table->id)) != NULL)
                            {
                                if(($old = $tables->where('theme_status', '1')->first()) != NULL)
                                {
                                    $old->theme_status = 0;
                                    $old->save();
                                }

                                $themeStatus               = $tables->find($table->id);
                                $themeStatus->theme_status = $activeStatus;
                                $themeStatus->save();
                            }
                        }
                        elseif($type == 'notification')
                        {
                            if($request->input(md5($type) . '-' . md5($table->id)) != NULL)
                            {
                                $notifStatus         = $tables->find($table->id);
                                $notifStatus->status = 1;
                                $notifStatus->save();
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
            $report = $this->error->errMethod . $this->error->errProcess .
                      $this->error->errTable . $this->error->errSave . $this->error->errStatus .
                      $this->error->errRole . $this->error->errDate . $this->error->errFill .
                      $this->error->errTime;
        }

        // Done
        return $report;
    }
}
