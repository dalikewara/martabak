<?php namespace mvc\controllers\backend;

use mvc\controllers\backend\config\Requirement;

class Information extends \system\parents\Controller
{
    private $requirements;

    public function __construct()
    {
        $this->requirements = new Requirement;
    }

    public function index()
    {
        $informations = $this->requirements->informations();
        $header       = $this->requirements->header();
        $langs        = $this->requirements->langs;
        $indexLang    = $this->requirements->indexLang;
        $tables       = $this->requirements->model->informations->Range(1)->Result()[0];

        return Parent::LOAD_VIEW('backend/informations',
            compact('informations', 'header', 'langs', 'indexLang', 'tables'));
    }
}
