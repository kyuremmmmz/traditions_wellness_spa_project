<?php

use Project\App\Controllers\CrudController;
use Project\App\Models\CrudModelModel;

require_once '../app/core/Router.php'; 
require_once '../vendor/autoload.php'; 
$router = new App\Core\Router();


$router->get('/authCheck', 'CrudController@index');
$router->post('/products', 'ProductController@store');
$router->put('/products/{id}', 'ProductController@update');
$router->delete('/products/{id}', 'ProductController@destroy');
$router->get('/test', function () {
    echo json_encode(['message' => 'Test route works']);
});


try {
    $router->matchRoute();
} catch (Exception $e) {
    http_response_code(404);
    echo json_encode(['error' => $e->getMessage()]);
}
