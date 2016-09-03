<?php namespace register; trait paths { static function getPath() { return [
'realpath'   => __DIR__ . '/../../',
'root'       => __DIR__ . '/../../../',
'config'     => __DIR__ . '/../../config',
'controller' => __DIR__ . '/../../mvc/controllers',
'view'       => __DIR__ . '/../../mvc/views',
'public'     => $_SERVER['DOCUMENT_ROOT'] . '/',
];}}
