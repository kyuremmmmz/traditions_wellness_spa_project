<?php
namespace Project\App\Controllers\Mobile;

use Project\App\Models\Services\ServicesModel;

class ServicesController
{
    private $servicesModel;

    private function parseSelection($value)
    {
        if (empty($value)) return [];
        if (is_array($value)) return array_filter($value);
        
        // Try JSON decode first
        $decoded = json_decode($value, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return array_filter($decoded); // Remove empty values
        }
        
        // If not JSON, split by comma and trim
        // Handle both comma with and without space after it
        $items = array_map('trim', preg_split('/\s*,\s*/', $value));
        return array_filter($items); // Remove empty values
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
            'price' => (float)str_replace('₱', '', $service['price']),
            'rating' => 0,
            'status' => $service['status'] ?? '',
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
            'massage_selection' => $this->parseSelection($service['massage_selection'] ?? ''),
            'body_scrub_selection' => $this->parseSelection($service['body_scrub_selection'] ?? ''),
            'supplemental_add_ons' => $this->parseSelection($service['supplementtal_add_ons'] ?? '')
        ];

        // Adjust selections based on category
        switch ($normalizedCategory) {
            case 'massage':
                $formattedService['massage_selection'] = []; // No selection for massage
                $formattedService['body_scrub_selection'] = [];
                break;
            case 'bodyscrub':
                $formattedService['massage_selection'] = []; // No massage selection
                break;
            case 'packages':
                $formattedService['add_ons_details'] = ''; // No add-ons for packages
                $formattedService['supplemental_add_ons'] = [];
                break;
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
            // Error handling...
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
            // Error handling...
        }
    }
    
    public function getMassageServices() { $this->getServicesByCategory('massage'); }
    public function getBodyScrubServices() { $this->getServicesByCategory('bodyscrub'); }
    public function getPackageServices() { $this->getServicesByCategory('packages'); }
}