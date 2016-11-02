<?php

// Testing
// $model = new \model\Landing;
// $model->create();
// die;

// Martabak needs the following class to create dinamically backend routes.
// Some default backend routes (/backend, /login, /logout) can be changed
// by user on the setting page.
$uri = new \controller\config\Uri;

// List of backend uris.
$this->request('GET / @Welcome::home');
$this->request('GET ' . $uri->login . ' @Welcome::login');
$this->request('GET ' . $uri->logout . ' @Welcome::logout');
$this->request('GET ' . $uri->backend . ' @backend\Welcome::dashboard');
$this->request('GET ' . $uri->backend . '/{content} @backend\Welcome::contents');
$this->request('GET ' . $uri->backend . '/get/content/{content} @backend\Welcome::preview');

// This is url to load all items of contents.
// In Martabak, each items called into document element by AJAX.
$this->request('GET ' . $uri->backend . '/all/{content} @backend\Content::load');

// The following uris is used for backend processes like edit, delete,
// add, etc.
$this->request('POST ' . $uri->backend . '/process/create/{content} @backend\Handler::create');
$this->request('POST ' . $uri->backend . '/process/edit/{content} @backend\Handler::update');
$this->request('POST ' . $uri->backend . '/process/delete/{content} @backend\Handler::delete');
