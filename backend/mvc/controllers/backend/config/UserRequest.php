<?php namespace mvc\controllers\backend\config;

use mvc\controllers\backend\config\Requirement;

class UserRequest extends \system\parents\Controller
{
    private $requirements;

    /**
    * @return   mixed
    */
    public function __construct()
    {
        $this->requirements = new Requirement;
    }

    /**
    * Get content requests
    *
    * @return   string
    */
    public function contents()
    {

        return $this->requirements->model->contents->Select('slug')->Result();
    }

    /**
    * Get user path requests
    *
    * @return   string
    */
    public function userPaths()
    {

        return $this->requirements->model->routes->Clause($this->requirements->sqlGenerator->
            where('path', ':path', '!='))->BindParam(['path' => 'null'])->Result();
    }
}
