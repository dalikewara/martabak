<?php

// Martabak needs the following class to create dinamically backend routes.
// Some default backend routes (/backend, /login, /logout) can be changed
// by user on the setting page.
$uri = new \controller\config\Uri;
$model = new \controller\config\Model;

// List of backend uris.
$this->request('GET / @Welcome::home');

// Generating user-defined uris.
array_walk($model->Page->where(['status' => 1])->get(), function($data) use($uri)
{
    $this->request('GET /' . $data->slug . ' (' . $uri->{'_storage_page'} . '/'
        . str_replace('.php', '', $data->filename) . ')');
});
array_walk($model->Route->where(['system' => 0])->get(), function($data)
{
    $this->request($data->method . ' ' . $data->uri . ' ' . $data->target);
});

$this->request('GET ' . $uri->login . ' @Welcome::login');
$this->request('GET ' . $uri->logout . ' @backend\Auth::logout !!protected');
$this->request('GET ' . $uri->backend . ' @backend\Welcome::dashboard !!protected');
$this->request('GET ' . $uri->backend . '/{content} @backend\Welcome::contents !!protected');
$this->request('GET ' . $uri->backend . '/get/content/{content} @backend\Welcome::preview !!protected');

// This is url to load all items of contents.
// In Martabak, each items called into document element by AJAX.
$this->request('GET ' . $uri->backend . '/all/{content} @backend\Content::load !!protected');
$this->request('GET ' . $uri->backend . '/all/toolkit/{content} @backend\Toolkit::load !!protected');

// The following uris is used for backend processes like edit, delete,
// add, etc.
$this->request('POST ' . $uri->backend . '/process/create/{content} @backend\Handler::create !!protected');
$this->request('POST ' . $uri->backend . '/process/edit/{content} @backend\Handler::update !!protected');
$this->request('POST ' . $uri->backend . '/process/delete/{content} @backend\Handler::delete !!protected');
$this->request('POST ' . $uri->backend . '/process/landing/content/{content} @backend\Landing::handler !!protected');
$this->request('POST ' . $uri->backend . '/process/landing/status/{content} @backend\Landing::status !!protected');
$this->request('POST ' . $uri->login . '/process @backend\Auth::login');
