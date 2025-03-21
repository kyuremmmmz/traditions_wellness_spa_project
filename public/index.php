<?php

use App\Core\Router;

require_once '../app/core/Router.php';
require_once '../vendor/autoload.php';
// comment for branch posting
$router = new Router();
// API ROUTES
$router->get('/authCheck', 'CrudController@index');
$router->post('/login', 'AuthController@store');
$router->post('/logout', 'AuthController@logout');
$router->post('/register', 'RegistrationController@register');
$router->post('/forgot', 'AuthController@forgotPasswordSend');
$router->post('/forgotPass', 'AuthController@forgotPassword');
$router->post('/resetPassword', 'AuthController@resetPassword');
$router->post('/createCategory', 'ServicesController@createCategory');
$router->post('/appointCustomer', 'AppointmentsController@appointCustomer');
$router->get('/searchTherapist', 'AppointmentsController@searchTherapist');
$router->get('/searchCustomer', 'AppointmentsController@searchCustomer');
$router->get('/getAllTotal', 'AppointmentsController@getAllTotal');
$router->get('/store', 'ServicesController@store');
$router->post('/edit', 'ServicesController@edit');
$router->post('/updateAppointment', 'AppointmentsController@updateAppointment');
$router->post('/deleteAppointment', 'AppointmentsController@deleteAppointment');
$router->get('/fetchAppointments', 'AppointmentsController@fetchAppointments');
$router->post('/update', 'AccountSettingsController@update');
$router->post('/updatePassword', 'AccountSettingsController@updatePassword');
$router->post('/updateEmail', 'UpdateEmailController@updateEmail');
$router->post('/findByCode', 'UpdateEmailController@findByCode');
$router->post('/newEmail', 'UpdateEmailController@newEmail');
$router->post('/mobileLogin', 'AuthMobileController@login');
$router->post('/mobileRegistration', 'AuthMobileController@registration');
$router->post('/mobileVerification', 'AuthMobileController@verifyEmailAndPhone');
$router->post('/mobileforgot', 'AuthMobileController@forgotPasswordSend');
$router->post('/mobileforgotPass', 'AuthMobileController@forgotPassword');
$router->post('/mobileresetPassword', 'AuthMobileController@resetPassword');
$router->post('/mobileLogin', 'AuthMobileController@login');
$router->post('/mobileAddPassword', 'AuthMobileController@addPassword');
$router->post('/auth/check-token', 'AuthMobileController@checkToken');
$router->post('/auth/mobile-logout', 'AuthMobileController@logout');
$router->get('/mobileServices', 'Mobile\ServicesController@index');
$router->post('/continueRegistrationFunction', 'ContinueRegistrationController@continueRegistrationFunction');
$router->post('/uploadProfile', 'ContinueRegistrationController@uploadProfile');
$router->get('/test', function () {
    echo json_encode(['message' => 'Test route works']);
});


// VIEWS ROUTES
$router->view('/login', 'page', 'Auth/login', 'SessionMiddleware');
$router->view('/register', 'page', 'Auth/register', 'SessionMiddleware');
$router->view('/forgotpassword', 'page', 'Auth/forgotpassword', 'SessionMiddleware');
$router->view('/verification', 'page', 'Auth/verification', 'SessionMiddleware');
$router->view('/profile', 'page', 'DataPages/profile', 'SessionMiddleware');
$router->view('/dashboard', 'page', 'DataPages/dashboard', 'SessionMiddleware');
$router->view('/resetpassword', 'page', 'Auth/resetpassword', 'SessionMiddleware');
$router->view('/', 'index', '', 'SessionMiddleware');
$router->view('/success', 'page', 'Success');
$router->view('/Simulation', 'page', 'Simulation');
$router->view('/continueregistration', 'page', 'Auth/continueregistration');
$router->view('/test', 'page', 'test');
$router->view('/success', 'page', 'Success');
$router->view('/Simulation', 'page', 'Simulation');
$router->view('/uploadprofile', 'page', 'Auth/uploadprofile', 'SessionMiddleware');
$router->view('/appointments', 'page', 'Tools/Appointments', 'SessionMiddleware');
$router->view('/employees', 'page', 'Tools/Employees', 'SessionMiddleware');
$router->view('/finances', 'page', 'Tools/Finances', 'SessionMiddleware');
$router->view('/inventory', 'page', 'Tools/Inventory', 'SessionMiddleware');
$router->view('/branches', 'page', 'Tools/Branches', 'SessionMiddleware');
$router->view('/services', 'page', 'Tools/Services', 'SessionMiddleware');
$router->view('/users', 'page', 'Tools/Users', 'SessionMiddleware');
$router->view('/calendar', 'page', 'Utilities/Calendar', 'SessionMiddleware');
$router->view('/messages', 'page', 'Utilities/Messages', 'SessionMiddleware');
$router->view('/notifications', 'page', 'Utilities/Notifications', 'SessionMiddleware');
$router->view('/tasks', 'page', 'Utilities/Tasks', 'SessionMiddleware');
$router->view('/feedbacks', 'page', 'Utilities/Feedbacks', 'SessionMiddleware');
$router->view('/account', 'page', 'Utilities/Account', 'SessionMiddleware');
$router->view('/personalinfo', 'page', 'Utilities/Personalinfo', 'SessionMiddleware');
$router->view('/activities', 'page', 'Utilities/Activities', 'SessionMiddleware');
$router->view('/reporttickets', 'page', 'Utilities/ReportTickets', 'SessionMiddleware');
$router->view('/changepassword', 'page', 'Utilities/ChangeInfo/ChangePassword', 'SessionMiddleware');
$router->view('/changeemail', 'page', 'Utilities/ChangeInfo/ChangeEmail', 'SessionMiddleware');
$router->view('/changephonenumber', 'page', 'Utilities/ChangeInfo/ChangePhoneNumber', 'SessionMiddleware');
$router->view('/verificationforchangeemail', 'page', 'Utilities/VerificationInfo/VerificationForChangeEmail', 'SessionMiddleware');
$router->view('/editemail', 'page', 'Utilities/EditInfo/EditEmail', 'SessionMiddleware');
$router->view('/verificationforchangephonenumber', 'page', 'Utilities/VerificationInfo/VerificationForChangePhoneNumber', 'SessionMiddleware');
$router->view('/editphonenumber', 'page', 'Utilities/EditInfo/EditPhoneNumber', 'SessionMiddleware');
$router->view('/Utilities/Appointments', 'page', 'Utilities/Appointments', 'SessionMiddleware');
$router->view('/Tracker', 'page', 'Tools/Appointments/Tracker', 'SessionMiddleware');
$router->view('/addnewtherapist', 'page', 'tools/AddNewTherapist', 'SessionMiddleware');
$router->view('/ReviewsAndReports', 'page', 'ReviewsAndReports');

try {
    $router->resolve();
} catch (Exception $e) {
    http_response_code(404);
    echo json_encode(['error' => $e->getMessage()]);
}