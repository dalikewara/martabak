<?php namespace mvc\controllers\backend;

use mvc\controllers\backend\config\Requirement;
use mvc\controllers\universal\Tokenizer;

class Setting extends \system\parents\Controller
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
        $tables    = $this->requirements->model->settings;
        $settings  = $this->requirements->settings();
        $header    = $this->requirements->header();
        $contents  = [];
        $langs     = $this->requirements->model->langs->All();
        $setLangs  = $this->requirements->langs;
        $indexLang = $this->requirements->indexLang;
        $userInfo  = $this->requirements->model->users->Clause(
            $this->requirements->sqlGenerator->singleWhere("
            fullname=:fullname && username=:username && email=:email"))->BindParam(
            ['fullname' => $this->GET_RULE('auth')[0],
            'username' => $this->GET_RULE('auth')[1],
            'email'    => $this->GET_RULE('auth')[2]])->Result()[0];

        foreach($tables->All() as $table)
        {
            $contents[$table['meta']] = $table;
        }

        return Parent::LOAD_VIEW('backend/settings',
            compact('settings', 'header', 'contents', 'langs', 'userInfo',
            'indexLang', 'setLangs', 'token'));
    }
}
