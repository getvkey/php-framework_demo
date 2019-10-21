<?php

require 'vendor/autoload.php';
require 'application/lib/Dev.php'; //公共方法

use application\core\Router;

spl_autoload_register(function($class) {
    $path = str_replace('\\', '/', $class.'.php');
    if (file_exists($path)) {
        require $path;
    }
});

session_start();

//程序入口 进入路由匹配
$router = new Router;
$router->run();