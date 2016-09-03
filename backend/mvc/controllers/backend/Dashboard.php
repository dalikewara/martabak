<?php namespace mvc\controllers\backend;

use mvc\controllers\backend\config\Requirement;

class Dashboard extends \system\parents\Controller
{
    private $requirements;

    public function __construct()
    {
        $this->requirements = new Requirement;
    }

    public function index()
    {
        $dashboard = $this->requirements->dashboard();
        $header    = $this->requirements->header();
        $layouts   = $this->requirements->model->layouts->Clause(
            $this->requirements->sqlGenerator->orderBy('id', 'DESC'))->
            Range(10)->Result();
        $contents = $this->requirements->model->contents->Clause(
            $this->requirements->sqlGenerator->orderBy('id', 'DESC'))->
            Range(10)->Result();
        $routes = $this->requirements->model->routes->Clause(
            $this->requirements->sqlGenerator->orderBy('id', 'DESC'))->
            Range(10)->Result();
        $langs     = $this->requirements->langs;
        $indexLang = $this->requirements->indexLang;

        return Parent::LOAD_VIEW('backend/dashboard',
            compact('dashboard', 'header', 'layouts', 'contents', 'routes', 'langs',
            'indexLang'));
    }
}
