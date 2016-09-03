<?php namespace mvc\controllers\protected_rule;

use mvc\controllers\backend\config\Index;

class RedirectTo extends \system\parents\Controller
{
    private $index, $login;

    public function __construct()
    {
        $this->index = new Index;
        $this->login = $this->index->routes('login');
    }

    public function login()
    {
        header("location: {$this->login}");
    }
}
