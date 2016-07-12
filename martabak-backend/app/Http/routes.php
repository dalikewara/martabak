<?php

use App\Http\Controllers\Backend\Config\Setting;

// Frontend model
$frontend = new Setting;

// User and frontend routes
    // Auth
    Route::auth();

    // User process request
    Route::group(['prefix' => '/martabak/open/process'], function()
    {
        // Route::get('comment', function()
        // {
        //     return 'process';
        // });
    });

    // General
    Route::get('/', 'Frontend\View@home');
    Route::get($frontend->route->post_route . '/{content}', 'Frontend\View@post');
    Route::get($frontend->route->tag_route . '/{content}', 'Frontend\View@tag');
    Route::get($frontend->route->category_route . '/{content}', 'Frontend\View@category');
    Route::get($frontend->route->media_route . '/{content}/{filename}', 'Frontend\View@media');
    Route::get($frontend->route->page_route . '/{content}', 'Frontend\View@page');

// Admin and backend routes
Route::group(['middleware' => 'web'], function()
{
    // Defining model setting
    $homeland = new Setting;

    // Auth
    Route::auth();

    // Request url
    // Route::get($homeland->route->homeland_route, 'Backend\Homeland\Content@index');
    Route::get($homeland->route->homeland_route . '/{content}', 'Backend\Homeland\Content@content');
    Route::get($homeland->route->homeland_route . '/setting/{content}', 'Backend\Homeland\Content@setting');
    Route::get($homeland->route->homeland_route . '/theme/{content}', 'Backend\Homeland\Content@theme');
    Route::get($homeland->route->homeland_route . '/all/{content}', 'Backend\Homeland\All@content');
    Route::get($homeland->route->homeland_route . '/create/{content}', 'Backend\Homeland\Create@content');
    Route::get($homeland->route->homeland_route . '/create/{content}/all/{type}', 'Backend\Homeland\Create@all');
    Route::get($homeland->route->homeland_route . '/relation/{content}', 'Backend\Homeland\Relation@content');
    Route::get($homeland->route->homeland_route . '/trash/{content}', 'Backend\Homeland\Trash@content');
    Route::get($homeland->route->homeland_route . '/show/profile-pictures', 'Backend\Homeland\All@profilePicture');

    // Request process
    Route::post($homeland->route->homeland_route . '/process/create', 'Backend\Process\Create@index');
    Route::post($homeland->route->homeland_route . '/process/edit', 'Backend\Process\Edit@index');
    Route::post($homeland->route->homeland_route . '/process/remove', 'Backend\Process\Remove@index');
    Route::post($homeland->route->homeland_route . '/process/trash', 'Backend\Process\Trash@index');
    Route::post($homeland->route->homeland_route . '/process/status', 'Backend\Process\Status@index');
    Route::post($homeland->route->homeland_route . '/process/restore', 'Backend\Process\Restore@index');
    Route::post($homeland->route->homeland_route . '/process/setting', 'Backend\Process\Setting@index');
    Route::post($homeland->route->homeland_route . '/process/upload', 'Backend\Process\Upload@index');
});
