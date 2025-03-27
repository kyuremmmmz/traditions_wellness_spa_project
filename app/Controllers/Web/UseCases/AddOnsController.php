<?php
namespace Project\App\Controllers\Web\UseCases;

use Project\App\Models\Utilities\AddOnsModel;
class AddOnsController
{
    private $model;
    public function __construct()
    {
        $this->model = new AddOnsModel();
    }

    public function createAddOns()
    {
        session_start();
        $data = $_POST;
        if (!isset($data['name']) || !isset($data['price']) || !isset($data['status'])) {
            $_SESSION['error'] = 'Please fill in all fields.';
        }
        $createAddOns = $this->model->create($data['name'], $data['price'], $data['status']);
        if ($createAddOns) {
            $_SESSION['success'] = 'Add-on successfully added.';
            header('Location: /services');
        } else {
            $_SESSION['error'] = 'Failed to add add-on.';
            header('Location: /services');
        }

    }
}