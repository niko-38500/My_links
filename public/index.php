<?php

use App\Container\Container;

require "../vendor/autoload.php";
require '../config/route.php';
session_start();
$route = filter_input(INPUT_SERVER, "PATH_INFO");
$file = null;
if (null === $route) {
    $route = '/';
}

foreach ($routes as $url => $option) {
    if ($url === $route) {
        $class = '\\App\\Controller\\' . $option['controller'];
        $action = $option['action'];
        $container = new Container($class, $action);
        $instance = $container->resolve();
        $container->execute($instance);
    }
}

// foreach ($routes as $url => $option) {
//     if ($url === $route) {
//         $class = '\\App\\Controller\\' . $option['controller'];
//         $action = $option['action'];
//         $controller = new $class;
//         $controller->$action();
//     }
// }















// foreach ($routes as $url => $page) {
//     if ($url === $route) {
//         $file = $page;
//         include '../src/controller/' . $file . 'Controller.php';
//         $page($file, $isLogged);
//     }
// }