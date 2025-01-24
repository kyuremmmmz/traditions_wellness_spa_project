<?php

namespace Project\App\Controllers;

use Project\App\Models\AuthModel;

class AuthController
{
    private $controller;

    public function __construct()
    {
        $this->controller = new AuthModel();
    }

    public function index()
    {
        // Code for listing resources
        echo "This is the index method of AuthController.";
    }

    public function create()
    {
        // Code for showing a create form
        echo "This is the create method of AuthController.";
    }

    public function store()
    {
        $data = json_decode(filter_var(file_get_contents('php://input')), true);
        
        $response = $this->controller->find($data['username']);
        if (is_array($response)) {
            if (password_verify($data['password'], $response['password'])) {
                $_SESSION['user'] = [
                    'role' => $response['role'],
                    'username' => $response['username'],
                    'last_name' => $response['last_name'],
                    'first_name' => $response['first_name'],
                    'email' => $response['email']
                ];
                echo json_encode($_SERVER['HTTP_AUTHORIZATION']);
                $payload =  [
                    'role' => $response['role'],
                    'username' => $response['username'],
                    'last_name' => $response['last_name'],
                    'first_name' => $response['first_name'],
                    'email' => $response['email']
                ];
                echo json_encode([
                    'data' => $payload,
                    'token' => base64_encode(json_encode($payload)),
                ]);
            }else{
                http_response_code(401);
                echo json_encode(['Error' => 'Invalid credentials']);
            }
        } else {
            http_response_code(404);
            echo json_encode(['Error' => 'User not found']);
        }
    }




    public function edit($id)
    {
        // Code for showing an edit form
        echo "This is the edit method of AuthController for ID: $id.";
    }

    public function update($id)
    {
        // Code for updating resources
        echo "This is the update method of AuthController for ID: $id.";
    }

    public function delete($id)
    {
        // Code for deleting resources
        echo "This is the delete method of AuthController for ID: $id.";
    }
}
