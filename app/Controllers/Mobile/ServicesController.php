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
            
            $formattedServices = array_map(function($service) {
                $slideShowPhotos = isset($service['slide_show_photos']) 
                    ? json_decode($service['slide_show_photos'], true) 
                    : [];
                if (!is_array($slideShowPhotos)) {
                    $slideShowPhotos = !empty($service['slide_show_photos']) 
                        ? array_filter(explode(',', $service['slide_show_photos'])) 
                        : [];
                }

                return [
                    'id' => $service['id'],
                    'name' => $service['serviceName'],
                    'caption' => $service['caption'] ?? 'No caption available',
                    'description' => $service['description'],
                    'price' => (float)str_replace('₱', '', $service['price']),
                    'rating' => 0,
                    'main_photo' => $service['main_photo'] ?? '',
                    'slide_show_photos' => $slideShowPhotos,
                    'showcase_photo1' => $service['showcase_photo1'] ?? '',
                    'showcase_photo2' => $service['showcase_photo2'] ?? '',
                    'showcase_photo3' => $service['showcase_photo3'] ?? '',
                    // 'duration_details' => $service['duration_details'] ?? '',
                    // 'party_size_details' => $service['party_size_details'] ?? '',
                    // 'massage_details' => $service['massage_details'] ?? '',
                    // 'body_scrub_details' => $service['body_scrub_details'] ?? '',
                    // 'add_ons_details' => $service['add_ons_details'] ?? ''
                ];
            }, $services);
            
            // Add logging to print the API response
            error_log("ServicesController: API Response: " . json_encode($formattedServices, JSON_PRETTY_PRINT));
            
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
    
    public function getServicesByCategory($category)
    {
        try {
            // Map endpoint categories to display categories
            $categoryMap = [
                'bodyscrub' => 'Body Scrubs',
                'massage' => 'Massages'
            ];
            
            // Use mapped category if available, otherwise use the original
            $displayCategory = $categoryMap[$category] ?? $category;
            $services = $this->servicesModel->getServicesByCategory($displayCategory);
            
            $formattedServices = array_map(function($service) {
                $slideShowPhotos = isset($service['slide_show_photos']) 
                    ? json_decode($service['slide_show_photos'], true) 
                    : [];
                if (!is_array($slideShowPhotos)) {
                    $slideShowPhotos = !empty($service['slide_show_photos']) 
                        ? array_filter(explode(',', $service['slide_show_photos'])) 
                        : [];
                }

                return [
                    'id' => $service['id'],
                    'name' => $service['serviceName'],
                    'caption' => $service['caption'] ?? 'No caption available',
                    'description' => $service['description'],
                    'price' => (float)str_replace('₱', '', $service['price']),
                    'rating' => 0,
                    'main_photo' => $service['main_photo'] ?? '',
                    'slide_show_photos' => $slideShowPhotos,
                    'showcase_photo1' => $service['showcase_photo1'] ?? '',
                    'showcase_photo2' => $service['showcase_photo2'] ?? '',
                    'showcase_photo3' => $service['showcase_photo3'] ?? '',
                ];
            }, $services);
            
            // Add logging to print the API response
            error_log("ServicesController: Category {$category} API Response: " . json_encode($formattedServices, JSON_PRETTY_PRINT));
            
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
                'message' => "Failed to fetch services for category: {$category}"
            ]);
        }
    }
    
    public function getMassageServices()
    {
        $this->getServicesByCategory('massage');
    }
    
    public function getBodyScrubServices()
    {
        $this->getServicesByCategory('bodyscrub');
    }
    
    public function getPackageServices()
    {
        $this->getServicesByCategory('packages');
    }
}