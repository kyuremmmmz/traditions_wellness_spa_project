<?php

namespace Project\App\Controllers\Web\UseCases;

use Exception;
use Project\App\Models\Services\ServicesModel;
use Project\App\Views\Php\Components\Banners\RegularBanner;
use Project\App\Models\Utilities\AddOnsModel;

class ServicesController
{
    private $model;
    private $uploadPhoto;
    private $reusables;

    public function __construct()
    {
        $this->model = new ServicesModel();
        $this->uploadPhoto = new FileUploadUseCaseController();
        $this->reusables = new ReusablesController();
    }

    public function fetchCurrentServiceCategory()
    {
        ob_start();
        header('Content-Type: application/json');
        echo json_encode(['debug' => 'Method called successfully']);
        exit;
    }

    public function createCategory()
    {
        $data = $_POST;
        if (isset($data['categoryNameField']) && !empty($data['categoryNameField'])) {
            $this->model->createCategory($data['categoryNameField']);
        }
        header('Location: /services');
        exit;
    }

    public function createService()
    {
        session_start();
        $data = $_POST;
        $logFile = __DIR__ . '/debug.txt'; // Path to the debug log file

        // Log input data
        file_put_contents($logFile, "Received POST data:\n" . print_r($data, true) . "\n", FILE_APPEND);
        file_put_contents($logFile, "Received FILES data:\n" . print_r($_FILES, true) . "\n", FILE_APPEND);

        if (!isset($data['category']) || empty($data['category'])) {
            file_put_contents($logFile, "Error: Category is missing\n", FILE_APPEND);
            header('Location: /services');
            exit;
        }

        try {

            $uploadMainPhoto = $this->handleFileUpload('main_photo');
            $uploadShowcasePhoto1 = $this->handleFileUpload('showcase_photo_1');
            $uploadShowcasePhoto2 = $this->handleFileUpload('showcase_photo_2');
            $uploadShowcasePhoto3 = $this->handleFileUpload('showcase_photo_3');
            $uploadMultiples = $this->handleMultipleFileUpload('slideshow_photos');

            // Collect parameters for the query
            $params = [
                'category' => $data['category'],
                'service_name' => $data['service_name'],
                'fixed_price' => $data['fixed_price'],
                'service_caption' => $data['service_caption'],
                'service_description' => $data['service_description'],
                'status' => $data['service_status'],
                'party_size_details' => $data['party_size_details'] ?? '',
                'massage_details' => $data['massage_details'] ?? '',
                'body_scrub_details' => $data['body_scrub_details'] ?? '',
                'addon_details' => $data['addon_details'] ?? '',
                'main_photo' => $uploadMainPhoto['image']['url'],
                'slideshow_photos' => implode(',', $uploadMultiples),
                'showcase_photo_1' => $uploadShowcasePhoto1['image']['url'],
                'showcase_headline_1' => $data['showcase_headline_1'],
                'showcase_caption_1' => $data['showcase_caption_1'],
                'showcase_photo_2' => $uploadShowcasePhoto2['image']['url'],
                'showcase_headline_2' => $data['showcase_headline_2'],
                'showcase_caption_2' => $data['showcase_caption_2'],
                'showcase_photo_3' => $uploadShowcasePhoto3['image']['url'],
                'showcase_headline_3' => $data['showcase_headline_3'],
                'showcase_caption_3' => $data['showcase_caption_3'],
                'massage_selection' => $this->reusables->massageSelection($data),
                'body_scrub_selection' => $this->reusables->bodyScrubSelection($data),
                'supplemental_addons' => $this->reusables->suplementTalAddOns($data),
                'party_size' => $data['party_size'],
                'one_hour_price' => !empty($data['one_hour_price']) ? (int)$data['one_hour_price'] : null,
                'one_hour_thirty_price' => !empty($data['one_hour_thirty_price']) ? (int)$data['one_hour_thirty_price'] : null,
                'two_hour_price' => !empty($data['two_hour_price']) ? (int)$data['two_hour_price'] : null,
                'duration_details' => $data['duration_details'] ?? '',
                'rating' => $data['rating'],
                'duration' => $data['duration'] ?? null
            ];

            // Log SQL parameters
            file_put_contents($logFile, "SQL Parameters:\n" . print_r($params, true) . "\n", FILE_APPEND);

            // Call model function with these parameters
            $this->model->createServices($params);

            $_SESSION['services_message'] = 'Service created successfully';
            header('Location: /services');
            exit;
        } catch (Exception $e) {
            file_put_contents($logFile, "Exception: " . $e->getMessage() . "\n", FILE_APPEND);
            header('Location: /services?error=creation_failed');
            exit;
        }
    }


