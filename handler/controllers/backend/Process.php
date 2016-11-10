<?php namespace controller\backend;

use controller\config\Model;
use controller\config\Path;
use tool\Validation;

class Process extends \framework\parents\Controller
{
    // The following variables have access into this class only.
    private $model, $path, $error, $date, $data, $fileSystem, $filePath, $fileContent,
            $log, $cleanLog, $action, $table, $validation, $validProcess, $data2, $name,
            $index, $id, $fileOrg, $oldPath, $cleanRouteCache;

    function __construct()
    {
        $this->model = new Model;
        $this->path = new Path;
        $this->validation = new Validation;
        $this->date = date('Y-m-d') . ' ' . date('H:i:s');
        $this->cleanLog = $this->cleanRouteCache = false;
        $this->data = $this->data2 = $this->log = [];
        $this->fileSystem = $this->filePath = $this->fileContent = $this->table =
            $this->oldPath = null;
        $this->validProcess = ['insert', 'update', 'delete'];
        $this->fileOrg = ['page', 'controller', 'layout', 'landing'];
        $this->name = $this->index = $this->id = null;

        // Checking for valid user based on Protected Rule data.

    }

    /**
    * Function or method to generate data for name and index property.
    *
    * @param    string|bool   $process
    * @return   mixed
    */
    private function name($post)
    {
        if(isset($post['title']))
        {
            $this->name = $post['title'];
            $this->index = 'title';
        }
        elseif(isset($post['name']))
        {
            $this->name = $post['name'];
            $this->index = 'name';
        }
        elseif(isset($post['prefix']))
        {
            $this->name = $post['prefix'];
            $this->index = 'prefix';
        }
    }

