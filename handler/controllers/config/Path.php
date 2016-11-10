<?php namespace controller\config;

/**
* Martabak global paths configuration.
* This class is used by most cases in martabak handler system.
* We don't using paths separately, they all (the paths) defined here.
*/
class Path
{
    // Using Janggelan's global paths.
    use \glob\paths;

    // This for index identifier.
    private $root, $view, $public;

    /**
    * @return   mixed
    */
    function __construct()
    {
        // This contains paths that used 'root'
        $this->root = [
            'layouts_storage' => 'storages/layouts',
            'controllers_storage' => 'storages/controllers',
            'pages_storage' => 'storages/pages',
            'landings_storage' => 'storages/landings',
        ];
        // This contains paths that used 'public'
        $this->public = [
            'main_assets' => '/assets/main',
        ];
        // This contains paths that used 'view'
        $this->view = [
            'layouts' => 'layouts',
            'extended' => 'backend/extended',
        ];
    }

    /**
    * Get Martabak global paths.
    *
    * @param    string   $param
    * @return   string
    */
    function __get($param)
    {
        if(in_array($param, array_keys($this->root)))
        {
            return $this->getPaths()['root'] . '/' . $this->root[$param];
        }
        elseif(in_array($param, array_keys($this->public)))
        {
            return $this->public[$param];
        }
        elseif(in_array($param, array_keys($this->view)))
        {
            return $this->getPaths()['view'] . '/' . $this->view[$param];
        }
    }
}
