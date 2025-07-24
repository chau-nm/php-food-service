<?php
define('PROJECT_ROOT', dirname(__DIR__ . "../"));
define('PROJECT_ROUTE', dirname(__DIR__ . "/../src/conf/routes"));

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/conf/appConfig.php';

app\model\Session::getInstance(); 

$request = new \app\model\request\Request();
\app\App::handle($request);