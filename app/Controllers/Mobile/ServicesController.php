<?php
namespace Project\App\Controllers\Mobile;

use Project\App\Models\Services\ServicesModel;

class ServicesController
{
    private $servicesModel;


    private function parseSelection($value)
    {
        if (empty($value)) return [];
        
        // If already an array, filter and return
        if (is_array($value)) {
            return array_values(array_filter($value));
        }
        
        // Try JSON decode first
        $decoded = json_decode($value, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            // If decoded to array, filter and return
            if (is_array($decoded)) {
                return array_values(array_filter($decoded));
            }
            // If decoded to string, process as string
            $value = $decoded;
        }
        
        // Process as string - split by comma and clean up
        if (is_string($value)) {
            $items = array_map('trim', preg_split('/\s*,\s*/', $value));
            return array_values(array_filter($items, function($item) {
                return $item !== '' && $item !== null;
            }));
        }
        
        return [];
    }

    public function __construct()
    {
        $this->servicesModel = new ServicesModel();
    }

    private function formatServiceData($service, $category = null)
    {
        $slideShowPhotos = isset($service['slide_show_photos']) 
            ? json_decode($service['slide_show_photos'], true) 
            : [];
        if (!is_array($slideShowPhotos)) {
            $slideShowPhotos = !empty($service['slide_show_photos']) 
                ? array_filter(explode(',', $service['slide_show_photos'])) 
                : [];
        }

        // Normalize category from database or parameter
        $serviceCategory = $category ?? $service['category'] ?? '';
        $normalizedCategory = match (strtolower($serviceCategory)) {
            'massages' => 'massage',
            'body scrubs' => 'bodyscrub',
            'packages' => 'packages',
            default => strtolower($serviceCategory)
        };

        $formattedService = [
            'id' => $service['id'],
            'name' => $service['serviceName'],
            'category' => $normalizedCategory,
            'caption' => $service['caption'] ?? 'No caption available',
            'description' => $service['description'],
            'price' => (float)str_replace('₱', '', $service['fixed_price'] ?? $service['price'] ?? 0),
            'rating' => (float)($service['rating'] ?? 0),
            'status' => $service['status'] ?? '',
            'duration' => (int)($service['duration'] ?? 0),
            'duration_details' => $service['duration_details'] ?? '',
            'party_size_details' => $service['party_size_details'] ?? '',
            'headline1' => $service['headline1'] ?? '',
            'caption1' => $service['caption1'] ?? '',
            'headline2' => $service['headline2'] ?? '',
            'caption2' => $service['caption2'] ?? '',
            'headline3' => $service['headline3'] ?? '',
            'caption3' => $service['caption3'] ?? '',
            'main_photo' => !empty($service['main_photo']) ? $service['main_photo'] : '',
            'slide_show_photos' => array_map(function($photo) { return !empty($photo) ? $photo : ''; }, $slideShowPhotos),
            'showcase_photo1' => !empty($service['showcase_photo1']) ? $service['showcase_photo1'] : '',
            'showcase_photo2' => !empty($service['showcase_photo2']) ? $service['showcase_photo2'] : '',
            'showcase_photo3' => !empty($service['showcase_photo3']) ? $service['showcase_photo3'] : '',
            'massage_details' => $service['massage_details'] ?? '',
            'body_scrub_details' => $service['body_scrub_details'] ?? '',
            'add_ons_details' => $service['add_ons_details'] ?? '',
            'massage_selection' => $this->parseSelection($service['massage_selection'] ?? []),
            'body_scrub_selection' => $this->parseSelection($service['body_scrub_selection'] ?? []),
            'supplemental_add_ons' => $this->parseSelection($service['supplemental_add_ons'] ?? []),
            'party_size' => $this->parseSelection($service['party_size'] ?? []),
        ];

        // Add pricing fields only if they exist
        if (isset($service['one_hour_price'])) {
            $formattedService['one_hour_price'] = (float)$service['one_hour_price'];
        }
        if (isset($service['one_hour_thirty_price'])) {
            $formattedService['one_hour_thirty_price'] = (float)$service['one_hour_thirty_price'];
        }
        if (isset($service['two_hour_price'])) {
            $formattedService['two_hour_price'] = (float)$service['two_hour_price'];
        }

        return $formattedService;
    }

