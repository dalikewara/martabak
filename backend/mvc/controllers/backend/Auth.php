<?php namespace mvc\controllers\backend;

use mvc\controllers\backend\config\Index;
use mvc\controllers\backend\config\Lang;
use mvc\controllers\backend\config\Model as ConfigModel;
use mvc\controllers\backend\config\Error as ConfigError;
use mvc\controllers\universal\SQLGenerator;
use mvc\controllers\universal\AuthValidation;

class Auth extends \system\parents\Controller
{
    private $model, $users, $usernames, $emails, $sqlGenerator, $errors,
            $auth, $langs;

    public function __construct()
    {
        $this->model        = new ConfigModel;
        $this->langs        = new Lang;
        $this->errors       = new ConfigError;
        $this->sqlGenerator = new SQLGenerator;
        $this->auth         = new AuthValidation;
        $this->usernames    = $this->model->users->Select("username")->Result();
        $this->emails       = $this->model->users->Select("email")->Result();
    }

    public function login()
    {
        $index         = new Index;
        $adminAssets   = $index->paths()['admin-assets'];
        $adminLayouts  = $index->paths()['admin-layouts'];
        $dashboard     = $index->routes('dashboard');
        $footerTagline = $this->langs->indications()['footer']['tagline']['en'];

        return Parent::CHECK_RULE('auth') ? header('location: /') :
            Parent::LOAD_VIEW('auth/login', compact('adminAssets', 'dashboard',
            'adminLayouts', 'footerTagline'));
    }

    public function logout()
    {
        Parent::UNSET_RULE('auth');

        return header('location: /');
    }

    public function validation($type)
    {
        switch($type)
        {
            case 'login':
                $password = $_POST[md5('password')];
                $name     = $_POST[md5('name')];

                $this->auth->emailValidation($name) ? TRUE :
                    ($this->auth->usernameValidation($name) ? TRUE :
                    die('Wrong password or username/email format.'));
                $this->auth->passwordValidation($password) ? TRUE :
                    die('Wrong password or username/email format.');
                (is_null($password) OR empty($password) OR !isset($password)) ?
                    die('You must enter your password.') : ($password = md5($password));
                (is_null($name) OR empty($name) OR !isset($name)) ?
                    die('You must enter your email or username.') : TRUE;
                (count($valid = $this->model->users->Clause($this->sqlGenerator->
                    singleWhere('username=:username && password=:password'))
                    ->BindParam(['username' => $name, 'password' => $password])->
                    Result()) > 0) ? TRUE : ((count($valid = $this->model->users->
                    Clause($this->sqlGenerator->singleWhere('email=:email && password=:password'))
                    ->BindParam(['email' => $name, 'password' => $password])->Result()) > 0) ? TRUE :
                    die('Wrong password or username/email.'));

                Parent::SET_RULE('auth', [$valid[0]['fullname'], $valid[0]['username'],
                    $valid[0]['email']]);
                break;

            default:
                die('BAD REQUEST');
                break;
        }

        die('ok');
    }
}
