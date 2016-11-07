<?php namespace controller\config;

use controller\config\Model;

class Http extends \framework\parents\Controller
{
    private
    
        $rule = 'protected',
        
        $model;
    
    function __construct()
    {
        $this->model = new Model;
    }
    
    public function check()
    {
        if(!Parent::CHECK_RULE($this->rule) OR !isset(Parent::GET_RULE($this->rule)[
        'username']) OR count($this->model->User->select('username')->clause(
        'WHERE username=:username')->bindParams(['username' => Parent::GET_RULE(
        $this->rule)['username']])->get(1)) < 1)
        {
            die('Illegal connection!');
        }
    }
}
