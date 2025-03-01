<?php
namespace Project\App\Controllers\Web\UseCases;
use CURLFile;
use Project\App\Config\Connection;

class FileUploadUseCaseController
{
    
    /**
     * @inheritDoc
     */
    private $controller;
    public function __construct(){
        $this->controller = Connection::connection();
    }
    public function imageUpload($filePath)
    {
        $url = 'https://freeimage.host/api/1/upload';
        $apiKey = '6d207e02198a847aa98d0a2a901485a5';

        if (!$apiKey) {
            return ['error' => 'API key is missing'];
        }

        $file = new CURLFile($filePath);
        $data = [
            'key' => $apiKey,
            'source' => $file
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200) {
            return ['error' => 'Failed to upload image', 'http_code' => $httpCode];
        }

        return json_decode($response, true);
    }

    public function setter($filePath){
        return $this->imageUpload($filePath);
    }

}