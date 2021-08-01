<?php

ini_set('display_errors', 1);
ini_set('display_starup_error', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';
require_once '../app/controllers/IndexController.php';
require_once '../app/controllers/AuthController.php';
require_once '../app/controllers/UserController.php';

session_start();

$dotenv = Dotenv\Dotenv :: createUnsafeImmutable(__DIR__ . '/..');
$dotenv -> load();

use Illuminate\Database\Capsule\Manager as Capsule;
use Aura\Router\RouterContainer;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => getenv('DB_HOST'),
    'database'  => getenv('DB_NAME'),
    'username'  => getenv('DB_USER'),
    'password'  => getenv('DB_PASS'),
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

  // Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

  // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

$request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$routerContainer = new RouterContainer();

$map = $routerContainer->getMap();
$map->get('index', '/', [
    'controller' => 'app\controllers\IndexController',
    'action' => 'indexAction',
    'auth' => true
]);
$map->get('loginForm', '/login', [
    'controller' => 'app\controllers\AuthController',
    'action' => 'getLogin'
]);
$map->get('logout', '/logout', [
    'controller' => 'app\controllers\AuthController',
    'action' => 'getLogout',
    'auth' => true
]);
$map->post('auth', '/auth', [
    'controller' => 'app\controllers\AuthController',
    'action' => 'postLogin'
]);
$map->get('admin', '/admin', [
    'controller' => 'app\controllers\AdminController',
    'action' => 'getIndex',
    'auth' => true
]);
$map->get('addUsers', '/add/users', [
    'controller' => 'app\controllers\UserController',
    'action' => 'getAddUserAction'
]);
$map->post('saveUsers', '/add/users', [
    'controller' => 'app\controllers\UserController',
    'action' => 'getAddUserAction'
]);


$matcher = $routerContainer->getMatcher();
$route = $matcher->match($request);

function printElement()
{

}

if(!$route)
{
    echo 'No route';
}
else
{
    $handlerData = $route->handler;
    $controllerName = $handlerData['controller'];
    $actionName = $handlerData['action'];
    $needsAuth = $handlerData['auth'] ?? false;

    $sessionUserId = $_SESSION['userId'] ?? null;
    if($needsAuth && !$sessionUserId)
    {
        header('location: /login');
        exit;
    }
    $controller = new $controllerName;
    $response = $controller->$actionName($request);

    foreach($response -> getHeaders() as $name => $values)
    {
        foreach($values as $value)
        {
        header(sprintf('%s %s', $name, $value), false);
        }
    }
    http_response_code($response -> getStatusCode());
    echo $response -> getBody();
}

