<?php namespace mvc\controllers\backend\Extended;

use mvc\controllers\backend\config\Requirement;
use mvc\controllers\universal\Tokenizer;

class Sort extends \system\parents\Controller
{
    private $requirements, $tokenizer;

    /**
    * @return   mixed
    */
    public function __construct()
    {
        $this->requirements = new Requirement;
        $this->tokenizer    = new Tokenizer;
    }

    /**
    * @param    string   $type
    * @return   view
    */
    public function index($type)
    {
        $token = $this->tokenizer->getTokenFromDB(new \mvc\models\Token, 'token',
            $this->requirements->sqlGenerator->where('user_id',
            $this->requirements->model->users->Select('id')->Clause(
            $this->requirements->sqlGenerator->where('username', ':username'))
            ->BindParam(['username' => $this->GET_RULE('auth')[1]])->Range(1)
            ->Result()[0]));
        $langs     = $this->requirements->langs;
        $indexLang = $this->requirements->indexLang;

        return Parent::LOAD_VIEW("backend/extended/sort-properties",
            compact('type', 'langs', 'indexLang', 'token'));
    }
}
