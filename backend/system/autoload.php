<?php
$force = fopen(__DIR__ . '/force.config', 'r'); $forceUri = preg_replace('/\s/', '',
fgets($force)); fclose($force);
if($forceUri == 'FORCEURI:NO'){
$uri = ($_SERVER['REQUEST_URI'] !== '/' && file_exists(ltrim(urldecode(
parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)), '/'))) ? FALSE : TRUE;
$uri ? require_once 'vendor/autoload.php' : FALSE;
$uri ? require_once 'framework/janggelan/system/start.php' : FALSE;
}elseif($forceUri == 'FORCEURI:YES'){
require_once 'vendor/autoload.php';
require_once 'framework/janggelan/system/start.php';
}
