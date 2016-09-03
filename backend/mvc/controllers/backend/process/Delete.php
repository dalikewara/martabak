<?php namespace mvc\controllers\backend\process;

use mvc\controllers\backend\config\Requirement;
use mvc\controllers\backend\config\Error as ConfigError;
use mvc\controllers\universal\Tokenizer;

class Delete extends \system\parents\Controller
{
    private $report, $requirements, $errors, $model, $tokenizer;

    /**
    * @return   mixed
    */
    public function __construct()
    {
        $this->errors       = new ConfigError;
        $this->requirements = new Requirement;
        $this->tokenizer    = new Tokenizer;
    }

    /**
    * @param    string   $type
    * @return   mixed
    */
    public function index($type)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST' AND Parent::CHECK_RULE('auth') === TRUE)
        {
            // Token checker
            // Every requests recieved must be passed from token checker.
            $this->tokenizer->checkTokenFromRequest($this->requirements->model->tokens->
                Select('token')->Clause($this->requirements->sqlGenerator->where(
                'user_id', ':user_id'))->BindParam(['user_id' => $this->requirements->model->users->
                Select('id')->Clause($this->requirements->sqlGenerator->where('username',
                ':username'))->BindParam(['username' => $this->GET_RULE('auth')[1]])->Range(1)->
                Result()[0]])->Range(1)->Result()[0], '_token') ? TRUE : die($this->errors->errToken);

            // Initialize Model object for Database requirements.
            // The $type variable indexes which table will be selected.
            $tables = $this->requirements->model->$type;

            // $type variable also needed to filtering prefix.
            // The prefix is used by system to indicate which items
            // shall be deleted.
            switch($type)
            {
                case 'routes':
                    $prefix = 'route-';

                    // Defining unlink process to delete a file.
                    // Routes does not have file-system, this process just
                    // for indexes.
                    $unlink = function($fileName){};
                    break;

                case 'contents':
                    $prefix = 'content-';

                    // Defining unlink process to delete content file
                    $unlink = function($fileName)
                    {
                        unlink($this->requirements->index->paths()['storage'] . "/{$fileName}");
                    };
                    break;

                case 'layouts':
                    $prefix = 'layout-';

                    // Defining unlink process to delete layout file
                    $unlink = function($fileName)
                    {
                        unlink($this->requirements->index->paths()['storage'] . "/layouts/{$fileName}");
                    };
                    break;

                default:
                    die($this->errors->errType);
                    break;
            }

            // HANDLE PROCESS TO DELETE ITEMS
            // Please be carefull when you deleting an item.
            // The items which deleted are permanently removed, cannot be restored.
            foreach($tables->All() as $table)
            {
                $id          = $table['id'];
                $md5IdPrefix = md5($prefix . $id);

                // Defining process function
                $process     = function() use($tables, $table, $id, $unlink)
                {
                    $tables->Delete(['id' => $id]);
                    isset($table['filename']) ? ($fileName = $table['filename']) : ($fileName = '');
                    $unlink($fileName);
                };

                // Deleting item if it match from Database
                isset($_POST[$md5IdPrefix]) ? $process() : FALSE;
            }
        }
        else
        {
            die($this->errors->errRequest);
        }

        // If everything goes perfectly, return 'ok' to AJAX indicate the process
        echo 'ok';
    }
}
