<?php namespace mvc\controllers\backend;

use mvc\controllers\backend\config\Requirement;
use mvc\controllers\universal\Tokenizer;

class Create extends \system\parents\Controller
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
        $create      = $this->requirements->create();
        $header      = $this->requirements->header();
        $dataContent = [];
        $type        = 'create';
        $langs       = $this->requirements->langs;
        $indexLang   = $this->requirements->indexLang;

        return Parent::LOAD_VIEW('backend/create',
            compact('create', 'header', 'dataContent', 'type', 'langs',
            'indexLang', 'token'));
    }
}
