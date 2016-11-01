<?php namespace controller\backend;

use \controller\config\Model;
use \controller\config\Path;

class Edit extends \framework\parents\Controller
{
    // The following variable have access to this class only.
    private $model, $path;

    public function __construct()
    {
        $this->model = new Model;
        $this->path  = new Path;
    }

    /**
    * This method is used to process 'create' action from the request.
    * You have to know that pages and layouts created are not stored into Database. They
    * are stored into internal as file-system.
    *
    * @return   view   backend/extended/{content}
    */
    public function do($content)
    {
        $dateNow = date('Y-m-d') . ' ' . date('H:i:s');

        switch($content)
        {
            // This will handle function to create a new note.
            case 'note':
                if(isset($_POST['title']) AND isset($_POST['message']))
                {
                    // If everything is ok
                    die('ok');
                }

                // When data is not defined.
                die('Something went wrong!');
                break;

            // This will handle function to register a new route.
            case 'route':
                if(isset($_POST['prefix']) AND isset($_POST['route']) AND isset($_POST['method']) AND isset($_POST['target']))
                {
                    // If everything is ok
                    die('ok');
                }

                // When data is not defined.
                die('Something went wrong!');
                break;

            case 'meta':
                if(isset($_POST['custom_id']) AND isset($_POST['type']) AND isset($_POST['name'])
                AND isset($_POST['value1']) AND isset($_POST['value2']) AND isset($_POST['value3'])
                AND isset($_POST['value4']) AND isset($_POST['value5']) AND isset($_POST['value6']))
                {
                    // If everything is ok
                    die('ok');
                }

                // When data is not defined.
                die('Something went wrong!');
                break;

            case 'layout':
                if(isset($_POST['name']) AND isset($_POST['content']))
                {
                    // If everything is ok
                    die('ok');
                }

                // When data is not defined.
                die('Something went wrong!');
                break;

            case 'controller':
                if(isset($_POST['name']) AND isset($_POST['comment']) AND isset($_POST['content']))
                {
                    // If everything is ok
                    die('ok');
                }

                // When data is not defined.
                die('Something went wrong!');
                break;

            case 'page':
                if((isset($_POST['title']) AND isset($_POST['slug']) AND isset($_POST['content'])
                AND isset($_POST['status']) AND isset($_POST['desc'])) OR (isset($_POST['title'])
                AND isset($_POST['slug']) AND isset($_POST['status']) AND isset($_POST['desc'])))
                {
                    // If everything is ok
                    die('ok');
                }

                // When data is not defined.
                die('Something went wrong!');
                break;

            default:
                die('Illegal request!');
                break;
        }
    }
}
