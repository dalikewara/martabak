<?php namespace glob; trait paths { static function getPaths() { return [

    /*
    * Global paths.
    */
    'backend'    => __DIR__ . '/..',
    'root'       => __DIR__ . '/../..',
    'worksheet'  => __DIR__ . '/../../handler',
    'config'     => __DIR__ . '/../config',
    'controller' => __DIR__ . '/../../handler/controllers',
    'models'     => __DIR__ . '/../../handler/models',
    'view'       => __DIR__ . '/../../handler/views',
    'public'     => $_SERVER['DOCUMENT_ROOT'],

];}}
