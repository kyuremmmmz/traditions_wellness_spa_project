<?php
namespace Project\App\Controllers\Web\UseCases;

use Project\App\Models\Utilities\AddOnsModel;
use Exception;

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

    public function updateAddOns()
    {
        session_start();
        $data = $_POST;

        if (!isset($data['update_addon_id']) || !isset($data['update_name']) || !isset($data['update_price']) || !isset($data['update_status'])) {
            $_SESSION['error'] = 'Please fill in all fields.';
            header('Location: /services');
            exit;
        }

        $updateAddOns = $this->model->update(
            $data['update_addon_id'], 
            $data['update_name'], 
            $data['update_price'], 
            $data['update_status']
        );

        if ($updateAddOns) {
            $_SESSION['success'] = 'Add-on successfully updated.';
        } else {
            $_SESSION['error'] = 'Failed to update add-on.';
        }

        header('Location: /services');
        exit;
    }

    public function deleteAddOns()
    {
        session_start();

        // Ensure request is POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $_SESSION['error'] = 'Invalid request method.';
            header('Location: /services');
            exit;
        }

        // Get data from request
        $data = $_POST;

        // Check if addon_id is provided
        if (!isset($data['addon_id']) || empty($data['addon_id'])) {
            $_SESSION['error'] = 'Missing add-on ID.';
            header('Location: /services');
            exit;
        }

        // Attempt to delete the add-on
        $deleteAddOns = $this->model->delete($data['addon_id']);

        if ($deleteAddOns) {
            $_SESSION['success'] = 'Add-on successfully deleted.';
        } else {
            $_SESSION['error'] = 'Failed to delete add-on.';
        }

        header('Location: /services');
        exit;
    }


    public function findAddons()
    {
        header('Content-Type: application/json');
        try {
            $data = $this->model->getAll();
            echo json_encode([
                'status' => 'success',
                'data' => $data
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([]);
        }
        exit;
    }

    public function findActiveAddons()
    {
        header('Content-Type: application/json');
        try {
            $allAddons = $this->model->getAll();
            $activeAddons = array_filter($allAddons, function ($addon) {
                return $addon['status'] === 'Active';
            });
            echo json_encode([
                'status' => 'success',
                'data' => array_values($activeAddons)
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([]);
        }
        exit;
    }
}