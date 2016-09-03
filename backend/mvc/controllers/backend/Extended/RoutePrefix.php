<?php namespace mvc\controllers\backend\Extended;

use mvc\controllers\backend\config\Requirement;

class RoutePrefix extends \system\parents\Controller
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
    * @return   view
    */
    public function index()
    {
        $routesPrefix = $this->requirements->model->routes->Clause(
            $this->requirements->sqlGenerator->singleWhere('system=:system &&
            method=:method && path=:path'))->BindParam(['system' => 0, 'method' => 'GET',
            'path' => 'null'])->Result();
        $langs     = $this->requirements->langs;
        $indexLang = $this->requirements->indexLang;

        return Parent::LOAD_VIEW("backend/extended/routes-prefix",
            compact('routesPrefix', 'langs', 'indexLang'));
    }
}
