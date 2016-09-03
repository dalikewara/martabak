<?php namespace mvc\controllers\backend\config;

use mvc\models\User;
use mvc\models\Route;
use mvc\models\Content;
use mvc\models\Layout;
use mvc\models\Home;
use mvc\models\Setting;
use mvc\models\Lang;
use mvc\models\Token;
use mvc\models\Information;

class Model
{
    public $users, $routes, $contents, $layouts, $home, $settings, $langs, $tokens,
        $informations;

    /**
    * @return   mixed
    */
    public function __construct()
    {
        $this->users        = new User;
        $this->routes       = new Route;
        $this->contents     = new Content;
        $this->layouts      = new Layout;
        $this->home         = new Home;
        $this->settings     = new Setting;
        $this->langs        = new Lang;
        $this->tokens       = new Token;
        $this->informations = new Information;
    }
}