    /**
    * Function or method to generate log data.
    *
    * @param    string|bool   $process
    * @param    string|bool   $content
    * @return   string
    */
    private function log($process, $content)
    {
        if($process === 'delete')
        {
            $this->log = ($this->id !== 'all') ? ['message' => $this->date .
                ' You was <span style="color:red">deleted</span> a ' . $content .
                ' with ' . $this->index . ' <b>\'' . $this->name . '\'</b>'] : [
                'message' => $this->date . ' You was <span style="color:red">deleted</span>
                all ' . $content . 's'];
        }
        elseif($process === 'insert')
        {
            $this->log = [
                'message' => $this->date . ' You was <span style="color:green">inserted</span> a ' . $content .
                    ' with ' . $this->index . ' <b>\'' . $this->name . '\'</b>'
            ];
        }
        elseif($process === 'update')
        {
            $this->log = [
                'message' => $this->date . ' You was <span style="color:orange">updated</span> a ' . $content .
                    ' with ' . $this->index . ' <b>\'' . $this->name . '\'</b>'
            ];
        }
    }

    /**
    * Function or method to run the process.
    *
    * @param    string|bool   $process
    * @return   mixed
    */
    private function run($process, $content)
    {
        // Run Database actions.
        $this->model->{$this->table}->$process($this->data, $this->data2);

        // Check is the content requested to create, update, or delete it related system file.
        if($this->fileSystem === 'create' OR $this->fileSystem === 'update')
        {
            $e = fopen($this->filePath, 'w');
            fwrite($e, $this->fileContent);
            fclose($e);
        }
        elseif($this->fileSystem === 'delete')
        {
            if($this->id === 'all')
            {
                // If $this->id is 'all', we delete all related files from storage.
                //
                // @ Referral from:
                //   http://stackoverflow.com/questions/4594180/deleting-all-files-from-a-folder-using-php
                $a = new \RecursiveDirectoryIterator($this->path->{$content . 's_storage'},
                    \FilesystemIterator::SKIP_DOTS);
                $files = new \RecursiveIteratorIterator($a, \RecursiveIteratorIterator::CHILD_FIRST);

                foreach($files as $file)
                {
                    $file->isDir() ?  rmdir($file) : unlink($file);
                }
            }
            else
            {
                unlink($this->filePath);
            }
        }
        elseif($this->fileSystem === 'rename')
        {
            rename($this->oldPath, $this->filePath);
        }

        // Check if system needs to delete cache of request.
        if($this->cleanRouteCache)
        {
            $this->CLEAN_ROUTE_CACHES();
        }

        // If the content request to system that logs data should be cleaned permanently,
        // this will not be executed.
        if(!$this->cleanLog)
        {
            $this->model->Log->Insert($this->log);
        }
    }

    /**
    * This method/function is used to process(create, edit, and delete) contents from the request.
    * You have to know that pages, controllers, and layouts created are not stored into Database
    * (except it properties like name or filename). They are stored into internal as file-systems,
    * because we expect that user may write a content with large code script data that is not good
    * to be stored into Database. Other than that, stored it as file-system will ease user when they
    * want to edit the data.
    *
    * @param    string   $content
    * @return   string
    */
    public function init($post, $content, $process = false)
    {
        // When unknown process occurs.
        if(!in_array($process, $this->validProcess))
        {
            die('Invalid process!');
        }

        // Every contents have id attribute in Database table. So, we define it
        // at the first time and makes it global.
        $this->id = isset($post['id']) ? $post['id'] : false;
        // The table name is generated automatically by ucwords().
        // It just needed to convert the first character to uppercase.
        $this->table = ucwords($content);

        // Generating name, index, and log property.
        $this->name($post);
        $this->log($process, $content);

        // To deleting a content, we just need the content's id. So,
        // if the process is 'delete', we done the process here.
        // We don't need to validating and process other data or properties again.
        if($process === 'delete')
        {
            // Checking for Id.
            if(!$this->id)
            {
                die('Id was not found!');
            }

            // Generating data for query and validating the id.
            // If id is 'all', $this->data will not be set, and it will using default
            // value, null array. The mean is tell the system to delete all data
            // in the table form Database.
            if($this->id !== 'all')
            {
                $this->data = ['id' => $this->id];
            }
            elseif($this->id === 'all' AND $content === 'route')
            {
                $this->data = ['system' => 0];
            }

            // Check if the content is used file system.
            if(in_array($content, $this->fileOrg))
            {
                // Generate new file path and file system action.
                $this->filePath = $this->path->{$content . 's_storage'} . '/' . md5($this->name) . '.php';
                $this->fileSystem = 'delete';
            }

            // Done the process.
            $this->run($process, $content);
            die('ok');
        }

        // If the process is not 'delete'.
        // The process validation and data generated is runs separately, depends
        // on the contents recieved.
        switch($content)
        {
            /***** This will handle to create, edit, and delete a new note. *****/
            case 'note':
                // Prepared variables.
                $message = isset($post['message']) ? $post['message'] :
                    die('Unknown message data!');

                // Note title can't be empty
                empty($this->name) ? die('Note title cannot be empty!') : true;

                // Generating data.
                $this->data = ['title' => $this->name, 'message' => $message,
                    'updated_at' => $this->date];

                if($process === 'insert')
                {
                    $this->data['created_at'] = $this->date;
                }

                if($process === 'update')
                {
                    $this->data2 = ['id' => $this->id];
                }
                break;

            /***** This will handle to create, edit, and delete a new page. *****/
            case 'page':
                // Prepared variables.
                $slug = isset($post['slug']) ? $post['slug'] : die('Unknown slug data!');
                $content = isset($post['content']) ? $post['content'] : false;
                $status = isset($post['status']) ? $post['status'] : die('Unknown status data!');
                $desc = isset($post['desc']) ? $post['desc'] : die('Unknown description data!');

                // Page title and slug can't be empty
                empty($this->name) ? die('Page title cannot be empty!') : true;
                empty($slug) ? die('Page slug cannot be empty!') : true;
                // Title and slug also can't contains some special characters.
                preg_match('/[^a-zA-Z0-9\!\s\.\,\(\)\[\]\*\&\%\$\#\@]+/', $this->name) ?
                    die('Wrong title format!') : true;

                // Generate filename based on the page title.
                $fileName = md5($this->name) . '.php';
                // Generate new file path.
                $file = $this->path->pages_storage . '/' . $fileName;

                // Checking is page already exists.
                if((count($this->model->Page->select('filename')->clause('WHERE filename=:filename')
                ->bindParams(['filename' => $fileName])->get()) OR file_exists($file)) AND
                $process === 'insert')
                {
                    die('Page with title \'' . $this->name . '\' is already exists on storage.');
                }

                // Generating data.
                if(isset($post['change_status']))
                {
                    $this->data = ['status' => $status, 'updated_at' => $this->date];
                }
                else
                {
                    $this->data = ['title' => $this->name, 'slug' => $slug,
                        'description' => $desc, 'filename' => $fileName, 'status' => $status,
                        'updated_at' => $this->date];
                }

                if($process === 'insert')
                {
                    $this->data['created_at'] = $this->date;
                    $this->fileSystem = 'create';
                }

                if($process === 'update')
                {
                    $this->data2 = ['id' => $this->id];
                    $this->fileSystem = 'update';
                }

                if($content === false)
                {
                    $this->oldPath = $this->path->pages_storage . '/' .
                        $this->model->Page->select('filename')->clause('WHERE
                        id=:id')->bindParams(['id' => $this->id])->get(1)[0]->filename;
                    $this->fileSystem = 'rename';
                }

                $this->filePath = $file;
                $this->fileContent = $content;
                $this->cleanRouteCache = true;
                break;

            /***** This will handle to create, edit, and delete a new controller. *****/
            case 'controller':
                // Prepared variables.
                $content = isset($post['content']) ? $post['content'] : false;
                $comment = isset($post['comment']) ? $post['comment'] : die('Unknown comment data!');

                // Controller title and slug can't be empty
                empty($this->name) ? die('Controller title cannot be empty!') : true;
                // Title and slug also can't contains some special characters.
                preg_match('/[^a-zA-Z0-9\!\s\.\,\(\)\[\]\*\&\%\$\#\@]+/', $this->name) ?
                    die('Wrong name format!') : true;

                // Generate filename based on the page title.
                $fileName = md5($this->name) . '.php';
                // Generate new file path.
                $file = $this->path->controllers_storage . '/' . $fileName;

                // Checking is controller already exists.
                if((count($this->model->Controller->select('filename')->clause('WHERE filename=:filename')
                ->bindParams(['filename' => $fileName])->get()) OR file_exists($file)) AND
                $process === 'insert')
                {
                    die('Controller with name \'' . $this->name . '\' is already exists on storage.');
                }

                // Generating data.
                $this->data = ['name' => $this->name, 'comment' => $comment,
                    'filename' => $fileName, 'updated_at' => $this->date];

                if($process === 'insert')
                {
                    $this->data['created_at'] = $this->date;
                    $this->fileSystem = 'create';
                }

                if($process === 'update')
                {
                    $this->data2 = ['id' => $this->id];
                    $this->fileSystem = 'update';
                }

                if($content === false)
                {
                    $this->oldPath = $this->path->controllers_storage . '/' .
                        $this->model->Controller->select('filename')->clause('WHERE
                        id=:id')->bindParams(['id' => $this->id])->get(1)[0]->filename;
                    $this->fileSystem = 'rename';
                }

                $this->filePath = $file;
                $this->fileContent = $content;
                break;

            /***** This will handle to create, edit, and delete a new route. *****/
            case 'route':
                // Prepared variables.
                $uri = isset($post['uri']) ? $post['uri'] :
                    die('Unknown uri data!');
                $method = isset($post['method']) ? $post['method'] :
                    die('Unknown method data!');
                $target = isset($post['target']) ? $post['target'] :
                    die('Unknown target data!');
                $system = isset($post['system']) ? 1 : 0;

                // Route prefix and uri can't be empty
                empty($this->name) ? die('Route prefix cannot be empty!') : true;
                empty($uri) ? die('Route uri cannot be empty!') : true;

                // Validation here...

                // Generating data.
                $this->data = ['prefix' => $this->name, 'uri' => $uri, 'system' => $system,
                    'method' => $method, 'target' => $target, 'updated_at' => $this->date];

                if($process === 'insert')
                {
                    $this->data['created_at'] = $this->date;
                }

                if($process === 'update')
                {
                    $this->data2 = ['id' => $this->id];
                }

                $this->cleanRouteCache = true;
                break;

            /***** This will handle to create, edit, and delete a new layout. *****/
            case 'layout':
                // Prepared variables.
                $content = isset($post['content']) ? $post['content'] : false;

                // Layout name can't be empty
                empty($this->name) ? die('Layout name cannot be empty!') : true;
                // Name also can't contains some special characters.
                preg_match('/[^a-zA-Z0-9\!\s\.\,\(\)\[\]\*\&\%\$\#\@]+/', $this->name) ?
                    die('Wrong name format!') : true;

                // Generate filename based on the layout name.
                $fileName = md5($this->name) . '.php';
                // Generate new file path.
                $file = $this->path->layouts_storage . '/' . $fileName;

                // Checking is controller already exists.
                if((count($this->model->Layout->select('filename')->clause('WHERE filename=:filename')
                ->bindParams(['filename' => $fileName])->get()) OR file_exists($file)) AND
                $process === 'insert')
                {
                    die('Layout with name \'' . $this->name . '\' is already exists on storage.');
                }

                // Generating data.
                $this->data = ['name' => $this->name, 'filename' => $fileName, 'updated_at' => $this->date];

                if($process === 'insert')
                {
                    $this->data['created_at'] = $this->date;
                    $this->fileSystem = 'create';
                }

                if($process === 'update')
                {
                    $this->data2 = ['id' => $this->id];
                    $this->fileSystem = 'update';
                }

                if($content === false)
                {
                    $this->oldPath = $this->path->layouts_storage . '/' .
                        $this->model->Layout->select('filename')->clause('WHERE
                        id=:id')->bindParams(['id' => $this->id])->get(1)[0]->filename;
                    $this->fileSystem = 'rename';
                }

                $this->filePath = $file;
                $this->fileContent = $content;
                break;

            case 'meta':
                // Prepared variables.
                $customId = isset($post['custom_id']) ? $post['custom_id'] :
                    die('Unknown custom_id data!');
                $type = isset($post['type']) ? $post['type'] :
                    die('Unknown type data!');

                for($i = 1; $i < 7; $i++)
                {
                    $value[$i] = isset($post['value' . $i]) ? $post['value' . $i] :
                        die('Unknown value' . $i . ' data!');
                }

                // Validation here...

                // Generating data.
                $this->data = ['name' => $this->name, 'custom_id' => $customId, 'type' => $type,
                    'value1' => $value[1], 'value2' => $value[2], 'value3' => $value[3],
                    'value4' => $value[4], 'value5' => $value[5], 'value6' => $value[6],
                    'updated_at' => $this->date];

                if($process === 'insert')
                {
                    $this->data['created_at'] = $this->date;
                }

                if($process === 'update')
                {
                    $this->data2 = ['id' => $this->id];
                }
                break;

            default:
                die('Illegal request!');
                break;
        }

        // The final process.
        $this->run($process, $content);
        // If this line is reached, means everything was done perfectly.
        // Then, die with 'ok' notice. The process was complete.
        die('ok');
    }
}
