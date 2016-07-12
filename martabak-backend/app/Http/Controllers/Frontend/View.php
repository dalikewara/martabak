<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Backend\Controller;
use App\Http\Controllers\Backend\Config\Model;

class View extends Controller
{
    protected $theme;

    public function __construct()
    {
        $this->table = new Model;
        $this->theme = $this->table->themes->where('theme_status', 1)->firstOrFail()->theme_name;
    }

    // Homepage
    public function home()
    {
        return theme($this->theme . '.layouts.home');
    }

    // Post
    public function post($content)
    {
        return theme($this->theme . '.layouts.post');
    }

    // Page
    public function page($content)
    {
        return theme($this->theme . '.layouts.page');
    }

    // Media
    public function media($content)
    {
        return theme($this->theme . '.layouts.media');
    }
}
