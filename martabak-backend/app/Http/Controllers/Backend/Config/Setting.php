<?php

namespace App\Http\Controllers\Backend\Config;

use App\Http\Controllers\Backend\Config\Model;
use App\Http\Controllers\Backend\Controller;

class Setting extends Controller
{
    public $themeColor, $layout, $route, $content, $website;

    public function __construct()
    {
        $this->table      = new Model;
        $this->themeColor = $this->table->colors->find(1)->firstOrFail()->theme_color;
        $this->layout     = $this->table->layouts->find(1)->firstOrFail();
        $this->route      = $this->table->routes->find(1)->firstOrFail();
        $this->content    = $this->table->contents->find(1)->firstOrFail();
        $this->website    = $this->table->websites->find(1)->firstOrFail();
    }
}
