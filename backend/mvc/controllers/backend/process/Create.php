<?php namespace mvc\controllers\backend\process;

use mvc\controllers\backend\config\Requirement;
use mvc\controllers\backend\config\Error as ConfigError;
use mvc\controllers\universal\Tokenizer;

class Create extends \system\parents\Controller
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

            // Initialize Model object for Database requirements
            // The $type variable indexes which table will be selected
            $model = $this->requirements->model->$type;

            // Get timestamp for now
            // The timestamp may not correct in some time location
            $dateNow = date('Y-m-d') . ' ' . date('H:i:s');

            // $type variable also needed to filtering handle process
            switch($type)
            {
                // HANDLE PROCESS TO CREATE A CONTENT
                // Remember that Martabak doesn't store contents into Database
                // except it metas, properties, and settings. Martabak store contents as
                // a file-system.
                case 'contents':
                    $prefix  = $_POST[md5('route-prefix')];
                    $slug    = $_POST[md5('content-slug')];
                    $title   = $_POST[md5('content-title')];
                    $content = $_POST[md5('content')];
                    $status  = $_POST[md5('content-status')];
                    $userId  = $this->requirements->model->users->Clause(
                        $this->requirements->sqlGenerator->where('username', ':username')
                        )->BindParam(['username' => $this->GET_RULE('auth')[1]])->Result()[0]['id'];

                    // Validation process
                    (empty($prefix) OR !isset($prefix) OR is_null($prefix)) ?
                        ($prefix = '') : (preg_match('/[^a-z0-9&=?+%\/_-]/i',
                        $prefix) ? die($this->errors->errSlugFormat) : ((preg_match('/^\//', $prefix))
                        ? ($prefix = filter_var($prefix, FILTER_SANITIZE_URL)) :
                        die($this->errors->errSlugFormat)));
                    (empty($slug) OR !isset($slug) OR is_null($slug)) ? die($this->errors->errSlugEmpty) :
                        (preg_match('/[^a-z0-9&=?+%\/_-]/i', $slug) ? die($this->errors->errSlugFormat) :
                        ($slug = "{$prefix}/" .  filter_var(ltrim($slug, '/'), FILTER_SANITIZE_URL)));
                    (empty($title) OR !isset($title)) ? ($title = 'Untitled') :
                        ($title = htmlspecialchars($title));
                    (empty($status) OR !isset($status)) ? die($this->errors->errStatus) : ($status = $status);

                    // Get filename
                    $fileName = md5($slug) . '.php';

                    // Insert content properties into Database
                    $model->Insert([
                        'user_id'      => $userId,
                        'route_prefix' => $prefix,
                        'slug'         => $slug,
                        'title'        => $title,
                        'filename'     => $fileName,
                        'status'       => $status,
                        'created_at'   => $dateNow,
                        'updated_at'   => $dateNow,
                    ]);

                    // Create content file-system
                    $fcreate = fopen($this->requirements->index->paths()['storage'] . "/{$fileName}", 'w');
                    fwrite($fcreate, $content);
                    fclose($fcreate);
                    break;

                // HANDLE PROCESS TO REGISTER A ROUTE
                // Registering a route can help you manage your applications.
                // Route can be used as a system traffic request.
                case 'routes':
                    $prefix = $_POST[md5('prefix')];
                    $route  = $_POST[md5('route')];
                    $path   = $_POST[md5('path')];
                    $method = $_POST[md5('method')];
                    $value  = $_POST[md5('path-value')];

                    // Validation process
                    (empty($prefix) OR !isset($prefix) OR is_null($prefix)) ?
                        die($this->errors->errPrefixEmpty) : (preg_match('/[^a-z0-9 _-]/i',
                        $prefix) ? die($this->errors->errPrefixFormat) : ($prefix = $prefix));
                    (empty($route) OR !isset($route) OR is_null($route)) ?
                        die($this->errors->errRouteEmpty) : (preg_match('/[^a-z0-9&=?+%\/_-]/i',
                        $route) ? die($this->errors->errRouteFormat) : ((preg_match('/^\//', $route))
                        ? ($route = filter_var($route, FILTER_SANITIZE_URL)) :
                        die($this->errors->errRouteFormat)));
                    (empty($method) OR !isset($method) OR is_null($method)) ?
                        die($this->errors->errMethod) : ($method = $method);
                    ($path === 'none') ? ($path = 'null') :
                        ((empty($value) OR !isset($value) OR is_null($value)) ?
                        die($this->errors->errValueEmpty) : (preg_match('/[^a-z0-9&=?+%().@:\/_-]/i',
                        $value) ? die($this->errors->errValueFormat) : (preg_match('/^\//', $value)
                        ? ($path = $value) : die($this->errors->errValueFormat))));

                    // Insert data into Database
                    $model->Insert([
                        'prefix'     => $prefix,
                        'route'      => $route,
                        'path'       => $path,
                        'method'     => $method,
                        'system'     => 0,
                        'created_at' => $dateNow,
                        'updated_at' => $dateNow,
                    ]);
                    break;

                // HANDLE PROCESS TO CREATE A LAYOUT
                // Layouts can help you to reduce repeated codes on your work.
                // Just create layouts dan insert them into your worksheet.
                // Like contents, layouts are stored as file-system too.
                case 'layouts':
                    $prefix  = $_POST[md5('prefix')];
                    $content = $_POST[md5('content')];

                    // Validation process
                    (empty($prefix) OR !isset($prefix) OR is_null($prefix)) ?
                        die($this->errors->errPrefixEmpty) : ($prefix = htmlspecialchars($prefix));

                    // Get filename
                    $fileName = md5($prefix) . '.php';

                    // Insert layout properties into Database
                    $model->Insert([
                        'prefix'     => $prefix,
                        'filename'   => $fileName,
                        'created_at' => $dateNow,
                        'updated_at' => $dateNow,
                    ]);

                    // Create layout file-system
                    $fcreate = fopen($this->requirements->index->paths()['storage'] . "/layouts/{$fileName}", 'w');
                    fwrite($fcreate, $content);
                    fclose($fcreate);
                    break;

                // HANDLE PROCESS IF TYPE IS UNDEFINED
                // The program will be destroyed instantly
                default:
                    die($this->errors->errType);
                    break;
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
