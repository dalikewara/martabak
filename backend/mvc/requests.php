<?php
/*
| -----------------------------------------------------------------------------
| MARTABAK INSTALLATION ROUTE
| -----------------------------------------------------------------------------
|
| Comment (recommended) or remove the route bellow if you have done with system
| installation
|
*/
$this->url('GET / @backend\Installation::index');

/*
| -----------------------------------------------------------------------------
| MARTABAK SYSTEM ROUTES
| -----------------------------------------------------------------------------
|
| Uncomment the routes and codes bellow if you have done with system installation
|
*/
/*
$this->url('GET / @backend\UserRequestController::home');
$requirements = new \mvc\controllers\backend\config\Requirement;
$userRequests = new \mvc\controllers\backend\config\UserRequest;
$userContents = $userRequests->contents();
$userPaths    = $userRequests->userPaths();
array_walk($userContents, function($userContent){
    $this->url("GET {$userContent} @backend\UserRequestController::contents");});
array_walk($userPaths, function($userPath){
    $this->url($userPath['method'] . " " . $userPath['route'] .
    " @(" . $userPath['path'] . ")");});
$this->url("GET {$requirements->routeLogin} @backend\Auth::login");
$this->url("GET {$requirements->routeLogout} @backend\Auth::logout");
$this->url("POST {$requirements->requestAuthValid} @backend\Auth::validation");
$this->url("GET {$requirements->routeDashboard} @backend\Dashboard::index", 'auth');
$this->url("GET {$requirements->requestHomeBuilder} @backend\HomeBuilder::index", 'auth');
$this->url("GET {$requirements->requestCreate} @backend\Create::index", 'auth');
$this->url("GET {$requirements->requestEdit}/{title}/{slug} @backend\EditContent::index", 'auth');
$this->url("GET {$requirements->requestContents} @backend\Content::index", 'auth');
$this->url("GET {$requirements->requestSettings} @backend\Setting::index", 'auth');
$this->url("GET {$requirements->requestRoutes} @backend\Route::index", 'auth');
$this->url("GET {$requirements->requestLayouts} @backend\Layout::index", 'auth');
$this->url("GET {$requirements->requestControllers} @backend\ControllerGenerator::index", 'auth');
$this->url("GET {$requirements->requestMetas} @backend\Meta::index", 'auth');
$this->url("GET {$requirements->requestInformations} @backend\Information::index", 'auth');
$this->url("GET {$requirements->requestRealtime}/{prefix}/{name} @backend\Realtime::index", 'auth');
$this->url("GET {$requirements->extendedAll}/{type} @backend\Extended\All::index", 'auth');
$this->url("GET {$requirements->extendedSort}/{type} @backend\Extended\Sort::index", 'auth');
$this->url("GET {$requirements->extendedLayouts} @backend\Extended\InsertLayout::index", 'auth');
$this->url("GET {$requirements->extendedRoutes} @backend\Extended\RoutePrefix::index", 'auth');
$this->url("POST {$requirements->processCreate}/{type} @backend\process\Create::index", 'auth');
$this->url("POST {$requirements->processDelete}/{type} @backend\process\Delete::index", 'auth');
$this->url("POST {$requirements->processEdit}/{type} @backend\process\Edit::index", 'auth');
*/
