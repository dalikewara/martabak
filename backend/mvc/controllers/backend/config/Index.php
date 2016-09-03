<?php namespace mvc\controllers\backend\config;

class Index
{
    use \register\paths;

    /**
    * Get routes
    *
    * @param    string        $index
    * @return   string|bool
    */
    public function routes($index)
    {
        $sql    = new \mvc\controllers\universal\SQLGenerator;
        $routes = new \mvc\models\Route;
        $gets   = $routes->Select('route')->Clause($sql->where('prefix', ':prefix'))->
            BindParam(['prefix' => $index])->Result();

        return $gets ? $gets[0] : FALSE;
    }

    /**
    * Get paths
    *
    * @param    string   $this->getPath()['view']
    * @return   array
    */
    public function paths()
    {

        return [
            'admin-layouts' => $this->getPath()['view'] . '/backend/layouts',
            'admin-assets'  => '/frontend/assets',
            'admin-plugins' => '/frontend/plugins',
            'storage'       => $this->getPath()['view'] . '/backend/storage',
        ];
    }

    /**
    * Get views path
    *
    * @return   array
    */
    public function views()
    {

        return [
            'login'     => 'auth/login',
            'register'  => 'auth/register',
            'dashboard' => 'backend/dashboard',
            'storage'   => 'backend/storage',
        ];
    }

    /**
    * Generate $_GET prefix
    *
    * @return   array
    */
    public function getRequest()
    {

        return [
            'paginate'  => 'paginate',
            'sorted_by' => 'sorted_by',
            'order_by'  => 'order_by',
            'status'    => 'status',
            'search'    => 'search',
            'page'      => 'page'
        ];
    }
}
