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
        // We checking for Protected Rule data first. If the user already has it,
        // then we will redirected to main page.
        if($this->CHECK_RULE('protected'))
        {
            header('Location: /');
        }
        else
        {
            $path = new \controller\config\Path;
            $uri = new \controller\config\Uri;

            return $this->LOAD_VIEW('auth/login', compact('path', 'uri'));
        }
    }
}
