<?php namespace controller;

class Welcome extends \framework\parents\Controller
{
    /**
    * This method is used to redirect request with '/' to it related view.
    *
    * @return   view   auth/login
    */
    public function home()
    {
        return $this->LOAD_VIEW('welcome');
    }

    /**
    * This method is used to redirect request with '/login' to it related view.
    *
    * @return   view   auth/login
    */
    public function login()
    {
        $path = new \controller\config\Path;
        $uri = new \controller\config\Uri;

        return $this->LOAD_VIEW('auth/login', compact('path', 'uri'));
    }
}
