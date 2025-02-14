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
$router->post('/mobileVerification', 'AuthMobileController@verifyEmailAndPhone');
$router->post('/mobileforgot', 'AuthMobileController@forgotPasswordSend');
$router->post('/mobileforgotPass', 'AuthMobileController@forgotPassword');
$router->post('/mobileresetPassword', 'AuthMobileController@resetPassword');
$router->post('/mobileLogin', 'AuthMobileController@login');
$router->post('/continueRegistrationFunction', 'ContinueRegistrationController@continueRegistrationFunction');
$router->get('/test', function () {
    echo json_encode(['message' => 'Test route works']);
});


// VIEWS ROUTES
$router->view('/login', 'page', 'Auth/login', 'SessionMiddleware');
$router->view('/register', 'page', 'Auth/register', 'SessionMiddleware');
$router->view('/forgotpassword', 'page', 'Auth/forgotpassword', 'SessionMiddleware');
$router->view('/verification', 'page', 'Auth/verification', 'SessionMiddleware');
$router->view( '/profile', 'page', 'DataPages/profile', 'SessionMiddleware');
$router->view('/dashboard', 'page', 'DataPages/dashboard', 'SessionMiddleware');
$router->view('/resetpassword', 'page', 'Auth/resetpassword', 'SessionMiddleware');
$router->view('/', 'index', '', 'SessionMiddleware');
$router->view('/test', 'page', 'test');
$router->view('/success', 'page', 'Success');
$router->view('/Simulation', 'page', 'Simulation');
$router->view('/continueregistration', 'page', 'Auth/continueregistration');
$router->view('/test', 'page', 'test');
$router->view('/success', 'page', 'Success');
$router->view('/Simulation', 'page', 'Simulation');
$router->view('/uploadprofile', 'page', 'Auth/uploadprofile');
try {
    $router->resolve();
} catch (Exception $e) {
    http_response_code(404);
    echo json_encode(['error' => $e->getMessage()]);
}

