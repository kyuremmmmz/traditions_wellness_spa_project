<?php

use App\Core\Router;

require_once '../app/core/Router.php';
require_once '../vendor/autoload.php';

$router = new Router();
// API ROUTES
$router->get('/authCheck', 'CrudController@index');
$router->post('/login', 'AuthController@store');
$router->post('/logout', 'AuthController@logout');
$router->post('/register', 'AuthController@register');
$router->put('/forgot', 'AuthController@forgotPasswordSend');
$router->put('/forgotPass', 'AuthController@forgotPassword');
$router->get('/test', function () {
    echo json_encode(['message' => 'Test route works']);
});


// VIEWS ROUTES
$router->view('/login', 'page', 'login');
$router->view('/register', 'page', 'register');
$router->view('/forgotpassword', 'page', 'forgotpassword');
$router->view( '/profile', 'page', 'dashboard/profile', 'SessionMiddleware');
$router->view('/dashboard', 'page', 'dashboard', 'SessionMiddleware');
$router->view('/', 'index', '', 'SessionMiddleware');

try {
    $router->resolve();
} catch (Exception $e) {
    http_response_code(404);
    echo json_encode(['error' => $e->getMessage()]);
}
