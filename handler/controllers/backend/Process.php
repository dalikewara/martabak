<?php namespace controller\backend;

use controller\config\Model;
use controller\config\Path;
use tool\Validation;

class Process
{
    // The following variables have access into this class only.
    private $model, $path, $error, $date, $data, $fileSystem, $filePath, $fileContent,
            $log, $cleanLog, $action, $table, $validation, $validProcess, $data2, $name,
            $index, $id, $fileOrg, $oldPath;

    function __construct()
    {
        $this->model = new Model;
        $this->path = new Path;
        $this->validation = new Validation;
        $this->date = date('Y-m-d') . ' ' . date('H:i:s');
        $this->cleanLog = false;
        $this->data = $this->data2 = $this->log = [];
        $this->fileSystem = $this->filePath = $this->fileContent = $this->table =
            $this->oldPath = null;
        $this->validProcess = ['insert', 'update', 'delete'];
        $this->fileOrg = ['page', 'controller', 'layout', 'landing'];
        $this->name = $this->index = $this->id = null;
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
    public function do($post, $content, $process = false)
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
                    die('Wrong title format!') : true;

                // Generate filename based on the page title.
                $fileName = md5($this->name) . '.php';
                // Generate new file path.
                $file = $this->path->controllers_storage . '/' . $fileName;

                // Checking is controller already exists.
                if((count($this->model->Controller->select('filename')->clause('WHERE filename=:filename')
                ->bindParams(['filename' => $fileName])->get()) OR file_exists($file)) AND
                $process === 'insert')
                {
                    die('Controller with title \'' . $this->name . '\' is already exists on storage.');
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

            // // This will handle function to register a new route.
            // case 'route':
            //     if(isset($post['prefix']) AND isset($post['uri']) AND isset($post['method']) AND isset($post['target']))
            //     {
            //         $prefix = is_string($post['prefix']) ? $post['prefix'] : false;
            //         $uri    = is_string($post['uri']) ? $post['uri'] : false;
            //         $method = is_string($post['method']) ? $post['method'] : false;
            //         $target = is_string($post['target']) ? $post['target'] : false;
            //
            //         // Route prefix, uri and method can't be empty
            //         empty($prefix) ? die('Prefix cannot be empty!') : true;
            //         empty($uri) ? die('Uri cannot be empty!') : true;
            //         empty($method) ? die('Method cannot be empty!') : true;
            //         // Auto set target to null if it leaved empty
            //         empty($target) ? ($target = 'null') : true;
            //
            //         // Insert data into Database if has no problems
            //         $this->model->routes->Insert([
            //             'prefix' => $prefix,
            //             'uri'    => $uri,
            //             'method' => $method,
            //             'target' => $target,
            //             'system' => 0,
            //         ]);
            //
            //         // Insert log data
            //         $this->model->logs->Insert([
            //             'message' => $this->date . ' You have registered a new route with prefix <b>\''
            //                 . $prefix . '\'</b> and uri <b>\'' . $uri . '\'</b>',
            //         ]);
            //     }
            //     break;
            //
            // case 'meta':
            //     if(isset($post['custom_id']) AND isset($post['type']) AND isset($post['name'])
            //     AND isset($post['value1']) AND isset($post['value2']) AND isset($post['value3'])
            //     AND isset($post['value4']) AND isset($post['value5']) AND isset($post['value6']))
            //     {
            //         $custom_id = is_numeric($post['custom_id']) ? $post['custom_id'] : false;
            //         $type      = is_string($post['type']) ? $post['type'] : false;
            //         $name      = is_string($post['name']) ? $post['name'] : false;
            //         $value1    = is_string($post['value1']) ? $post['value1'] : false;
            //         $value2    = is_string($post['value2']) ? $post['value2'] : false;
            //         $value3    = is_numeric($post['value3']) ? $post['value3'] : false;
            //         $value4    = is_string($post['value4']) ? $post['value4'] : false;
            //         $value5    = is_string($post['value5']) ? $post['value5'] : false;
            //         $value6    = is_string($post['value6']) ? $post['value6'] : false;
            //
            //         // Insert data into Database if has no problems
            //         $this->model->metas->Insert([
            //             'custom_id' => $custom_id,
            //             'type'  => $type,
            //             'name' => $name,
            //             'value1' => $value1,
            //             'value2' => $value2,
            //             'value3' => $value3,
            //             'value4' => $value4,
            //             'value5' => $value5,
            //             'value6' => $value6,
            //         ]);
            //
            //         // Insert log data
            //         $this->model->logs->Insert([
            //             'message' => $this->date . ' You have inserted a new meta',
            //         ]);
            //     }
            //     break;
            //
            // case 'layout':
            //     if(isset($post['name']) AND isset($post['content']))
            //     {
            //         $name    = is_string($post['name']) ? $post['name'] : false;
            //         $content = is_string($post['content']) ? $post['content'] : false;
            //
            //         // Layout name can't be empty
            //         empty($name) ? die('Name cannot be empty!') : true;
            //         // The name also can't contains some special characters.
            //         preg_match('/[^a-zA-Z0-9\!\s\.\,\(\)\[\]\*\&\%\$\#\@]+/', $name) ?
            //             die('Wrong name format!') : true;
            //
            //         // Generate filename based on the name
            //         $fileName = md5($name) . '.php';
            //         // Generate new file path
            //         $file = $this->path->get('layouts-storage') . '/' . $fileName;
            //
            //         // Checking is layout already exists.
            //         if(in_array($fileName, $this->model->layouts->Select('filename')
            //         ->Result()) OR file_exists($file))
            //         {
            //             die('Layout with name \'' . $name . '\' is already exists on storage.');
            //         }
            //         else
            //         {
            //             // Insert data into Database if has no problems
            //             $this->model->layouts->Insert([
            //                 'name' => $name,
            //                 'filename' => $fileName,
            //             ]);
            //
            //             // Create new layout file
            //             $fCreate = fopen($file, 'w');
            //             fwrite($fCreate, $content);
            //             fclose($fCreate);
            //
            //             // Insert log data
            //             $this->model->logs->Insert([
            //                 'message' => $this->date . ' You have added a new layout with name <b>\'' . $name . '\'</b>',
            //             ]);
            //         }
            //     }
            //     break;
            //
            // default:
            //     die('Illegal request!');
            //     break;
        }

        // The final process.
        $this->run($process, $content);
        // If this line is reached, means everything was done perfectly.
        // Then, die with 'ok' notice. The process was complete.
        die('ok');
    }
}
