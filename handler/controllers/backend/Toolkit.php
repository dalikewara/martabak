<?php namespace controller\backend;

use controller\config\Path;
use controller\config\Model;

class Toolkit extends \framework\parents\Controller
{
    // The following variable have access to this class only.
    private $path, $model;

    function __construct()
    {
        $this->path = new Path;
        $this->model = new Model;
    }

    /**
    * When data is null.
    *
    * @param    array|object   $data
    * @param    string         $message
    * @return   mixed
    */
    private function _dieOnNull($data, $message)
    {
        if(count($data) < 1)
        {
            die($message);
        }
    }

    /**
    * This method is used to load all toolkit's items
    *
    * @return   view   backend/extended/{content}
    */
    public function load($content)
    {
        $path = $this->path;
        $datas = null;

        switch($content)
        {
            /***** Handle to gets all layouts data. *****/
            case 'layouts':
                $datas = $this->model->Layout->get();
                break;

            default:
                die('Illegal content!');
                break;
        }

        return Parent::LOAD_VIEW('backend/extended/toolkit-' . $content, compact('path', 'datas'));
    }
}
