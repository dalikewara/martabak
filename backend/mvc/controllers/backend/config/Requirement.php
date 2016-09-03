<?php namespace mvc\controllers\backend\config;

use mvc\controllers\universal\SQLGenerator;

class Requirement extends \system\parents\Controller
{
    public $model, $index, $sqlGenerator, $langs;
    public $adminFullname, $adminPicture, $adminAssets, $adminLayouts,
           $adminPlugins;
    public $routeLogout, $routeDashboard, $routeContent, $routeLogin;
    public $requestCreate, $requestSettings, $requestRoutes, $requestContents,
           $requestEdit, $requestLayouts, $requestHomeBuilder, $requestInformations,
           $requestControllers, $requestMetas, $requestAuthValid, $requestRealtime;
    public $extendedAll, $extendedSort, $extendedLayouts, $extendedRoutes;
    public $processCreate, $processDelete, $processEdit;
    public $indexLang;

    /**
    * @return   mixed
    */
    public function __construct()
    {
        // Initialize Objects
        $this->model         = new Model;
        $this->index         = new Index;
        $this->langs         = new Lang;
        $this->sqlGenerator  = new SQLGenerator;

        // This is for admin properties
        $this->adminFullname = Parent::GET_RULE('auth')[0];
        $this->adminLayouts  = $this->index->paths()['admin-layouts'];
        $this->adminAssets   = $this->index->paths()['admin-assets'];
        $this->adminPlugins  = $this->index->paths()['admin-plugins'];

        // This is for routes property
        $this->routeLogout    = $this->index->routes('logout');
        $this->routeLogin     = $this->index->routes('login');
        $this->routeDashboard = $this->index->routes('dashboard');
        $this->routeContent   = $this->index->routes('content');

        // This is for requests property
        $this->requestCreate       = "{$this->routeDashboard}/create/content";
        $this->requestSettings     = "{$this->routeDashboard}/settings";
        $this->requestRoutes       = "{$this->routeDashboard}/routes";
        $this->requestContents     = "{$this->routeDashboard}/contents";
        $this->requestEdit         = "{$this->routeDashboard}/edit/content";
        $this->requestLayouts      = "{$this->routeDashboard}/layouts";
        $this->requestHomeBuilder  = "{$this->routeDashboard}/home-builder";
        $this->requestInformations = "{$this->routeDashboard}/informations";
        $this->requestControllers  = "{$this->routeDashboard}/controllers";
        $this->requestMetas        = "{$this->routeDashboard}/metas";
        $this->requestAuthValid    = "{$this->routeDashboard}/process/validation/{type}";
        $this->requestRealtime     = "{$this->routeDashboard}/realtime/preview";

        // This is for extended properties
        $this->extendedAll     = "{$this->routeDashboard}/extended/all";
        $this->extendedSort    = "{$this->routeDashboard}/extended/sort/properties";
        $this->extendedLayouts = "{$this->routeDashboard}/extended/insert/layouts";
        $this->extendedRoutes  = "{$this->routeDashboard}/extended/routes/prefix";

        // This is for process properties
        $this->processCreate = "{$this->routeDashboard}/process/create";
        $this->processDelete = "{$this->routeDashboard}/process/delete";
        $this->processEdit   = "{$this->routeDashboard}/process/edit";

        // This is to index languages
        $this->indexLang = $this->model->settings->Select('value')->Clause(
            $this->sqlGenerator->where('meta', ':meta'))->BindParam(['meta' => 'lang'])
            ->Range(1)->Result()[0];
    }

    /**
    * Dashboard requirements
    *
    * @return   array
    */
    public function dashboard()
    {
        return [
            'admin-fullname'  => $this->adminFullname,
            'admin-assets'    => $this->adminAssets,
            'admin-layouts'   => $this->adminLayouts,
            'request-create'  => $this->requestCreate
        ];
    }

    /**
    * System Informations requirements
    *
    * @return   array
    */
    public function informations()
    {
        return [
            'admin-fullname'  => $this->adminFullname,
            'admin-assets'    => $this->adminAssets,
            'admin-layouts'   => $this->adminLayouts,
        ];
    }

    /**
    * Routes requirements
    *
    * @return   array
    */
    public function routes()
    {
        return [
            'admin-fullname'  => $this->adminFullname,
            'admin-assets'    => $this->adminAssets,
            'admin-layouts'   => $this->adminLayouts,
            'route-dashboard' => $this->routeDashboard,
        ];
    }

    /**
    * Contents requirements
    *
    * @return   array
    */
    public function contents()
    {
        return [
            'admin-fullname'  => $this->adminFullname,
            'admin-assets'    => $this->adminAssets,
            'admin-plugins'   => $this->adminPlugins,
            'admin-layouts'   => $this->adminLayouts,
            'route-dashboard' => $this->routeDashboard,
        ];
    }

    /**
    * "Create" requirements
    *
    * @return   array
    */
    public function create()
    {
        return [
            'admin-fullname'  => $this->adminFullname,
            'admin-assets'    => $this->adminAssets,
            'admin-layouts'   => $this->adminLayouts,
            'route-dashboard' => $this->routeDashboard,
            'route-content'   => $this->routeContent,
            'request-create'  => $this->requestCreate,
            'admin-plugins'   => $this->adminPlugins
        ];
    }

    /**
    * Header requirements
    *
    * @return   array
    */
    public function header()
    {
        return [
            'admin-assets'          => $this->adminAssets,
            'route-logout'          => $this->routeLogout,
            'admin-fullname'        => $this->adminFullname,
            'admin-picture'         => $this->adminPicture,
            'route-dashboard'       => $this->routeDashboard,
            'request-create'        => $this->requestCreate,
            'request-settings'      => $this->requestSettings,
            'request-routes'        => $this->requestRoutes,
            'request-contents'      => $this->requestContents,
            'request-layouts'       => $this->requestLayouts,
            'request-home-builder'  => $this->requestHomeBuilder,
            'request-informations'  => $this->requestInformations,
            'request-controllers'   => $this->requestControllers,
            'request-metas'         => $this->requestMetas,
        ];
    }

    /**
    * Layouts requirements
    *
    * @return   array
    */
    public function layouts()
    {
        return [
            'admin-fullname'  => $this->adminFullname,
            'admin-assets'    => $this->adminAssets,
            'admin-layouts'   => $this->adminLayouts,
            'route-dashboard' => $this->routeDashboard,
        ];
    }

    /**
    * Settings requirements
    *
    * @return   array
    */
    public function settings()
    {
        return [
            'admin-fullname'  => $this->adminFullname,
            'admin-assets'    => $this->adminAssets,
            'admin-layouts'   => $this->adminLayouts,
            'route-dashboard' => $this->routeDashboard,
        ];
    }
}
