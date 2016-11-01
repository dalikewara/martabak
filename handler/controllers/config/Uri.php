<?php namespace controller\config;

use model\Route;

/**
* Martabak global uris configuration.
* This class is used by most cases in martabak handler system.
* We don't using uris separately, they all (the uris) defined here.
*/
class Uri
{
    private $route, $default, $backends;

    /**
    * @return   mixed
    */
    function __construct()
    {
        // Initialize Route Model
        $this->route = new Route;
        // Set default uri that is not using 'backend'
        $this->default = ['login', 'logout'];
        // Set default uri that using backend as refference.
        $this->backends = [
            // Base
            '_layout' => ['layout', 'backend/layout'],
            '_controller' => ['controller', 'backend/controller'],
            '_page' => ['page', 'backend/page'],
            '_route' => ['route', 'backend/route'],
            '_note' => ['note', 'backend/note'],
            '_notes' => ['notes', 'backend/notes'],
            '_settings' => ['settings', 'backend/settings'],
            '_home_builder' => 'home-builder',
            '_meta' => ['meta', 'backend/meta'],
            '_landing' => ['landing', 'backend/landing'],
            '_assets_management' => ['assets-management', 'backend/assets-management'],
            '_logs' => ['logs', 'backend/logs'],
            // Custom
            'register_route' => 'route?action=register',
            'add_layout' => 'layout?action=add',
            'edit_layout' => 'layout?action=edit',
            'build_controller' => 'controller?action=build',
            'edit_controller' => 'controller?action=edit',
            'create_page' => 'page?action=create',
            'edit_page' => 'page?action=edit',
            'write_note' => 'note?action=write',
            'settings' => 'settings',
            'insert_meta' => 'meta?action=insert',
            'meta' => 'meta',
            'notes' => 'notes',
            'landing' => 'landing',
            'home' => 'landing?template=home',
            'construction' => 'landing?template=construction',
            'assets_management' => 'assets-management',
            'logs' => 'logs',
            'preview' => 'get/content/preview',
            'custom_preview' => 'get/content/custom-preview',
            // POST
            'create_note' => 'process/create/note',
            'create_page_c' => 'process/create/page',
            'create_controller' => 'process/create/controller',
            'create_route' => 'process/create/route',
            'create_layout' => 'process/create/layout',
            'create_meta' => 'process/create/meta',
            'edit_note' => 'process/edit/note',
            'edit_page_c' => 'process/edit/page',
            'edit_controller_c' => 'process/edit/controller',
            'edit_route' => 'process/edit/route',
            'edit_layout' => 'process/edit/layout',
            'edit_meta' => 'process/edit/meta',
            'edit_settings' => 'process/edit/settings',
            'edit_landing-home' => 'process/edit/landing-home',
            'edit_landing-construction' => 'process/edit/landing-construction',
            'delete_note' => 'process/delete/note',
            'delete_page_c' => 'process/delete/page',
            'delete_controller' => 'process/delete/controller',
            'delete_route' => 'process/delete/route',
            'delete_layout' => 'process/delete/layout',
            'delete_meta' => 'process/delete/meta',
            'delete_log' => 'process/delete/log',
            // All
            'all_pages' => 'all/pages',
            'all_controllers' => 'all/controllers',
            'all_routes' => 'all/routes',
            'all_layouts' => 'all/layouts',
            'all_metas' => 'all/metas',
            'all_notes' => 'all/notes',
            'all_logs' => 'all/logs',
        ];
    }

    /**
    * Get Martabak global uris.
    *
    * @param    string   $param
    * @return   string
    */
    function __get($param)
    {
        if(in_array($param, $this->default))
        {
            // Return uri.
            return $this->route->select('uri')->clause('WHERE prefix=:prefix')->
                bindParams(['prefix' => $param])->get(1)[0]->uri;
        }
        elseif(in_array($param, array_keys($this->backends)) OR $param === 'backend')
        {
            // Get default backend uri.
            $uri = $this->route->select('uri')->clause('WHERE prefix=:prefix')->
                bindParams(['prefix' => 'backend'])->get(1)[0]->uri;

            // Check for uri backend content.
            return ($param === 'backend') ? $uri : (isset($this->backends[$param])
                ? (($param[0] === '_') ? $this->backends[$param] :
                $uri . '/' . $this->backends[$param]) : false);
        }
    }
}
