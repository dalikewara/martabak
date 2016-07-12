<?php

namespace App\Http\Controllers\Backend\Homeland;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Backend\Controller;
use App\Http\Controllers\Backend\Config\Model;
use App\Http\Controllers\Backend\Config\Setting;
use App\Http\Controllers\Backend\Config\Dir;
use App\Http\Controllers\Backend\Homeland\Modal;
use Auth;

class All extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->table   = new Model;
        $this->setting = new Setting;
        $this->dir     = new Dir;
        $this->modal   = new Modal;
    }

    public function content($content)
    {
        // Global variabels
        $modal       = $this->modal;
        $dir         = $this->dir;
        $themeColor  = $this->setting->themeColor;
        $route       = $this->setting->route;
        $status      = 1;
        $paginate    = 12;
        $sortedId    = 'id';
        $sortedIndex = 'DESC';
        $search      = '';
        $page        = 1;
        $pageNext    = '';
        $pagePrev    = '';
        $pageLists   = array('');
        $pageMore    = '';

        if($content == 'commentators')
        {
            $tables = $this->table->guests;
        }
        elseif($content == 'pictures')
        {
            $tables = $this->table->media;
        }
        else
        {
            $tables = $this->table->$content;
        }

        // Contents condition
        switch($content)
        {
            case 'posts':
                $title = 'title';
                break;

            case 'pages':
                $title = 'title';
                break;

            case 'tags':
                $title    = 'tag_name';
                $paginate = 20;
                break;

            case 'categories':
                $title = 'category_name';
                break;

            case 'themes':
                $title = 'theme_name';
                break;

            case 'notifications':
                $dateNow   = date('Y-m-d') . ' ' . date('H:s:i');
                $dateArray = explode(' ', $dateNow);
                $dateDate  = explode('-', $dateArray[0]);
                $dateSub   = $dateDate[2] - 50;

                if($dateSub > 0)
                {
                    if($dateSub < 10)
                    {
                        $dateBottom = $dateDate[0] . '-' . $dateDate[1] . '-0' . $dateSub . ' ' . $dateArray[1];
                    }
                    else
                    {
                        $dateBottom = $dateDate[0] . '-' . $dateDate[1] . '-' . $dateSub . ' ' . $dateArray[1];
                    }
                }
                else
                {
                    if(($dateDate[1] - 1) < 10)
                    {
                        $dateBottom = $dateDate[0] . '-0' . ($dateDate[1] - 1) . '-' . (28 + $dateSub) . ' ' . $dateArray[1];

                        if((28 + $dateSub) < 10)
                        {
                            $dateBottom = $dateDate[0] . '-0' . ($dateDate[1] - 1) . '-0' . (28 + $dateSub) . ' ' . $dateArray[1];
                        }
                    }
                    else
                    {
                        $dateBottom = $dateDate[0] . '-' . ($dateDate[1] - 1) . '-' . (28 + $dateSub) . ' ' . $dateArray[1];

                        if((28 + $dateSub) < 10)
                        {
                            $dateBottom = $dateDate[0] . '-' . ($dateDate[1] - 1) . '-0' . (28 + $dateSub) . ' ' . $dateArray[1];
                        }
                    }

                    if(($dateDate[1] - 1) < 1 )
                    {
                        $dateBottom = ($dateDate[0] - 1) . '-12-' . (28 + $dateSub) . ' ' . $dateArray[1];

                        if((28 + $dateSub) < 10)
                        {
                            $dateBottom = ($dateDate[0] - 1) . '-12-0' . (28 + $dateSub) . ' ' . $dateArray[1];
                        }
                    }
                }
                break;

            default:
                break;
        }

        // Page
        if(!empty($_GET['page']) AND $_GET['page'] != 1)
        {
            $page = $_GET['page'];
        }

        // Sorting contents
        if($content != 'comments')
        {
            if(!empty($_GET['status']))
            {
                $status = $_GET['status'];
            }
        }
        else
        {
            if(!empty($_GET['status']))
            {
                $status = $_GET['status'];

                switch($status)
                {
                    case 2;
                        $typeStatus = 'status';
                        $status     = 1;
                        break;

                    case 3;
                        $typeStatus = 'status';
                        $status     = 0;
                        break;

                    case 4;
                        $typeStatus = 'spam';
                        $status     = 1;
                        break;

                    case 5;
                        $typeStatus = 'blacklist';
                        $status     = 1;
                        break;

                    default:
                        $typeStatus = 'latest';
                        break;
                }
            }
        }

        if(!empty($_GET['sortedBy']))
        {
            if($_GET['sortedBy'] == 'title' OR $_GET['sortedBy'] == 'older')
            {
                $sortedIndex = 'ASC';
            }

            if($_GET['sortedBy'] == 'title')
            {
                $sortedId = $title;
            }
        }

        if(!empty($_GET['paginate']))
        {
            $paginate = $_GET['paginate'];
        }

        // Content default variabel
        if($content == 'posts' OR $content == 'pages')
        {
            $contents = $tables->orderBy($sortedId, $sortedIndex)->where('status_id', $status);;
        }
        elseif($content == 'comments')
        {
            if($typeStatus == 'latest')
            {
                $contents = $tables->orderBy($sortedId, $sortedIndex)->where(['spam' => 0, 'blacklist' => 0]);
            }
            elseif($typeStatus == 'status')
            {
                $contents = $tables->orderBy($sortedId, $sortedIndex)->where([$typeStatus => $status, 'spam' => 0, 'blacklist' => 0]);
            }
            else
            {
                $contents = $tables->orderBy($sortedId, $sortedIndex)->where($typeStatus, $status);
            }
        }
        elseif($content == 'notifications')
        {
            if($status == 2)
            {
                $contents = $tables->orderBy($sortedId, $sortedIndex)->where('status', 1);
            }
            elseif($status == 3)
            {
                $contents = $tables->orderBy($sortedId, $sortedIndex)->where('status', 0);
            }
            elseif($status == 4)
            {
                $contents = $tables->orderBy($sortedId, $sortedIndex)->where('type', 1);
            }
            elseif($status == 5)
            {
                $contents = $tables->orderBy($sortedId, $sortedIndex)->where('type', 2);
            }
            else
            {
                $contents = $tables->orderBy($sortedId, $sortedIndex)->where('created_at', '>', $dateBottom);
            }
        }
        else
        {
            $contents = $tables->orderBy($sortedId, $sortedIndex);
        }

        // Search
        if(!empty($_GET['search']) AND $_GET['search'] != '')
        {
            $search      = str_replace('-', ' ', $_GET['search']);
            $searchMatch = '';
            $x           = 0;

            foreach($tables->all() as $table)
            {
                if(preg_match('/(' . $search . ')/i', $table->$title))
                {
                    $searchMatch[$x] = $table->$title;
                    $x++;
                }
            }

            $contents = $contents->whereIn($title, $searchMatch);
        }

        // paginate
        $totalContents = count($contents->get());

        if($totalContents == 0)
        {
            $totalContents = 1;
        }

        for($x = 0; $x <= $totalContents; $x++)
        {
            $pageArray[$x] = $x * $paginate;

            if($pageArray[$x] >= $totalContents)
            {
                unset($pageArray[$x]);

                break;
            }
        }

        if(count($pageArray) > 1)
        {
            for($x = 1; $x <= ($y = count($pageArray)); $x++)
            {
                if($page == $x)
                {
                    $pageLists[$x] = '<li class="sort page-list pointer menu-pagination-active" value="page-' . $x . '">' . $x . '</li>';
                }
                else
                {
                    if($x < 8)
                    {
                        $pageLists[$x] = '<li class="sort page-list pointer" value="page-' . $x . '">' . $x . '</li>';
                    }
                    else
                    {
                        if(($page + 3) >= 8)
                        {
                            if($page + 3 >= $y)
                            {
                                $pageLists[$x] = '<li class="sort page-list pointer" value="page-' . $x . '">' . $x . '</li>';
                            }
                            else
                            {
                                for($z = $page; $z <= ($page + 3); $z++)
                                {
                                    if(empty($pageLists[$z]))
                                    {
                                        $pageLists[$x] = '<li class="sort page-list pointer" value="page-' . $x . '">' . $x . '</li>';
                                        $x++;
                                    }
                                }
                            }
                        }
                    }
                }

                if($page > 4)
                {
                    if($page < ($y - 3))
                    {
                        for($a = 1; $a < ($page - 3); $a++)
                        {
                            unset($pageLists[$a]);
                        }
                    }
                    else
                    {
                        for($a = 1; $a < ($y - 6); $a++)
                        {
                            unset($pageLists[$a]);
                        }
                    }
                }
            }

            if($y >= 8 AND $page <= ($y - 4))
            {
                $pageMore = '<li class="page-unactive disable-pointer-events">...</li> <li class="sort page-list pointer" value="page-' . $y . '">' . $y . '</li>';
            }
            else
            {
                $pageMore = '';
            }

            if($y >= 8)
            {
                $pageNext = '<li class="sort pointer page-nextprev" value="next-' . ($page + 1) . '">></li> <li class="sort pointer page-nextprev" value="nexttop-' . count($pageArray) . '">>></li>';
                $pagePrev = '<li class="sort pointer page-nextprev" value="prevtop-1"><<</li> <li class="sort pointer page-nextprev" value="prev-' . ($page - 1) . '"><</li>';

                if($page == 1)
                {
                    $pagePrev = '<li class="smoke page-unactive disable-pointer-events"><<</li> <li class="smoke page-unactive disable-pointer-events"><</li>';
                }

                if($page == $y)
                {
                    $pageNext = '<li class="smoke page-unactive disable-pointer-events">></li> <li class="smoke page-unactive disable-pointer-events">>></li>';
                }
            }
            else
            {
                if($y != 1)
                {
                    $pageNext = '<li class="sort pointer page-nextprev" value="next-' . ($page + 1) . '">></li>';
                    $pagePrev = '<li class="sort pointer page-nextprev" value="prev-' . ($page - 1) . '"><</li>';

                    if($page == 1)
                    {
                        $pagePrev = '<li class="page-unactive disable-pointer-events"><</li>';
                    }

                    if($page == $y)
                    {
                        $pageNext = '<li class="page-unactive disable-pointer-events">></li>';
                    }
                }
            }
        }

        $contents = $contents->skip($pageArray[$page - 1])->take($paginate)->get();

        // Naming status
        switch($status)
        {
            case '1':
                $status = 'published';
                break;

            case '2':
                $status = 'drafted';
                break;

            case '3':
                $status = 'scheduled';
                break;

            default:
                $status = 'Undefined';
                break;
        }

        return view('admin.extended.all-' . $content, compact('modal', 'dir', 'route', 'themeColor', 'contents', 'status', 'sortedBy', 'paginate', 'search', 'pageArray', 'pageLists', 'pageMore', 'pageNext', 'pagePrev'));
    }

    public function profilePicture()
    {
        $themeColor = $this->setting->themeColor;
        $dir        = $this->dir;
        $contents   = $this->table->media->orderBy('id', 'DESC')->where('type', 1)->get();

        return view('admin.extended.show-profile-picture', compact('contents', 'dir', 'themeColor'));
    }
}
