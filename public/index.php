<?php

use App\Core\Router;

require_once '../app/core/Router.php';
require_once '../vendor/autoload.php';

$router = new Router();
// API ROUTES
$router->get('/authCheck', 'CrudController@index');
$router->post('/login', 'AuthController@store');
$router->post('/logout', 'AuthController@logout');
$router->post('/register', 'RegistrationController@register');
$router->post('/forgot', 'AuthController@forgotPasswordSend');
$router->post('/forgotPass', 'AuthController@forgotPassword');
$router->post('/resetPassword', 'AuthController@resetPassword');
$router->post('/mobileLogin', 'AuthMobileController@login');
$router->post('/mobileRegistration', 'AuthMobileController@registration');
$router->get('/test', function () {
    echo json_encode(['message' => 'Test route works']);
});


// VIEWS ROUTES
$router->view('/login', 'page', 'login');
$router->view('/register', 'page', 'register');
$router->view('/forgotpassword', 'page', 'forgotpassword');
$router->view('/verification', 'page', 'verification');
$router->view( '/profile', 'page', 'dashboard/profile', 'SessionMiddleware');
$router->view('/dashboard', 'page', 'dashboard', 'SessionMiddleware');
$router->view('/resetpassword', 'page', 'resetpassword');
$router->view('/', 'index', '', 'SessionMiddleware');
$router->view('/test', 'page', 'test');
$router->view('/success', 'page', 'Success');
$router->view('/Simulation', 'page', 'Simulation');
$router->view('/continueregistration', 'page', 'continueregistration');
$router->view('/test', 'page', 'test');
$router->view('/success', 'page', 'Success');
$router->view('/Simulation', 'page', 'Simulation');
$router->view('/uploadprofile', 'page', 'uploadprofile');
try {
    $router->resolve();
} catch (Exception $e) {
    http_response_code(404);
    echo json_encode(['error' => $e->getMessage()]);
}

