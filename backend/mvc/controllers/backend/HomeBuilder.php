<?php namespace mvc\controllers\backend;

use mvc\controllers\backend\config\Requirement;
use mvc\controllers\universal\Tokenizer;

class HomeBuilder extends \system\parents\Controller
{
    private $requirements, $tokenizer;

    public function __construct()
    {
        $this->requirements = new Requirement;
        $this->tokenizer    = new Tokenizer;
    }

    public function index()
    {
        $token = $this->tokenizer->getTokenFromDB(new \mvc\models\Token, 'token',
            $this->requirements->sqlGenerator->where('user_id',
            $this->requirements->model->users->Select('id')->Clause(
            $this->requirements->sqlGenerator->where('username', ':username'))
            ->BindParam(['username' => $this->GET_RULE('auth')[1]])->Range(1)
            ->Result()[0]));
        $homeBuilder   = $this->requirements->create();
        $header        = $this->requirements->header();
        $layoutsPrefix = $this->requirements->model->layouts->All();
        $fileName      = md5('default-home-layout') . '.php';
        $builder       = $this->requirements->model->home->Clause(
            $this->requirements->sqlGenerator->where('filename', ':filename'))->BindParam(
            ['filename' => $fileName])->Range(1)->Result()[0];
        $fileContent = htmlspecialchars(file_get_contents($this->requirements->index->
            paths()['storage'] . "/home/{$fileName}"));
        $langs     = $this->requirements->langs;
        $indexLang = $this->requirements->indexLang;

        return Parent::LOAD_VIEW('backend/home-builder',
            compact('homeBuilder', 'header', 'layoutsPrefix', 'builder',
            'fileContent', 'langs', 'indexLang', 'token'));
    }
}
