<?php
namespace Project\App\Controllers\Web;
use Project\App\Models\ServicesModel;

class ServicesController
{
    private $model;
    public function __construct(){
        $this->model = new ServicesModel();
    }
    public function createCategory()
    {
        $data = $_POST;
        if (isset($data['categoryNameField'])) {
            $data = $this->model->createCategory($data['categoryNameField']);
            echo json_encode(
                [
                    'status' => $data
                ]
            );
        }
    }

    public function store()
    {
        // Code for storing new resources
        echo "This is the store method of ServicesController.";
    }

    public function edit($id)
    {
        // Code for showing an edit form
        echo "This is the edit method of ServicesController for ID: $id.";
    }

    public function update($id)
    {
        // Code for updating resources
        echo "This is the update method of ServicesController for ID: $id.";
    }

    public function delete($id)
    {
        // Code for deleting resources
        echo "This is the delete method of ServicesController for ID: $id.";
    }
}