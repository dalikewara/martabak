<?php namespace mvc\controllers\backend;

use mvc\controllers\backend\config\Requirement;

class Content extends \system\parents\Controller
{
    private $requirements;

    public function __construct()
    {
        $this->requirements = new Requirement;
    }

    public function index()
    {
        $contents  = $this->requirements->contents();
        $header    = $this->requirements->header();
        $langs     = $this->requirements->langs;
        $indexLang = $this->requirements->indexLang;

        return Parent::LOAD_VIEW('backend/contents',
            compact('contents', 'header', 'langs', 'indexLang'));
    }
}
