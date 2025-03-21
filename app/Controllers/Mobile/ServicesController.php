<?php
namespace Project\App\Controllers\Mobile;

use Project\App\Models\Services\ServicesModel;

class ServicesController
{
    private $servicesModel;

    public function __construct()
    {
        $this->servicesModel = new ServicesModel();
    }
    public function index()
    {
        try {
            $services = $this->servicesModel->getAllServiceName();
            
            // Transform the data to include all required fields
            $formattedServices = array_map(function($service) {
                return [
                    'id' => $service['id'],
                    'name' => $service['serviceName'],
                    'description' => $service['description'],
                    'price' => (float)$service['price'],
                    'rating' => 0 // Default rating, implement actual rating system later
                ];
            }, $services);
            
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'success',
                'data' => $formattedServices
            ]);
        } catch (\Exception $e) {
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to fetch services'
            ]);
        }
    }

    public function create()
    {
        // Code for showing a create form
        echo "This is the create method of ServicesController.";
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