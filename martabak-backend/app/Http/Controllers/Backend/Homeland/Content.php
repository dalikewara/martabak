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

class Content extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->table   = new Model;
        $this->setting = new Setting;
        $this->modal   = new Modal;
        $this->dir     = new Dir;
    }

    public function content($content)
    {
        $dir           = $this->dir;
        $modal         = $this->modal;
        $contents      = $this->table;
        $themeColor    = $this->setting->themeColor;
        $layout        = $this->setting->layout;
        $route         = $this->setting->route;
        $indexHomeland = '<span id="index-homeland" type="hidden" value="' . $route->homeland_route . '"></span>';

        // Notification
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

        return view('admin.' . $content, compact('dir', 'modal', 'dateNow', 'dateBottom', 'contents', 'themeColor', 'layout', 'route', 'indexHomeland'));
    }

    public function setting($content)
    {
        $dir            = $this->dir;
        $modal          = $this->modal;
        $contents       = $this->table;
        $themeColor     = $this->setting->themeColor;
        $layout         = $this->setting->layout;
        $route          = $this->setting->route;
        $contentSetting = $this->setting->content;
        $website        = $this->setting->website;
        $indexHomeland  = '<span id="index-homeland" type="hidden" value="' . $route->homeland_route . '"></span>';

        return view('admin.settings.' . $content, compact('dir', 'modal', 'contents', 'themeColor', 'layout', 'route', 'indexHomeland', 'contentSetting', 'website'));
    }

    public function theme($content)
    {
        $dir            = $this->dir;
        $themeColor     = $this->setting->themeColor;
        $layout         = $this->setting->layout;
        $route          = $this->setting->route;
        $indexHomeland  = '<span id="index-homeland" type="hidden" value="' . $route->homeland_route . '"></span>';

        // Themes list
        $x           = 0;
        $y           = 0;
        $themes      = $this->table->themes->orderBy('id', 'DESC')->get();
        $path        = $_SERVER['DOCUMENT_ROOT'] . '/martabak-frontend/user/theme';
        $folderLists = array_diff(scandir($path), array('.', '..'));

        if(count($themes->all()) != 0)
        {
            foreach($themes as $theme)
            {
                $tableLists[$x] = $theme->theme_name;

                $x++;
            }
        }
        else
        {
            $tableLists = array('!', '!', '!');
        }

        foreach($folderLists as $folderList)
        {
            if(!in_array($folderList, $tableLists))
            {
                $y = 0;
                $z = 0;

                // Theme info
                $info = fopen($_SERVER['DOCUMENT_ROOT'] . '/martabak-frontend/user/theme/' . $folderList . '/info.txt', 'r') or die('Unable to open file!');

                while(!feof($info))
                {
                    $getInfo       = fgets($info);
                    $infoArray[$y] = explode('=', $getInfo);

                    $y++;
                }

                fclose($info);

                foreach($infoArray as $array)
                {
                    if(!empty($array[1]))
                    {
                        $newInfo[preg_replace('/\s+/', '', $array[0])] = preg_replace('/(^\s+)|(\s+$)/', '', $array[1]);

                        $z++;
                    }
                }

                // Saving
                $dateNow = date('Y-m-d') . ' ' . date('H:s:i');

                $this->table->themes->insert(
                [
                    'author'             => $newInfo['theme-author'],
                    'title'              => $newInfo['theme-title'],
                    'theme_name'         => $newInfo['theme-slugname'],
                    'theme_status'       => 0,
                    'theme_version'      => $newInfo['theme-version'],
                    'theme_description'  => $newInfo['theme-description'],
                    'theme_category'     => $newInfo['theme-category'],
                    'theme_price'        => $newInfo['theme-price'],
                    'theme_url'          => $newInfo['theme-url'],
                    'theme_date_release' => $newInfo['theme-date-release'],
                    'theme_pic'          => $newInfo['theme-pic'],
                    'created_at'         => $dateNow,
                    'updated_at'         => $dateNow
                ]);
            }
        }

        return view('admin.theme.' . $content, compact('dir', 'themeColor', 'layout', 'route', 'indexHomeland', 'themes'));
    }
}
