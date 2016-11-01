<?php namespace controller\backend;

use \controller\config\Model;
use \controller\config\Path;

class Delete extends \framework\parents\Controller
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

        // For single process
        switch($content)
        {
            // This will handle function to delete a note.
            case 'note':
                if(isset($_POST['id']))
                {
                    // Get data properties
                    $data = $this->model->notes->Clause('WHERE id=:id')->BindParam(
                        ['id' => $_POST['id']])->Result(1)[0];
                    $title = $data['title'];

                    // Deleting note
                    $this->model->notes->Delete(['id' => $_POST['id']]);

                    // Insert log data
                    $this->model->logs->Insert([
                        'message' => $dateNow . ' You was deleted a note with title <b>\''
                            . $title . '\'</b>',
                    ]);

                    // If everything is ok
                    die('ok');
                }

                // When data is not defined.
                die('Something went wrong!');
                break;

            // This will handle function to delete a route.
            case 'route':
                if(isset($_POST['id']))
                {
                    $data = $this->model->routes->Clause('WHERE id=:id')->BindParam(
                        ['id' => $_POST['id']])->Result(1)[0];
                    $prefix = $data['prefix'];
                    $uri    = $data['uri'];

                    $this->model->routes->Delete(['id' => $_POST['id']]);

                    // Insert log data
                    $this->model->logs->Insert([
                        'message' => $dateNow . ' You was deleted a route with prefix <b>\''
                            . $prefix . '\'</b> and uri <b>\'' . $uri . '\'</b>',
                    ]);

                    // If everything is ok
                    die('ok');
                }

                // When data is not defined.
                die('Something went wrong!');
                break;

            case 'meta':
                if(isset($_POST['id']))
                {
                    // Getting data properties
                    $data = $this->model->metas->Clause('WHERE id=:id')->BindParam(
                        ['id' => $_POST['id']])->Result(1)[0];
                    $customId = $data['custom_id'];

                    // Deleting custom meta
                    $this->model->metas->Delete(['id' => $_POST['id']]);

                    // Insert log data
                    $this->model->logs->Insert([
                        'message' => $dateNow . ' You was deleted a meta with custom id <b>\''
                            . $customId . '\'</b>, type <b>\'' . $type . '\'</b>, and name <b>\''
                            . $name . '\'</b>',
                    ]);

                    // If everything is ok
                    die('ok');
                }

                // When data is not defined.
                die('Something went wrong!');
                break;

            case 'layout':
                if(isset($_POST['id']))
                {
                    $data = $this->model->layouts->Clause('WHERE id=:id')->BindParam(
                        ['id' => $_POST['id']])->Result(1)[0];
                    $fileName = $data['filename'];
                    $name = $data['name'];

                    if(unlink($this->path->get('layouts-storage') . '/' . $fileName))
                    {
                        $this->model->layouts->Delete(['id' => $_POST['id']]);
                    }

                    // Insert log data
                    $this->model->logs->Insert([
                        'message' => $dateNow . ' You was deleted a layout with name <b>\''
                            . $name . '\'</b>',
                    ]);

                    // If everything is ok
                    die('ok');
                }

                // When data is not defined.
                die('Something went wrong!');
                break;

            case 'controller':
                if(isset($_POST['id']))
                {
                    $data = $this->model->controllers->Clause('WHERE id=:id')->BindParam(
                        ['id' => $_POST['id']])->Result(1)[0];
                    $fileName = $data['filename'];
                    $name = $data['name'];

                    if(unlink($this->path->get('controllers-storage') . '/' . $fileName))
                    {
                        $this->model->controllers->Delete(['id' => $_POST['id']]);
                    }

                    // Insert log data
                    $this->model->logs->Insert([
                        'message' => $dateNow . ' You was deleted a controller with name <b>\''
                            . $name . '\'</b>',
                    ]);

                    // If everything is ok
                    die('ok');
                }

                // When data is not defined.
                die('Something went wrong!');
                break;

            case 'page':
                if(isset($_POST['id']))
                {
                    $data = $this->model->pages->Clause('WHERE id=:id')->BindParam(
                        ['id' => $_POST['id']])->Result(1)[0];
                    $fileName = $data['filename'];
                    $title = $data['title'];
                    $slug = $data['slug'];

                    if(unlink($this->path->get('pages-storage') . '/' . $fileName))
                    {
                        $this->model->pages->Delete(['id' => $_POST['id']]);
                    }

                    // Insert log data
                    $this->model->logs->Insert([
                        'message' => $dateNow . ' You was deleted a page with title <b>\''
                            . $title . '\'</b> and slug <b>\'' . $slug . '\'</b>',
                    ]);

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
