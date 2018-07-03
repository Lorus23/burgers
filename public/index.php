<?php
session_start();
define('APPLICATION_PATH', realpath(__DIR__ . '/..') . '/app');
require_once __DIR__ . '/../vendor/autoload.php';

$routes = explode('/', $_SERVER['REQUEST_URI']);
$controllerName = "Order";
$actionName = "index";

if (sizeof($routes) > 2) {
    list(, $controllerName, $actionName) = $routes;
}
try {
    $className = '\App\Controllers\\' . ucfirst($controllerName) . 'Controller';// \App\PostsController
    $controller = new $className();
    if (method_exists($controller, $actionName)) {
        $controller->$actionName();
    } else {
        throw new Exception('Method not found');
    }
} catch (\Exception $e) {
    echo $e->getMessage();
}