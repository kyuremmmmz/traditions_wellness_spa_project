<?php

namespace Project\App\Controllers\Web\UseCases;

use DateTime;
use Project\App\Models\Utilities\AppointmentsModel;

use function Symfony\Component\Clock\now;

class AppointmentsController
{
    private $controller;
    public function __construct()
    {
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
        if (!isset($file['guestCustomer']) && !isset($file['SearchCustomer'])) {
            echo json_encode([
                'message' => 'Required fields are missing'
            ]);
        }

        $findUsers = $this->controller->findByNumber(trim($file['hiddenValue']));
        $findServiceByID = $this->controller->findById($file['service']);
        if ($findUsers) {
            http_response_code(200);
            $name = $findUsers['first_name'] . ' ' . $findUsers['last_name'];
            $appointCustomer = $this->controller->create(
                $name,
                $findUsers['id'],
                $findUsers['address'],
                $findUsers['phone'],
                $file['time'],
                $file['time'] + 2000,
                $findServiceByID['price'],
                'Hilot ko gago HAHAHAHAHAH',
                $file['service'],
                'pending',
                '2',
            );

            echo json_encode([
                'message' => 'Appointment created successfully',
            ]);
        } else {
            $appointCustomer = $this->controller->create(
                $file['guestCustomer'],
                1,
                'Ayala Ave, Quezon City',
                '09083217645',
                $file['time'],
                $file['time'] + 2000,
                $findServiceByID['price'],
                'Hilot ko gago HAHAHAHAHAH',
                $file['service'],
                'pending',
                '2',
            );
        }
    }

    public function searchTherapist()
    {
        ob_clean();
        $response = $this->controller->getAll();
        echo json_encode($response);
        exit;
    }


    public function searchCustomer()
    {
        ob_clean();
        $response = $this->controller->findByRole('Customer');
        echo json_encode($response);
        exit;
    }
}
