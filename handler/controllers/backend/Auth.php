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
    * This will validating user data for log in and creating new Protected Rule
    * (protected) data.
    *
    * @return   mixed
    */
    public function login()
    {
        // Prepared variables
        $getBack = function($message = null)
        {
            $uri = $this->uri;
            $path = $this->path;

            $this->LOAD_VIEW('auth/login', compact('message', 'uri', 'path'));
        };
        $username = (isset($_POST['username']) AND !empty($_POST['username']))
            ? $_POST['username'] : die($getBack('Unknown username data!'));
        $password = (isset($_POST['password']) AND !empty($_POST['password']))
            ? $_POST['password'] : die($getBack('Unknown password data!'));

        // Data validation.
        if(!$this->validation->username($username))
        {
            die($getBack('Wrong username format!'));
        }

        if(!$this->validation->password($password))
        {
            die($getBack('Wrong password format!'));
        }

        // If the data passed the validation, then we will generate new valid data from Database
        // based on the user data.
        $data = $this->model->User->clause('WHERE username=:username AND password=:password')
            ->bindParams(['username' => $username, 'password' => md5($password)])->get(1);

        // Checking for valid data.
        if(count($data) > 0)
        {
            // This variable will be passed into Protected Rule.
            $protected = [
                'id' => $data[0]->id,
                'username' => $data[0]->username,
                'fullname' => $data[0]->fullname,
                'email' => $data[0]->email
            ];

            // Set up Protected Rule data.
            $this->SET_RULE('protected', $protected);
            // User that logged in is redirected to backend
            header('Location: ' . $this->uri->backend);
        }
        else
        {
            // If user send invalid data.
            $getBack('Username or password doesn\'t match.');
        }
    }

    /**
    * This will destroy an existing (protected) Protected Rule data.
    *
    * @return   mixed
    */
    public function logout()
    {
        // Destroy Protected Rule data.
        $this->DESTROY_RULE('protected');
        // Redirecting user back to main page.
        header('Location: /');
    }
}