    public function index()
{
    try {
        $services = $this->servicesModel->getAllServiceName();
        
        $formattedServices = array_map(function($service) {
            return $this->formatServiceData($service);
        }, $services);
        
        error_log("ServicesController: API Response: " . json_encode($formattedServices, JSON_PRETTY_PRINT));
        
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'success',
            'data' => $formattedServices
        ]);
    } catch (\Exception $e) {
        // Enhanced error handling
        error_log('Mobile services error (index): ' . $e->getMessage());
        error_log('Stack trace: ' . $e->getTraceAsString());
        
        header('Content-Type: application/json');
        http_response_code(500);
        echo json_encode([
            'status' => 'error',
            'message' => 'Internal server error',
            'debug' => $e->getMessage() // Remove this in production
        ]);
    }
}

public function getServicesByCategory($category)
{
    try {
        $categoryMap = [
            'bodyscrub' => 'Body Scrubs',
            'massage' => 'Massages',
            'packages' => 'Packages'
        ];
        
        $displayCategory = $categoryMap[$category] ?? $category;
        $services = $this->servicesModel->getServicesByCategory($displayCategory);
        
        $formattedServices = array_map(function($service) use ($category) {
            return $this->formatServiceData($service, $category);
        }, $services);
        
        error_log("ServicesController: Category {$category} API Response: " . json_encode($formattedServices, JSON_PRETTY_PRINT));
        
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'success',
            'data' => $formattedServices
        ]);
    } catch (\Exception $e) {
        // Enhanced error handling
        error_log('Mobile services error (getServicesByCategory): ' . $e->getMessage());
        error_log('Stack trace: ' . $e->getTraceAsString());
        
        header('Content-Type: application/json');
        http_response_code(500);
        echo json_encode([
            'status' => 'error',
            'message' => 'Internal server error',
            'debug' => $e->getMessage() // Remove this in production
        ]);
    }
    
}

    public function getServiceAddons($serviceId)
    {
        try {
            // Make sure to clear any previous output
            ob_clean();
            
            // Use the existing AddOnsModel to get active add-ons
            $addOnsModel = new \Project\App\Models\Utilities\AddOnsModel();
            $allAddons = $addOnsModel->getAll();
            
            // Filter for only active add-ons
            $activeAddons = array_filter($allAddons, function ($addon) {
                return $addon['status'] === 'Active';
            });
            
            // Format add-ons for the API response
            $formattedAddons = array_map(function($addon) {
                return [
                    'id' => intval($addon['id']),
                    'name' => $addon['name'],
                    'price' => (float)$addon['price'],
                    'description' => isset($addon['description']) ? $addon['description'] : null
                ];
            }, array_values($activeAddons));
            
            error_log("ServicesController: Service add-ons for service ID {$serviceId}: " . 
                    json_encode($formattedAddons, JSON_PRETTY_PRINT));
            
            // Make sure headers are set properly
            header('Content-Type: application/json');
            
            // Echo valid JSON
            echo json_encode([
                'status' => 'success',
                'data' => $formattedAddons
            ]);
            exit;
        } catch (\Exception $e) {
            error_log('Mobile service addons error: ' . $e->getMessage());
            error_log('Stack trace: ' . $e->getTraceAsString());
            
            // Clean any existing output
            ob_clean();
            
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode([
                'status' => 'error',
                'message' => 'Internal server error',
                'debug' => $e->getMessage()
            ]);
            exit;
        }
    }
    
    public function getMassageServices() { $this->getServicesByCategory('massage'); }
    public function getBodyScrubServices() { $this->getServicesByCategory('bodyscrub'); }
    public function getPackageServices() { $this->getServicesByCategory('packages'); }
}