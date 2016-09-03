<?php namespace mvc\controllers\backend\process;

use mvc\controllers\backend\config\Requirement;
use mvc\controllers\backend\config\Error as ConfigError;
use mvc\controllers\universal\Tokenizer;

class Edit extends \system\parents\Controller
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

            // Get timestamp for now
            // The timestamp may not correct in some time location
            $updateAt = date('Y-m-d') . ' ' . date('H:i:s');

            // $type variable needed to filtering type datas.
            // The datas are used by system to indicate or generate
            // update requirements
            switch($type)
            {
                // Generate Route Datas
                case 'routes':
                    $tables        = $this->requirements->model->routes;
                    $prefix        = 'route-';
                    $updatePrefix  = isset($_POST[md5('prefix')]) ? $_POST[md5('prefix')] : FALSE;
                    $updateRoute   = isset($_POST[md5('route')]) ? $_POST[md5('route')] : FALSE;
                    $updatePath    = isset($_POST[md5('path')]) ? $_POST[md5('path')] : FALSE;
                    $updateMethod  = isset($_POST[md5('method')]) ? $_POST[md5('method')] : FALSE;
                    $updateContent = [];
                    $typeSetting   = FALSE;

                    // Validation process
                    $updatePrefix ? (preg_match('/[^a-z0-9 _-]/i', $updatePrefix) ?
                        die($this->errors->errPrefixFormat) : ($updatePrefix = $updatePrefix)) :
                        FALSE;
                    $updateRoute ? (preg_match('/[^a-z0-9&=?+%\/_-]/i', $updateRoute) ?
                        die($this->errors->errRouteFormat) : ((preg_match('/^\//', $updateRoute)) ?
                        ($updateRoute = filter_var($updateRoute, FILTER_SANITIZE_URL)) :
                        die($this->errors->errRouteFormat))) : die($this->errors->errRouteEmpty);
                    $updateMethod ? ($updateMethod = $updateMethod) : FALSE;
                    $updatePath ? (preg_match('/[^a-z0-9&=?+%().@:\/_-]/i', $updatePath) ?
                        die($this->errors->errValueFormat) : ($updatePath = $updatePath)) : FALSE;

                    // Create datas requirements
                    $datas = function() use ($updatePrefix, $updateRoute, $updatePath, $updateAt, $updateMethod)
                    {
                        $dataPrefix = $updatePrefix ? array('prefix' => $updatePrefix) : array();
                        $dataRoute  = $updateRoute ? array('route' => $updateRoute) : array();
                        $dataPath   = $updatePath ? array('path' => $updatePath) : array();
                        $dataMethod = $updateMethod ? array('method' => $updateMethod) : array();
                        $dataUpdate = array('updated_at' => $updateAt);

                        return array_merge($dataPrefix, $dataRoute, $dataPath, $dataUpdate, $dataMethod);
                    };
                    break;

                // Generate Content Datas
                case 'contents':
                    $tables        = $this->requirements->model->contents;
                    $prefix        = 'content-';
                    $updatePrefix  = isset($_POST[md5('route-prefix')]) ? $_POST[md5('route-prefix')] : FALSE;
                    $updateTitle   = isset($_POST[md5('title')]) ? $_POST[md5('title')] : FALSE;
                    $updateSlug    = isset($_POST[md5('slug')]) ? ltrim($_POST[md5('slug')], '/') : FALSE;
                    $updateStatus  = isset($_POST[md5('status')]) ? $_POST[md5('status')] : FALSE;
                    $updateContent = isset($_POST[md5('content')]) ? $_POST[md5('content')] : FALSE;
                    $typeSetting   = FALSE;

                    // Validation process
                    !$updatePrefix ? FALSE : (preg_match('/[^a-z0-9&=?+%\/_-]/i',
                        $updatePrefix) ? die($this->errors->errSlugFormat) : ((preg_match('/^\//',
                        $updatePrefix)) ? ($updatePrefix = filter_var($updatePrefix, FILTER_SANITIZE_URL)) :
                        die($this->errors->errSlugFormat)));
                    !$updateSlug ? die($this->errors->errSlugEmpty) : (preg_match('/[^a-z0-9&=?+%\/_-]/i',
                        $updateSlug) ? die($this->errors->errSlugFormat) : ($updateSlug = "{$updatePrefix}/" .
                        filter_var(ltrim($updateSlug, '/'), FILTER_SANITIZE_URL)));
                    !$updateTitle ? ($updateTitle = 'Untitled') : ($updateTitle = htmlspecialchars($updateTitle));

                    // Create datas requirements
                    $datas = function() use($updateTitle, $updateSlug, $updateStatus, $updateAt,
                    $updatePrefix)
                    {
                        $dataPrefix  = array('route_prefix' => $updatePrefix);
                        $dataTitle   = $updateTitle ? array('title' => $updateTitle) : array();
                        $dataSlug    = $updateSlug ? array('slug' => $updateSlug) : array();
                        $dataStatus  = $updateStatus ? array('status' => $updateStatus) : array();
                        $fileName    = $updateSlug ? array('filename' => md5($updateSlug) . '.php') : array();
                        $dataUpdate  = array('updated_at' => $updateAt);

                        return array_merge($dataTitle, $dataSlug, $dataStatus, $fileName, $dataUpdate, $dataPrefix);
                    };
                    break;

                // Generate Layout Datas
                case 'layouts':
                    $tables        = $this->requirements->model->layouts;
                    $prefix        = 'layout-';
                    $updatePrefix  = isset($_POST[md5('prefix')]) ? $_POST[md5('prefix')] : FALSE;
                    $updateContent = isset($_POST[md5('content')]) ? $_POST[md5('content')] : FALSE;
                    $typeSetting   = FALSE;

                    // Validation process
                    !$updatePrefix ? die($this->errors->errPrefixEmpty) :
                        ($updatePrefix = htmlspecialchars($updatePrefix));

                    // Create datas requirements
                    $datas = function() use($updatePrefix, $updateAt)
                    {
                        $dataPrefix   = $updatePrefix ? array('prefix' => $updatePrefix) : array();
                        $dataFileName = $updatePrefix ? array('filename' => md5($updatePrefix) . '.php') :
                            array();
                        $dataUpdate = array('updated_at' => $updateAt);

                        return array_merge($dataPrefix, $dataFileName, $dataUpdate);
                    };
                    break;

                // Generate Home Builder Datas
                case 'home-builder':
                    $tables        = $this->requirements->model->home;
                    $prefix        = 'content-';
                    $updateContent = isset($_POST[md5('content')]) ? $_POST[md5('content')] : FALSE;
                    $updateStatus  = isset($_POST[md5('status')]) ? $_POST[md5('status')] : FALSE;
                    $typeSetting   = FALSE;

                    // Create datas requirements
                    $datas = function() use($updateStatus, $updateAt)
                    {
                        $dataStatus = $updateStatus ? array('status' => $updateStatus) : array();
                        $dataUpdate = array('updated_at' => $updateAt);

                        return array_merge($dataStatus, $dataUpdate);
                    };
                    break;

                // Generate Setting Datas
                case 'settings':
                    $typeSetting = isset($_POST[md5('type-setting')]) ? $_POST[md5('type-setting')] : FALSE;

                    // Filtering type setting
                    if($typeSetting == md5('profile'))
                    {
                        $tables            = $this->requirements->model->users;
                        $prefix            = 'user-';
                        $updateContent     = [];
                        $updateAt          = date('Y-m-d') . ' ' . date('H:i:s');
                        $updateFullName    = isset($_POST[md5('fullname')]) ? $_POST[md5('fullname')] : FALSE;
                        $updateUserName    = isset($_POST[md5('username')]) ? $_POST[md5('username')] : FALSE;
                        $updateEmail       = isset($_POST[md5('email')]) ? $_POST[md5('email')] : FALSE;
                        $updateOldPassword = (isset($_POST[md5('old-password')]) AND !empty(
                            $_POST[md5('old-password')])) ? $_POST[md5('old-password')] : FALSE;
                        $updateNewPassword = (isset($_POST[md5('new-password')]) AND !empty(
                            $_POST[md5('new-password')])) ? $_POST[md5('new-password')] : FALSE;
                        $updateConfirmPassword = (isset($_POST[md5('confirm-password')]) AND !empty(
                            $_POST[md5('confirm-password')])) ? $_POST[md5('confirm-password')] : FALSE;

                        // Validation process
                        !$updateEmail ? die($this->errors->errEmailEmpty) :
                            (preg_match('/[a-zA-Z0-9]+[@][a-z]+[.][a-z]+/', $updateEmail) ?
                            ($updateEmail = $updateEmail) : die($this->errors->errEmailFormat));
                        !$updateUserName ? die($this->errors->errUsernameEmpty) :
                            (preg_match('/[^a-zA-Z0-9@]/', $updateUserName) ?
                            die($this->errors->errFullnameFormat) : ($updateUserName = $updateUserName));
                        !$updateFullName ? die($this->errors->errFullnameEmpty) :
                            (preg_match('/[^a-zA-Z ]/', $updateFullName) ?
                            die($this->errors->errFullnameFormat) : ($updateFullName = $updateFullName));
                        (($updateOldPassword !== FALSE AND $updateNewPassword === FALSE) OR
                            ($updateNewPassword !== FALSE AND $updateOldPassword === FALSE) OR
                            ($updateConfirmPassword  !== FALSE AND $updateOldPassword === FALSE) OR
                            ($updateConfirmPassword !== FALSE AND $updateNewPassword === FALSE)) ?
                            die($this->errors->errPasswordAllEmpty) : TRUE;
                        $updateOldPassword ? (preg_match('/[^a-zA-Z0-9@]/i', $updateOldPassword) ?
                            die($this->errors->errPasswordFormat) : ($updateOldPassword = $updateOldPassword)) : FALSE;
                        $updateNewPassword ? (preg_match('/[^a-z0-9@]/i', $updateNewPassword) ?
                            die($this->errors->errPasswordFormat) : ($updateNewPassword = $updateNewPassword)) : FALSE;
                        $updateConfirmPassword ? (preg_match('/[^a-z0-9@]/i', $updateConfirmPassword) ?
                            die($this->errors->errPasswordFormat) : ($updateConfirmPassword = $updateConfirmPassword)) :
                             FALSE;

                        // Getting new password
                        $updateNewPassword = $updateNewPassword ? (($updateNewPassword === $updateConfirmPassword) ?
                            $updateNewPassword : die($this->errors->errConfirmationMatch)): FALSE;

                        // Create datas requirements
                        $datas = function() use($updateFullName, $updateUserName, $updateEmail, $updateAt,
                        $updateOldPassword, $updateNewPassword)
                        {
                            $dataFullName    = $updateFullName ? array('fullname' => $updateFullName) : array();
                            $dataUserName    = $updateUserName ? array('username' => $updateUserName) : array();
                            $dataEmail       = $updateEmail ? array('email' => $updateEmail) : array();
                            $dataUpdate      = array('updated_at' => $updateAt);
                            $dataOldPassword = $updateOldPassword ? array('old_password' => $updateOldPassword) : array();
                            $dataNewPassword = $updateNewPassword ? array('new_password' => $updateNewPassword) : array();

                            return array_merge($dataFullName, $dataUserName, $dataEmail, $dataUpdate, $dataOldPassword,
                                $dataNewPassword);
                        };
                    }
                    elseif($typeSetting == md5('optional'))
                    {
                        $tables     = $this->requirements->model->settings;
                        $updateLang = isset($_POST[md5('lang')]) ? $_POST[md5('lang')] : FALSE;

                        // Create datas requirements
                        $datas = function() use($updateLang)
                        {
                            $dataLang = $updateLang ? array('lang' => $updateLang) : array();
                            $dataNull = array('null' => 'null');

                            return array_merge($dataLang, $dataNull);
                        };
                    }
                    else
                    {
                        die($this->errors->errType);
                    }
                    break;

                // If type is undefined, the program will be destroyed instantly
                default:
                    die($this->errors->errType);
                    break;
            }

            // HANDLE PROCESS TO EDIT ITEMS
            // All actions of any types/items are handled here.
            // Make sure data you have sent is valid.
            foreach($tables->All() as $table)
            {
                // Filtering process
                if($type === 'settings' AND $typeSetting == md5('optional'))
                {
                    $dataKeys = array_keys($datas());

                    (in_array($table['meta'], $dataKeys)) ? ($tables->Update(['value' =>
                        $datas()[$table['meta']]], ['meta' => $table['meta']])) : FALSE;
                }
                else
                {
                    $id          = $table['id'];
                    $md5IdPrefix = md5($prefix . $id);
                    $process     = function() use ($datas, $tables, $table, $type, $updateContent, $typeSetting)
                    {
                        if($type === 'contents' OR $type === 'layouts')
                        {
                            $storage = ($type === 'contents') ? ($this->requirements->index->paths()['storage']) :
                                (($type === 'layouts') ? ($this->requirements->index->paths()['storage'] .
                                '/layouts') : FALSE);
                            $fileName = ($type === 'contents') ? (md5($table['slug']) . '.php') :
                                (($type === 'layouts') ? (md5($table['prefix']) . '.php') : FALSE);
                            $newName  = $datas()['filename'];
                            $filePath = "{$storage}/{$fileName}";
                            $newPath  = "{$storage}/{$newName}";

                            // Updating data and overwrite file if it has a new name or
                            // create one if it not exists
                            !file_exists($filePath) ? (fclose(fopen($filePath, 'w'))) : FALSE;
                            $tables->Update($datas(), ['id' => $table['id']]);
                            ($filePath !== $newPath) ? (rename($filePath, $newPath)) : FALSE;
                            file_exists($filePath) ? ($fOpen = fopen($filePath, 'w')) : FALSE;
                            file_exists($newPath) ? ($fOpen = fopen($newPath, 'w')) : FALSE;
                            $fOpen ? (fwrite($fOpen, $updateContent)) : FALSE;
                            $fOpen ? (fclose($fOpen)) : FALSE;
                        }
                        elseif($type === 'home-builder')
                        {
                            $storage  = $this->requirements->index->paths()['storage'] . '/home';
                            $fileName = md5('default-home-layout') . '.php';
                            $filePath = "{$storage}/{$fileName}";

                            // Updating data and overwrite file if it has a new name or
                            // create one if it not exists
                            !file_exists($filePath) ? (fclose(fopen($filePath, 'w'))) :
                                ($fOpen = fopen($filePath, 'w'));
                            $fOpen ? (fwrite($fOpen, $updateContent)) : FALSE;
                            $fOpen ? (fclose($fOpen)) : FALSE;
                            !empty($datas()) ? ($tables->Update($datas(), ['id' => $table['id']])) : FALSE ;
                        }
                        elseif($type === 'settings' AND $typeSetting == md5('profile'))
                        {
                            $newDatas = $datas();

                            if(isset($newDatas['old_password']) AND isset($newDatas['new_password']))
                            {
                                $oldPassword = md5($newDatas['old_password']);
                                $newPassword = md5($newDatas['new_password']);

                                // Getting new password and datas of user profile
                                unset($newDatas['old_password']);
                                unset($newDatas['new_password']);
                                $newDatas = ($oldPassword === $table['password']) ? (array_merge($newDatas,
                                    ['password' => $newPassword])) : die($this->errors->errPasswordMatch);
                            }

                            // Updating data and overwrite protected rule.
                            $tables->Update($newDatas, ['id' => $table['id']]);
                            $this->UNSET_RULE('auth');
                            $this->SET_RULE('auth', [$newDatas['fullname'], $newDatas['username'],
                                $newDatas['email']]);
                        }
                        else
                        {
                            // Updating data
                            $tables->Update($datas(), ['id' => $table['id']]);
                        }
                    };

                    // Updating item if it match from Database
                    isset($_POST[$md5IdPrefix]) ? $process() : TRUE;
                }
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
