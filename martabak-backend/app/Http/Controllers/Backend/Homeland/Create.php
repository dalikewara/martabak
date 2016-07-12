<?php

namespace App\Http\Controllers\Backend\Homeland;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Backend\Controller;
use App\Http\Controllers\Backend\Config\Model;
use App\Http\Controllers\Backend\Config\Setting;
use App\Http\Controllers\Backend\Config\Dir;
use Auth;

class Create extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->table   = new Model;
        $this->setting = new Setting;
        $this->dir     = new Dir;
    }

    public function content($content)
    {
        $dir           = $this->dir;
        $themeColor    = $this->setting->themeColor;
        $layout        = $this->setting->layout;
        $route         = $this->setting->route;
        $indexHomeland = '<span id="index-homeland" type="hidden" value="' . $route->homeland_route . '"></span>';

        return view('admin.create-' . $content, compact('dir', 'themeColor', 'layout', 'route', 'indexHomeland'));
    }

    public function all($content, $all)
    {
        $dir        = $this->dir;
        $themeColor = $this->setting->themeColor;
        $layout     = $this->setting->layout;
        $route      = $this->setting->route;
        $contents   = $this->table->$all;

        return view('admin.extended.create-relations', compact('content', 'all', 'dir', 'themeColor', 'layout', 'route', 'contents'));
    }
}
