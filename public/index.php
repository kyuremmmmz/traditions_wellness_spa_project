<?php
// Suppress PHP errors from being displayed in output
error_reporting(E_ALL);
ini_set('display_errors', 0);

use App\Core\Router;
use Project\App\Core\Middleware\CorsMiddleware;

require_once '../app/core/Router.php';
require_once '../vendor/autoload.php';

// Apply CORS middleware to all requests
CorsMiddleware::handle(null, function() {});

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
$router->get('/fetchAppointmentsByStatus/{status}', 'AppointmentsController@fetchAppointmentsByStatus');
$router->get('/getAllTherapist', 'TherapistController@getAllTherapist');
$router->get('/getTherapistByStatus/{status}', 'TherapistController@getTherapistByStatus');
$router->post('/updateTherapist', 'TherapistController@updateTherapist');
$router->post('/addTherapist', 'TherapistController@addTherapist');
$router->get('/store', 'ServicesController@store');
$router->get('/findCategory/{category}', 'ServicesController@findCategory');
$router->get('/fetchAppointmentsByDate/{date}', 'AppointmentsController@fetchAppointmentsByDate');
$router->get('/findArchives', 'ServicesController@findArchives');
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
$router->post('/auth/check-verification', 'AuthMobileController@checkVerificationCode');

//  Mobile Services Routes
$router->get('/mobileServices', 'Mobile\ServicesController@index');
$router->get('/mobileServices/categories', 'Mobile\ServicesController@getCategories');
$router->get('/mobileServices/massage', 'Mobile\ServicesController@getMassageServices');
$router->get('/mobileServices/bodyscrub', 'Mobile\ServicesController@getBodyScrubServices');
$router->get('/mobileServices/packages', 'Mobile\ServicesController@getPackageServices');
$router->get('/mobileServices/category/:category', 'Mobile\ServicesController@getServicesByCategory');

// Mobile Appointment Routes
$router->get('/mobileAppointments', 'Mobile\OnlineAppointmentMobileController@index');
$router->get('/mobileAppointments/timeSlots', 'Mobile\OnlineAppointmentMobileController@getAvailableTimeSlots');
$router->post('/mobileAppointments', 'Mobile\OnlineAppointmentMobileController@store');
$router->put('/mobileAppointments/{id}', 'Mobile\OnlineAppointmentMobileController@update');


$router->post('/continueRegistrationFunction', 'ContinueRegistrationController@continueRegistrationFunction');
$router->post('/createService', 'ServicesController@createService');
$router->post('/createAddOns', 'AddOnsController@createAddOns');


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
$router->view('/Tracker', 'page', 'Tools/Appointments/Tracker', 'SessionMiddleware');
$router->view('/addnewtherapist', 'page', 'tools/AddNewTherapist', 'SessionMiddleware');
$router->view('/ReviewsAndReports', 'page', 'ReviewsAndReports');

try {
    $router->resolve();
} catch (Exception $e) {
    // Clean any existing output buffers
    while (ob_get_level()) {
        ob_end_clean();
    }
    
    // Check if this is an API request
    $isApiRequest = false;
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    
    if (strpos($path, '/mobile') === 0 || 
        (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') ||
        json_decode(file_get_contents('php://input'), true)) {
        $isApiRequest = true;
    }
    
    if ($isApiRequest) {
        // For API requests, return JSON error
        http_response_code(500);
        header('Content-Type: application/json');
        echo json_encode(['error' => $e->getMessage()]);
    } else {
        // For regular web requests, redirect to home
        http_response_code(404);
        header('Location:/');
    }
}