    private function handleFileUpload($fieldName)
    {
        if (isset($_FILES[$fieldName]) && $_FILES[$fieldName]['error'] === UPLOAD_ERR_OK) {
            return $this->uploadPhoto->imageUpload($_FILES[$fieldName]['tmp_name']);
        }
        return ['image' => ['url' => '']];
    }

    public function handleMultipleFileUpload($inputName)
    {
        $files = null;
        if (isset($_FILES['slideshow_slideshow_photos']) && is_array($_FILES['slideshow_slideshow_photos']['name'])) {
            $files = $_FILES['slideshow_slideshow_photos'];
        } elseif (isset($_FILES[$inputName]) && is_array($_FILES[$inputName]['name'])) {
            $files = $_FILES[$inputName];
        }
        
        if (!$files) {
            return [];
        }

        $filePaths = [];
        $validFiles = false;

        for ($i = 0; $i < count($files['name']); $i++) {
            if ($files['error'][$i] === UPLOAD_ERR_OK && is_uploaded_file($files['tmp_name'][$i])) {
                $filePaths[] = $files['tmp_name'][$i];
                $validFiles = true;
            }
        }

        if (!$validFiles) {
            return [];
        }

        $uploadResults = $this->uploadPhoto->multipleImageUpload($filePaths);
        return array_filter($uploadResults, function($result) {
            return strpos($result, 'FAILED:') !== 0;
        });
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

    public function findCategory($category)
    {
        ob_start();
        header('Content-Type: application/json');
            $data2 = $this->model->findByCategory($category);
            ob_end_clean();
            echo json_encode($data2);
        exit;
    }

    public function findArchivedServices()
    {
        ob_start();
        header('Content-Type: application/json');
        $data2 = $this->model->findByArchive();
        echo json_encode($data2);
        exit;
    }



    public function edit()
    {
        $data = $_POST;
        if (isset($data['radioGroup'])) {
            $this->model->update(
                $data['radio'],
                json_encode($data['descriptions'] ?? []),
                $data['price'] ?? '',
                $data['serviceName'] ?? ''
            );
            header('Location: /services');
            exit;
        }
    }

    public function update($id)
    {
        echo "This is the update method of ServicesController for ID: $id.";
    }

    public function delete($id)
    {
        echo "This is the delete method of ServicesController for ID: $id.";
    }
    public function findActiveMassages()
    {
        header('Content-Type: application/json');
        try {
            $activeMassages = $this->model->findByCategoryAndActive('Massages');
            echo json_encode($activeMassages); 

        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([]);
        }
        exit;
    }

    public function findActiveBodyScrubs()
    {
        header('Content-Type: application/json');
        try {
            $activeBodyScrubs = $this->model->findByCategoryAndActive('Body Scrubs');
            echo json_encode($activeBodyScrubs); 
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([]);
        }
        exit;
    }

    public function findActivePackages()
    {
        header('Content-Type: application/json');
        try {
            $activePackages = $this->model->findByCategoryAndActive('Packages');
            echo json_encode($activePackages);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([]);
        }
        exit;
    }
    public function findAllActiveServices()
    {
        header('Content-Type: application/json');
        try {
            $allActiveServices = $this->model->findAllActiveServices();
            echo json_encode($allActiveServices);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([]);
        }
        exit;
    }
}
