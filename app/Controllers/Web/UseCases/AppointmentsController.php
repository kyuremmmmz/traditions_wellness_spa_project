<?php
namespace Project\App\Controllers\Web\UseCases;

use DateTime;
use Project\App\Models\Utilities\AppointmentsModel;

class AppointmentsController
{
    private $controller;
    public function __construct(){
        $this->controller = new AppointmentsModel();
    }
    public function index()
    {
        // Code for listing resources
        echo "This is the index method of AppointmentsController.";
    }
    /*
    TODO:
    INTRO LINE
    if the available inputs are empty except optionals,
    Message("please enter required fields");
    else
    $findByUsers = $this->controller->findByUser(); this method is in the model select

    THERAPIST LINE
    if therapistTime > currenttime || therapistStatus['status'] == "available"
    Message("This therapist is  avaiblable")
    else
    Message("This therapist is not avaiblable")
    Consider the realtime updates of the therapist tables
    

    SERVICE LINE:
    findByServiceID = findByID
    if service chosen is not match to or in array $file['serviceChosen']
    */
    public function appointCustomer()
    {
        $file = $_POST;
        $requiredFields = ['name', 'contactNumber', 'serviceChosen', 'date', 'time', 'hrs'];
        foreach ($requiredFields as $field) {
            if (!isset($file[$field]) || trim($file[$field]) === '') {
                http_response_code(400);
                echo json_encode([
                    'message' => "Please enter required fields: $field is missing"
                ]);
                return;
            }
        }

        $findUsers = $this->controller->findByNumber(trim($file['contactNumber']));
        if ($findUsers) {
            http_response_code(200);

            $name = $findUsers['first_name'] . ' ' . $findUsers['last_name'];

            $startTime = new DateTime($file['time']);
            $duration = (int) $file['hrs'];

            $endTime = clone $startTime;
            $endTime->modify("+{$duration} hours");

            $formattedStartTime = $startTime->format("H:i");
            $formattedEndTime = $endTime->format("H:i");

            $appointCustomer = $this->controller->create(
                $name,
                $findUsers['userID'],
                $findUsers['address'],
                $findUsers['phone'],
                $formattedStartTime,
                $formattedEndTime,  
                '',
                '',
                '',
                '',
                '',
                '',
                '',
            );

            echo json_encode([
                'message' => 'Appointment created successfully',
                'start_time' => $formattedStartTime,
                'end_time' => $formattedEndTime,
                'total_hrs' => $duration
            ]);
        } else {
            http_response_code(404);
            echo json_encode([
                'message' => 'Phone not found'
            ]);
        }
    }


    public function searchCustomer()
    {
        ob_clean();
            $response = $this->controller->findByRole('Customer');
            echo json_encode($response);
        exit;
    }
}