<?php namespace controller\backend;

use controller\config\Path;
use controller\config\Model;
use controller\config\Uri;
use tool\Pagination;

class Content extends \framework\parents\Controller
{
    // The following variable have access to this class only.
    private $path, $model, $uri, $pagination;

    function __construct()
    {
        $this->path = new Path;
        $this->model = new Model;
        $this->uri = new Uri;
        $this->pagination = new Pagination;
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
    * This method is used to load all items of contents
    *
    * @return   view   backend/extended/{content}
    */
    public function load($content)
    {
        $path = $this->path;
        $datas = null;

        switch($content)
        {
            /***** Handle to gets all logs data. *****/
            case 'logs':
                $pagination = null;
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $identifier = isset($_GET['identifier']) ? $_GET['identifier'] : 'default';

                if($identifier !== 'logs' AND $identifier !== 'default')
                {
                    $data = $this->model->Log->select('message')->clause('ORDER BY id DESC')->get(10);

                    $this->_dieOnNull($data, '<p><i>You don\'t have log activities.</i></p>');
                }
                else
                {
                    $data = $this->model->Log->clause('ORDER BY id DESC')->select('message')->get();

                    $this->_dieOnNull($data, '<p><i>You don\'t have log activities.</i></p>');

                    $data = $this->pagination->data($data, 15);
                    $pagination = $this->pagination->pagination($data, 15, $page);
                    $data = $this->pagination->current($data, $page);
                }

                $datas = [
                    'all' => $data,
                    'pagination' => $pagination,
                    'identifier' => $identifier,
                    'uri' => [
                        'all' => $this->uri->logs,
                        'delete' => $this->uri->delete_log,
                    ],
                ];
                break;

            /***** Handle to gets all pages data. *****/
            case 'pages':
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $data = $this->model->Page->clause('ORDER BY id DESC')->get();

                $this->_dieOnNull($data, '<p><i>You have no pages.</i></p>');

                $data = $this->pagination->data($data, 10);
                $pagination = $this->pagination->pagination($data, 10, $page);
                $data = $this->pagination->current($data, $page);
                $datas = [
                    'all' => $data,
                    'pagination' => $pagination,
                    'uri' => [
                        'edit_page' => $this->uri->edit_page,
                        'edit' => $this->uri->edit_page_c,
                        'delete' => $this->uri->delete_page_c,
                    ],
                ];
                break;

            /***** Handle to gets all controllers data. *****/
            case 'controllers':
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $data = $this->model->Controller->clause('ORDER BY id DESC')->get();

                $this->_dieOnNull($data, '<p><i>You have no controllers.</i></p>');

                $data = $this->pagination->data($data, 10);
                $pagination = $this->pagination->pagination($data, 10, $page);
                $data = $this->pagination->current($data, $page);
                $datas = [
                    'all' => $data,
                    'pagination' => $pagination,
                    'uri' => [
                        'edit_controller' => $this->uri->edit_controller,
                        'edit' => $this->uri->edit_controller_c,
                        'delete' => $this->uri->delete_controller,
                    ],
                ];
                break;

            /***** Handle to gets all routes data. *****/
            case 'routes':
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $data = $this->model->Route->clause('WHERE system=:system ORDER BY id DESC')->
                    bindParams(['system' => 0])->get();

                $this->_dieOnNull($data, '<p><i>You have no routes.</i></p>');

                $data = $this->pagination->data($data, 10);
                $pagination = $this->pagination->pagination($data, 10, $page);
                $data = $this->pagination->current($data, $page);
                $datas = [
                    'all' => $data,
                    'pagination' => $pagination,
                    'uri' => [
                        'edit' => $this->uri->edit_route,
                        'delete' => $this->uri->delete_route,
                    ],
                ];
                break;

            /***** Handle to gets all notes data. *****/
            case 'notes':
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $data = $this->model->Note->clause('ORDER BY id DESC')->get();

                $this->_dieOnNull($data, '<p><i>You have no notes.</i></p>');

                $data = $this->pagination->data($data, 15);
                $pagination = $this->pagination->pagination($data, 15, $page);
                $data = $this->pagination->current($data, $page);
                $datas = [
                    'all' => $data,
                    'pagination' => $pagination,
                    'uri' => [
                        'delete' => $this->uri->delete_note,
                        'edit' => $this->uri->edit_note,
                    ],
                ];
                break;

            default:
                break;
        }

        return Parent::LOAD_VIEW('backend/extended/all-' . $content, compact('path', 'datas'));
    }
}
