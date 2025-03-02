<?php
namespace Project\App\Controllers\Web\UseCases;
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
        $data2 = $this->model->getAll();
        echo json_encode([
            'message' => 'Connected successfully',
            'data' => $data2
        ]);

        exit;
    }




    public function edit()
    {
        $data = $_POST;
        if (isset($data['radioGroup'])) {
            $response = $this->model->update($data['radio'], json_encode($data['descriptions']), $data['price'], $data['serviceName']);
            header('Location:/services');
        }
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