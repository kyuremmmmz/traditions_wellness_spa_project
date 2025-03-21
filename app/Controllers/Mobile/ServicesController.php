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

    public function getCategories()
    {
        try {
            $categories = $this->servicesModel->getAll();
            $uniqueCategories = array_unique(array_column($categories, 'category'));
            
            $formattedCategories = array_values(array_filter($uniqueCategories));
            
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'success',
                'data' => $formattedCategories
            ]);
        } catch (\Exception $e) {
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to fetch categories'
            ]);
        }
    }

    public function getServiceDetails($id)
    {
        try {
            $service = $this->servicesModel->find($id);
            
            if (!$service) {
                header('Content-Type: application/json');
                http_response_code(404);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Service not found'
                ]);
                return;
            }
            
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'success',
                'data' => $service
            ]);
        } catch (\Exception $e) {
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to fetch service details'
            ]);
        }
    }

    public function createCategory()
    {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (!isset($data['category']) || empty($data['category'])) {
                header('Content-Type: application/json');
                http_response_code(400);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Category name is required'
                ]);
                return;
            }
            
            $result = $this->servicesModel->createCategory($data['category']);
            
            header('Content-Type: application/json');
            if ($result) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Category created successfully'
                ]);
            } else {
                http_response_code(500);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to create category'
                ]);
            }
        } catch (\Exception $e) {
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to create category'
            ]);
        }
    }
}