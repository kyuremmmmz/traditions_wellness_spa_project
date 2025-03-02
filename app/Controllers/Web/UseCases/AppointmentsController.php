<?php
namespace Project\App\Controllers\Web\UseCases;

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

    public function create()
    {
        $file = json_decode(file_get_contents('php://input'),true);
        if (isset($file['email'], $file['first_name'], $file['last_name'], $file['phone'])) {
            
        }
    }

    public function searchCustomer()
    {
        ob_clean();
            $response = $this->controller->findByRole('Customer');
            echo json_encode($response);
        exit;
    }

    public function edit($id)
    {
        // Code for showing an edit form
        echo "This is the edit method of AppointmentsController for ID: $id.";
    }

    public function update($id)
    {
        // Code for updating resources
        echo "This is the update method of AppointmentsController for ID: $id.";
    }

    public function delete($id)
    {
        // Code for deleting resources
        echo "This is the delete method of AppointmentsController for ID: $id.";
    }
}