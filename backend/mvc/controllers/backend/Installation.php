<?php namespace mvc\controllers\backend;

use mvc\controllers\backend\config\Model;
use mvc\controllers\universal\AuthValidation;
use mvc\controllers\universal\SQLGenerator;
use mvc\controllers\universal\Tokenizer;

class Installation extends \system\parents\Controller
{
    use \register\paths;

    private $model, $validation, $sqlGenerator, $tokenizer;

    public function __construct()
    {
        $this->model        = new Model;
        $this->validation   = new AuthValidation;
        $this->sqlGenerator = new SQLGenerator;
        $this->tokenizer    = new Tokenizer;
    }

    /**
    * @return   mixed
    */
    public function index()
    {
        // DEFINING AND PROCESSING installation.config DATAS
        // Martabak uses installation.config to identificate installation datas.
        // The file must exists in backend directory while do Installation Process.
        $indexX      = 0;
        $validLangs  = ['id', 'en'];
        $installConf = $this->getPath()['realpath'] . 'installation.config';
        $installOpen = file_exists($installConf) ? fopen($installConf, 'r') :
            die('WARNING: installation.config is not exists on your backend!');
        $installArray = $installDatas = [];
        while(!feof($installOpen))
        {
            $fGets                 = fgets($installOpen);
            $installArray[$indexX] = explode(':', preg_replace('/\n/', '',
                preg_replace('/[\s]+[:][\s]+/', ':', $fGets)));
            $indexX++;
        }
        unset($installArray[count($installArray) - 1]);
        foreach($installArray as $index)
        {
            $installDatas[strtolower(reset($index))] = end($index);
        }
        // VALIDATING DATAS
        // You must enter your config data correctly to system can works perfectly.
        isset($installDatas['fullname']) ? (!$this->validation->fullnameValidation(
            $installDatas['fullname']) ? die('Wrong fullname format!') : TRUE) :
            die('Unknown fullname!');
        isset($installDatas['username']) ? (!$this->validation->usernameValidation(
            $installDatas['username']) ? die('Wrong username format!') : TRUE) :
            die('Unknown username!');
        isset($installDatas['email']) ? (!$this->validation->emailValidation(
            $installDatas['email']) ? die('Wrong email format!') : TRUE) :
            die('Unknown email!');
        isset($installDatas['password']) ? (!$this->validation->passwordValidation(
            $installDatas['password']) ? die('Wrong password format!') :
            ($installDatas['password'] = md5($installDatas['password']))) :
            die('Unknown password!');
        isset($installDatas['default_lang']) ? (!in_array($installDatas['default_lang'],
            $validLangs) ? die('Wrong lang format!') : TRUE) :
            ($installDatas['default_lang'] = 'en');
        // DEFINING DATE AND TIME
        // This is the default PHP time system, may not correct in your location.
        $dateNow = date('Y-m-d') . ' ' . date('H:i:s');
        // CREATING TABLES
        // Table will not be created if it has on the Database
        $this->model->users->Create();
        $this->model->settings->Create();
        $this->model->langs->Create();
        $this->model->home->Create();
        $this->model->routes->Create();
        $this->model->layouts->Create();
        $this->model->contents->Create();
        $this->model->informations->Create();
        $this->model->tokens->Create();
        // INSERTING DEFAULT SYSTEM DATAS
        // Some of these tables bellow have Unique table column.
        // In normally system has controls what data can be inserted on Unique column.
        // But, to avoid problems, you may have to delete your columns first (optional),
        // or make check that the Unique columns doesn't have duplicate values.
        //
        // Here you will see the default datas needed of Martabak system requirements.
        ////// ROUTES
            (count($this->model->routes->Clause($this->sqlGenerator->singleWhere(
                'prefix=:prefix || route=:route'))->BindParam(['prefix' => 'login',
                'route' => '/login'])->Result()) > 0) ? FALSE : (
                $this->model->routes->Insert(['prefix' => 'login', 'route' => '/login',
                'path' => 'null', 'method' => 'GET', 'system' => 1,
                'created_at' => $dateNow, 'updated_at' => $dateNow]));
            (count($this->model->routes->Clause($this->sqlGenerator->singleWhere(
                'prefix=:prefix || route=:route'))->BindParam(['prefix' => 'logout',
                'route' => '/logout'])->Result()) > 0) ? FALSE : (
                $this->model->routes->Insert(['prefix' => 'logout', 'route' => '/logout',
                'path' => 'null', 'method' => 'GET', 'system' => 1,
                'created_at' => $dateNow, 'updated_at' => $dateNow]));
            (count($this->model->routes->Clause($this->sqlGenerator->singleWhere(
                'prefix=:prefix || route=:route'))->BindParam(['prefix' => 'dashboard',
                'route' => '/backend'])->Result()) > 0) ? FALSE : (
                $this->model->routes->Insert(['prefix' => 'dashboard', 'route' => '/backend',
                'path' => 'null', 'method' => 'GET', 'system' => 1,
                'created_at' => $dateNow, 'updated_at' => $dateNow]));
        ////// LANGS
            (count($this->model->langs->Clause($this->sqlGenerator->where(
                'prefix', ':prefix'))->BindParam(['prefix' => 'indonesian'])->
                Result()) > 0) ? FALSE : ($this->model->langs->Insert([
                'prefix' => 'indonesian', 'value' => 'id']));
            (count($this->model->langs->Clause($this->sqlGenerator->where(
                'prefix', ':prefix'))->BindParam(['prefix' => 'english'])->
                Result()) > 0) ? FALSE : ($this->model->langs->Insert([
                'prefix' => 'english', 'value' => 'en']));
        ////// HOME
            (count($this->model->home->Clause($this->sqlGenerator->where(
                'filename', ':filename'))->BindParam(['filename' =>
                md5('default-home-layout') . '.php'])->Result()) > 0) ? FALSE :
                ($this->model->home->Insert(['filename' =>
                md5('default-home-layout') . '.php', 'status' => 2,
                'created_at' => $dateNow, 'updated_at' => $dateNow]));
            (count($this->model->home->Clause($this->sqlGenerator->where(
                'filename', ':filename'))->BindParam(['filename' =>
                md5('default-under-construction-layout') . '.php'])->Result()) > 0)
                ? FALSE : ($this->model->home->Insert(['filename' =>
                md5('default-under-construction-layout') . '.php', 'status' => 1,
                'created_at' => $dateNow, 'updated_at' => $dateNow]));
        ////// SETTINGS
            (count($this->model->settings->Clause($this->sqlGenerator->where(
                'meta', ':meta'))->BindParam(['meta' => 'lang'])->
                Result()) > 0) ? FALSE : ($this->model->settings->Insert([
                'meta' => 'lang', 'value' => $installDatas['default_lang']]));
        ////// USER
            (count($this->model->users->Clause($this->sqlGenerator->singleWhere(
                'username=:username || email=:email'))->BindParam(['username' =>
                $installDatas['username'], 'email' => $installDatas['email']])->
                Result()) > 0) ? FALSE : ($this->model->users->Insert(['fullname'
                => $installDatas['fullname'], 'username' => $installDatas['username'],
                'email' => $installDatas['email'], 'password' => $installDatas['password'],
                'created_at' => $dateNow, 'updated_at' => $dateNow]));
        ////// TOKEN
            (count($this->model->tokens->Clause($this->sqlGenerator->where(
                'user_id', ':user_id'))->BindParam(['user_id' => $this->model->users->
                Clause($this->sqlGenerator->singleWhere('username=:username || email=:email'))
                ->BindParam(['username' => $installDatas['username'], 'email' =>
                $installDatas['email']])->Range(1)->Result()[0]['id']])->
                Result()) > 0) ? FALSE : ($this->model->tokens->Insert([
                'user_id' => $this->model->users->Clause($this->sqlGenerator->singleWhere(
                'username=:username || email=:email'))->BindParam(['username' =>
                $installDatas['username'], 'email' => $installDatas['email']])->Range(1)
                ->Result()[0]['id'], 'token' => $this->tokenizer->generateToken($this->model->users->
                Clause($this->sqlGenerator->singleWhere('username=:username || email=:email'))->
                BindParam(['username' => $installDatas['username'], 'email' =>
                $installDatas['email']])->Range(1)->Result()[0]['password'])]));
        ////// INFORMATION
            (count($this->model->informations->Clause($this->sqlGenerator->where(
                'id', ':id'))->BindParam(['id' => 1])->Result()) > 0) ? (
                $this->model->informations->Update(['id' => 1, 'version' => '0.0.1',
                'codename' => 'Z', 'released_at' => 'Friday, 02/09/2016', 'author' =>
                '<a href="http://dalikewara.com">Dali Kewara</a>', 'license' => 'Apache'],
                ['id' => 1])) : ($this->model->informations->Insert(['id' => 1,
                'version' => '0.0.1', 'codename' => 'Z', 'released_at' => 'Friday, 02/09/2016',
                'author' => '<a href="http://dalikewara.com">Dali Kewara</a>',
                'license' => 'Apache']));
        // INSTALLATION FINISH
        // If the process has done without errors, please follow the next instructions appeared.
        die('
            <div style="padding:40px">
                <h1>Congratulation! The Installation Has Finished Successfully.</h1>
                <hr>
                <p>
                    <span style="color:blue">* Take a Look About Informations Bellow:</span>
                    <ul style="line-height:2">
                        <li>
                            Please go to your <code>requests.php</code> <i style="color:grey"><u>
                            "/your-backend/mvc/requests.php"</u></i>, comment (recommended) or remove
                            installation url, and uncomment the Martabak System Routes.
                        </li>
                        <li>
                            Don' . "'" . 't be worried if you found your homepage displayed Under Construction view.
                            It' . "'" . 's the standart of the fresh Martabak. You just have to login to backend,
                            go to Home Builder, and create or publish your own homepage view there.
                        </li>
                        <li>
                            This is default routes for fresh Martabak (you can make changes later):
                            <ul>
                                <li>Log in = <u>/login</u></li>
                                <li>Log out = <u>/logout</u></li>
                                <li>Dashboard = <u>/backend</u></li>
                            </ul>
                        </li>
                        <li>
                            For security, you can delete your <code>installation.config</code>. The file
                            is only used for system installation. If you in some reasons want to
                            reinstall Martabak, the config must exists in your backend folder/directory
                            (if you just deleted it, create it again).
                        </li>
                        <li>
                            Enjoy with Martabak. We always update & improve our services as soon as possible.
                        </li>
                    </ul>
                </p>
            </div>
        ');
    }
}
