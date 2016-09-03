<?php namespace mvc\controllers\backend;

use mvc\controllers\backend\config\Requirement;

class Realtime extends \system\parents\Controller
{
    private $requirements;

    public function __construct()
    {
        $this->requirements = new Requirement;
    }

    public function index($prefix, $name)
    {
        switch($prefix)
        {
            case 'home-builder':
                return $this->LOAD_VIEW("backend/storage/home/{$name}");
                break;

            case 'content':
                return $this->LOAD_VIEW("backend/storage/{$name}");
                break;

            default:
                break;
        }
    }
}
