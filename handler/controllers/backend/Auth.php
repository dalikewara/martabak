<?php namespace controller\backend;

use controller\config\Path;
use controller\config\Uri;
use controller\config\Model;
use tool\Validation;

class Auth extends \framework\parents\Controller
{
    // The following variables have access in this class only.
    private $path, $uri, $model, $validation;

    function __construct()
    {
        // Prepared requirements
        $this->path = new Path;
        $this->uri = new Uri;
        $this->model = new Model;
        $this->validation = new Validation;
    }

    /**
    * @return   view   backend/dashboard
    */
    public function login()
    {
        $getBack = function($message = null)
        {
            $this->LOAD_VIEW('auth/login', compact('message'));
        };
        $username = isset($_POST['username']) ? $_POST['username'] : die($getBack());
        $password = isset($_POST['password']) ? $_POST['password'] : die($getBack());

        // Data validation...

        // Comparing data
        if(count($this->model->User->select('username')->clause('WHERE username=:username')
        ->bindParams(['username' => $username])->get(1)) > 0 AND count($this->model->User->select(
        'password')->clause('WHERE password=:password')->bindParams(['password' => $password])->get(1)) > 0)
        {
            header('Location: ' . $this->uri->backend);
        }
        else
        {
            $getBack('Username or password doens\'t match.');
        }
    }

    /**
    * @return   view   backend/dashboard
    */
    public function logout()
    {
        // $this->DESTROY_RULE('protected');
    }
}
