<?php

use App\Core\Router;

require_once '../app/core/Router.php';
require_once '../vendor/autoload.php';

$router = new Router();

$router->get('/authCheck', 'CrudController@index');
$router->post('/login', 'AuthController@store', 'AuthMiddleware');
$router->put('/products/{id}', 'ProductController@update');
$router->delete('/products/{id}', 'ProductController@destroy');
$router->get('/test', function () {
    echo json_encode(['message' => 'Test route works']);
});

try {
    $router->resolve();
} catch (Exception $e) {
    http_response_code(404);
    echo json_encode(['error' => $e->getMessage()]);
}
