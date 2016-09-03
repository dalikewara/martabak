<?php namespace mvc\controllers\backend\Extended;

use mvc\controllers\backend\config\Requirement;

class InsertLayout extends \system\parents\Controller
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
    * @param    string   $type
    * @return   view
    */
    public function index($type)
    {
        $layoutsPrefix = $this->requirements->model->layouts->All();
        $layoutsPrefix = array_map(function($a){return array_merge($a,
            ['content' => file_get_contents($this->requirements->index->paths()['storage'] .
            "/layouts" . '/' . $a['filename'])]);}, $layoutsPrefix);
        $langs     = $this->requirements->langs;
        $indexLang = $this->requirements->indexLang;

        return Parent::LOAD_VIEW("backend/extended/insert-layouts",
            compact('layoutsPrefix', 'langs', 'indexLang'));
    }
}
