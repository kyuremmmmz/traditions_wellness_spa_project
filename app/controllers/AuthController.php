<?php
header('Content-Type: application-json');
use Project\App\Models\AuthModelModel;

class AuthController
{
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

    public function store($username, $password)
    {
        $response = new AuthModelModel();
        $authHandler = $response->find($username);
        if (!$authHandler) {
            echo json_encode([
                'message' => 'Invalid username or password'
            ]);
            return;
        }

        $verifyPassword = password_verify($password, $authHandler['password']);
        if ($verifyPassword) {
            session_start();
            echo json_encode([
                'payload' => $authHandler
            ]);
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