<?php
namespace Project\App\Controllers\Mobile;

use Project\App\Models\TherapistModel;


class TherapistAuthController
{
    private $models;
    public function __construct(){
        $this->models = new TherapistModel();
    }
    public function index()
    {
        // Code for listing resources
        echo "This is the index method of TherapistAuthController.";
    }


    public function login()
    {
        $file = json_encode(file_get_contents('php://input'), true);
        if (isset($file['phone'])) {
            $isFirstTimeLogin = $this->models->findByPhone($file['phone']);
            if (is_array($isFirstTimeLogin) && $isFirstTimeLogin['firstTime'] === true ) {
                header('Location: /continueRegistration');
                // Testing Purposes
                echo json_encode([
                    'RouteTest' => 'you are in first time logged in'
                ]);
            }else{
                header('Location:/');
                // Testing Purposes
                echo json_encode([
                    'RouteTest' => 'you are now in home'
                ]);
            }
        }
    }

    public function edit($id)
    {
        // Code for showing an edit form
        echo "This is the edit method of TherapistAuthController for ID: $id.";
    }

    public function update($id)
    {
        // Code for updating resources
        echo "This is the update method of TherapistAuthController for ID: $id.";
    }

    public function delete($id)
    {
        // Code for deleting resources
        echo "This is the delete method of TherapistAuthController for ID: $id.";
    }
}