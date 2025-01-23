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

    public function store($request)
    {
        $data = json_decode(file_get_contents('php://input'), true);
        
        $response = $this->controller->find($data['username']);
        if (is_array($response)) {
            if (password_verify($data['password'], $response['password'])) {
                echo json_encode(['data' => base64_encode(json_encode($response))]);
            }else{
                echo json_encode(['data' => 'Login Failed']);
            }
        } else {
            echo json_encode(['data' => 'no data']);
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
