<?php

namespace Project\App\Controllers\Web\UseCases;

use Exception;
use Project\App\Models\Services\ServicesModel;
use Project\App\Views\Php\Components\Banners\RegularBanner;

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

        if (!isset($data['category']) || empty($data['category'])) {
            header('Location: /services');
            exit;
        }

        $price = isset($data['fixed_price']) && !empty($data['fixed_price'])
            ? (int)$data['fixed_price']
            : (int)($data['1_hour_price']) + (int)($data['1_hour_30_price']) + (int)($data['2_hours_price']);
        $uploadMainPhoto = $this->handleFileUpload('main_photo');
        $uploadShowcasePhoto1 = $this->handleFileUpload('showcase_photo_1');
        $uploadShowcasePhoto2 = $this->handleFileUpload('showcase_photo_2');
        $uploadShowcasePhoto3 = $this->handleFileUpload('showcase_photo_3');
        $uploadMultiples = $this->handleMultipleFileUpload('slideshow_photos');
        $this->model->createServices(
            $data['category'],
            $data['service_name'],
            $price,
            $data['service_caption'],
            $data['service_description'],
            $data['status'],
            $data['duration_details'],
            $data['party_size_details'],
            $data['massage_details'],
            $data['body_scrub_details'],
            $data['addon_details'],
            $uploadMainPhoto['image']['url'],
            implode(',', $uploadMultiples),
            $uploadShowcasePhoto1['image']['url'],
            $data['showcase_headline_1'],
            $data['showcase_caption_1'],
            $uploadShowcasePhoto2['image']['url'],
            $data['showcase_headline_2'],
            $data['showcase_caption_2'],
            $uploadShowcasePhoto3['image']['url'],
            $data['showcase_headline_3'],
            $data['showcase_caption_3'],
            $this->reusables->massageSelection($data),
            $this->reusables->bodyScrubSelection($data),
            $this->reusables->suplementTalAddOns($data),
        );
        $_SESSION['services_message'] = 'Service created successfully';
        header('Location: /services');
        exit;
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
        if (!isset($_FILES[$inputName]) || !is_array($_FILES[$inputName]['name'])) {
            return ['error' => 'No files uploaded'];
        }

        $filePaths = [];
        $files = $_FILES[$inputName];

        for ($i = 0; $i < count($files['name']); $i++) {
            if ($files['error'][$i] === UPLOAD_ERR_OK) {
                $filePaths[] = $files['tmp_name'][$i];
            } else {
                $filePaths[] = "Upload error: " . $files['error'][$i];
            }
        }

        return $this->uploadPhoto->multipleImageUpload($filePaths);
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
        error_log("Category received: " . print_r($category, true));
        ob_start();
        header('Content-Type: application/json');
        try {
            $data2 = $this->model->findByCategory($category);
            ob_end_clean();
            echo json_encode($data2);
        } catch (Exception $e) {
            ob_end_clean();
            http_response_code(500);
            echo json_encode(['error' => 'Server error occurred: ' . $e->getMessage()]);
        }
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
}
