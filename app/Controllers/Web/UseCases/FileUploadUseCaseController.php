<?php

namespace Project\App\Controllers\Web\UseCases;

use CURLFile;
use Project\App\Config\Connection;

class FileUploadUseCaseController
{
    private $controller;
    private $clientId;
    private $clientSecret;
    private $sirvAccount; // Added property declaration
    private $token;
    private $tokenExpiration;
    private $sirvBaseUrl = 'https://api.sirv.com/v2';

    public function __construct()
    {
        $this->controller = Connection::connection();
        
        // Hardcode your Sirv credentials here instead of using environment variables
        $this->clientId = 'YVZbXwG9aYqTqGXtojt8Kl9TxpN';
        $this->clientSecret = 'LcNQjtCXjDNwjSzkqYjTiCvA6LgHnT6yjCRzd61yPZIEgi4A2pJP1HHP6WjIIEX8vpLqdqYDdbfv2UHMsk4bIQ==';
        $this->sirvAccount = 'penpenniepennie';
    }

    /**
     * Get authentication token from Sirv API
     * 
     * @return string|null Token or null on failure
     */
    private function getToken()
    {
        // Check if we have a valid token already
        if ($this->token && $this->tokenExpiration > time()) {
            return $this->token;
        }

        // Request new token
        $url = 'https://api.sirv.com/v2/token';
        $data = [
            'clientId' => $this->clientId,
            'clientSecret' => $this->clientSecret
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200) {
            error_log("Failed to obtain Sirv token: $response");
            return null;
        }

        $result = json_decode($response, true);
        if (!isset($result['token']) || !isset($result['expiresIn'])) {
            error_log("Invalid token response from Sirv");
            return null;
        }

        // Store token and expiration time
        $this->token = $result['token'];
        $this->tokenExpiration = time() + $result['expiresIn'] - 60; // Subtract 60 seconds as buffer

        return $this->token;
    }

    /**
     * Upload a single image to Sirv
     * 
     * @param string $filePath Local path to the file
     * @param string $sirvPath Optional path in Sirv account (default: /images/filename)
     * @return array Result with URL or error message
     */
    public function imageUpload($filePath, $sirvPath = null)
    {
        if (empty($filePath) || !file_exists($filePath)) {
            return ['image' => ['url' => '']];
        }

        $token = $this->getToken();
        if (!$token) {
            return ['error' => 'Failed to authenticate with Sirv'];
        }

        // If path not specified, create one based on filename
        if (!$sirvPath) {
            $filename = basename($filePath);
            $sirvPath = '/images/' . $filename;
        }

        // Prepare upload URL (needs to be URL encoded)
        $uploadUrl = $this->sirvBaseUrl . '/files/upload?filename=' . urlencode($sirvPath);

        // Get file contents
        $fileContent = file_get_contents($filePath);
        if ($fileContent === false) {
            return ['error' => 'Failed to read file contents'];
        }

        // Upload file
        $ch = curl_init($uploadUrl);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fileContent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/octet-stream',
            'Authorization: Bearer ' . $token
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200) {
            return ['error' => 'Failed to upload image to Sirv', 'http_code' => $httpCode, 'response' => $response];
        }

        // Construct the public URL using the class property instead of getenv
        $publicUrl = "https://{$this->sirvAccount}.sirv.com" . $sirvPath;

        return [
            'image' => [
                'url' => $publicUrl,
                'sirv_path' => $sirvPath
            ],
            'success' => true
        ];
    }

    public function setter($filePath)
    {
        return $this->imageUpload($filePath);
    }

    /**
     * Upload multiple images to Sirv
     * 
     * @param array $filePaths Array of file paths to upload
     * @return array Results for each file
     */
    public function multipleImageUpload($filePaths)
    {
        $results = [];

        if (empty($filePaths) || !is_array($filePaths)) {
            return ['error' => 'No valid file paths provided'];
        }

        $token = $this->getToken();
        if (!$token) {
            return ['error' => 'Failed to authenticate with Sirv'];
        }

        foreach ($filePaths as $index => $filePath) {
            if (empty($filePath)) {
                $results[$index] = 'FAILED: Empty file path';
                continue;
            }

            if (!is_uploaded_file($filePath)) {
                $results[$index] = 'FAILED: Invalid upload';
                continue;
            }

            if (!file_exists($filePath)) {
                $results[$index] = 'FAILED: File not found';
                continue;
            }

            // Upload single file
            $uploadResult = $this->imageUpload($filePath);
            
            // Store result
            $results[$index] = isset($uploadResult['image']['url']) ? 
                $uploadResult['image']['url'] : 
                'FAILED: ' . ($uploadResult['error'] ?? 'Unknown error');
        }

        return $results;
    }
    
    /**
     * Delete a file from Sirv
     * 
     * @param string $sirvPath Path to the file in Sirv
     * @return bool Success status
     */
    public function deleteFile($sirvPath)
    {
        $token = $this->getToken();
        if (!$token) {
            return false;
        }
        
        $deleteUrl = $this->sirvBaseUrl . '/files/delete?filename=' . urlencode($sirvPath);
        
        $ch = curl_init($deleteUrl);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token
        ]);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        return $httpCode === 200;
    }
}