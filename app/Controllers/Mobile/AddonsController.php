<?php
namespace Project\App\Controllers\Mobile;

use Project\App\Models\Utilities\AddOnsModel;

class AddOnsController
{
    private $addOnsModel;

    public function __construct()
    {
        $this->addOnsModel = new AddOnsModel();
    }

    private function formatAddOnData($addOn)
    {
        return [
            'id' => $addOn['id'],
            'name' => $addOn['name'],
            'price' => (float)$addOn['price'],
            'status' => $addOn['status'],
            'is_archived' => isset($addOn['is_archived']) ? (bool)$addOn['is_archived'] : ($addOn['status'] === 'Archived')
        ];
    }

    public function index()
    {
        try {
            $addOns = $this->addOnsModel->getAll();
            
            $formattedAddOns = array_map(function($addOn) {
                return $this->formatAddOnData($addOn);
            }, $addOns);
            
            error_log("AddOnsController: API Response: " . json_encode($formattedAddOns, JSON_PRETTY_PRINT));
            
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'success',
                'data' => $formattedAddOns
            ]);
        } catch (\Exception $e) {
            // Enhanced error handling
            error_log('Mobile add-ons error (index): ' . $e->getMessage());
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

    public function getActiveAddOns()
    {
        try {
            $allAddOns = $this->addOnsModel->getAll();
            $activeAddOns = array_filter($allAddOns, function ($addOn) {
                return $addOn['status'] === 'Active';
            });
            
            $formattedAddOns = array_map(function($addOn) {
                return $this->formatAddOnData($addOn);
            }, array_values($activeAddOns));
            
            error_log("AddOnsController: Active Add-Ons API Response: " . json_encode($formattedAddOns, JSON_PRETTY_PRINT));
            
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'success',
                'data' => $formattedAddOns
            ]);
        } catch (\Exception $e) {
            // Enhanced error handling
            error_log('Mobile add-ons error (getActiveAddOns): ' . $e->getMessage());
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

    public function getAddOnById($id)
    {
        try {
            $addOn = $this->addOnsModel->find($id);
            
            if (!$addOn) {
                header('Content-Type: application/json');
                http_response_code(404);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Add-on not found'
                ]);
                return;
            }
            
            $formattedAddOn = $this->formatAddOnData($addOn);
            
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'success',
                'data' => $formattedAddOn
            ]);
        } catch (\Exception $e) {
            error_log('Mobile add-ons error (getAddOnById): ' . $e->getMessage());
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
}