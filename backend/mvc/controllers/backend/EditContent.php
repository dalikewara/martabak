<?php namespace mvc\controllers\backend;

use mvc\controllers\backend\config\Requirement;
use mvc\controllers\universal\Tokenizer;

class EditContent extends \system\parents\Controller
{
    private $requirements, $tokenizer;

    public function __construct()
    {
        $this->requirements = new Requirement;
        $this->tokenizer    = new Tokenizer;
    }

    public function index($title, $slug)
    {
        $token = $this->tokenizer->getTokenFromDB(new \mvc\models\Token, 'token',
            $this->requirements->sqlGenerator->where('user_id',
            $this->requirements->model->users->Select('id')->Clause(
            $this->requirements->sqlGenerator->where('username', ':username'))
            ->BindParam(['username' => $this->GET_RULE('auth')[1]])->Range(1)
            ->Result()[0]));
        $title       = str_replace('+', ' ', $title);
        $slug        = str_replace('+', '/', $slug);
        $create      = $this->requirements->create();
        $header      = $this->requirements->header();
        $langs       = $this->requirements->langs;
        $indexLang   = $this->requirements->indexLang;
        $dataContent = $this->requirements->model->contents->Clause(
            $this->requirements->sqlGenerator->singleWhere('title=:title && slug=:slug'))
            ->BindParam(['title' => $title, 'slug' => "{$slug}"])->Result()[0];
        $type = 'edit';
        $dataFileContent = htmlspecialchars(file_get_contents($this->requirements->index->
            paths()['storage'] . "/" . $dataContent['filename']));
        $editTitle = $langs->indications()['edit_content']['status'][$indexLang];

        return Parent::LOAD_VIEW('backend/create',
            compact('create', 'header', 'dataContent', 'type', 'dataFileContent',
            'langs', 'indexLang', 'token', 'editTitle'));
    }
}
