<?php
namespace Project\App\Controllers\Web;
use Project\App\Models\Services\ServicesModel;
use Project\App\Views\Php\Components\Banners\RegularBanner;

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
            if (empty($data['categoryNameField'])) {
                header('Location: /services');
            }else{
                $data = $this->model->createCategory($data['categoryNameField']);
                header('Location: /services');
            }
        }else{
            header('Location: /services');
        }
    }

    public function store()
    {
        ob_clean();
        $data = $this->model->getAll();
        echo json_encode([
            'message' => 'Connected successfully',
            'data' => $data
        ]);

        exit;
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