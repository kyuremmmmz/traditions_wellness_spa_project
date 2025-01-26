<?php

namespace Project\App\Controllers;

use Project\App\Mail\Mailer;
use Project\App\Models\AuthModel;
use function Symfony\Component\Clock\now;




class AuthController
{
    private $controller;
    private $mailer;
    public function __construct()
    {
        $this->controller = new AuthModel();
        $this->mailer = new Mailer();
    }

    public function forgotPassword()
    {
        // Code for listing resources
        echo "This is the index method of AuthController.";
    }

    public function register()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $emailPattern = '/^[\w.%+-]+@[\w.-]+\.[a-zA-Z]{2,}$/';
        if (!preg_match($emailPattern, $data['email'])) {
            echo json_encode([
                'error' => 'Invalid email format'
            ]);
            http_response_code(400);
            return;
        }
        $passwordPattern = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/';
        if (!preg_match($passwordPattern, $data['password'])) {
            echo json_encode([
                'error' => 'Password must be at least 8 characters long and include an uppercase letter, a lowercase letter, a number, and a special character'
            ]);
            http_response_code(400);
            return;
        }

        $temporaryData = $this->generateTemporaryUserNameAndPassword($data['first_name'], $data['last_name']);
        $response = $this->controller->create(
            $data['last_name'],
            $data['first_name'],
            $data['email'],
            $temporaryData['password'],
            $data['phone'],
            $data['branch'],
            date('Y-m-d H:i:s'),
            $data['role'],
            $temporaryData['username'],
        );

        $this->mailer->sendVerification(
            $data['email'],
            'Good day! ' . $data['first_name'] . ', This is your temporary username and password below',
            'Username: ' . $temporaryData['username'],
            'Password: ' . $temporaryData['password'],
            $data['first_name'],
        );

        echo json_encode([
            'data' => $response
        ]);
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
                if (is_null($response['email_verified_at'])) {
                    $this->controller->update(
                        $response['email'],
                        $response['email_verified_at'] = date('Y-m-d H:i:s')
                    );
                }
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

    private function generateTemporaryUserNameAndPassword($firstName, $lastName)
    {
        $baseUserName  = strtolower(Str($firstName . '.' . $lastName));
        $randomNum = rand(1000, 9999);
        $temporaryPassword = 'Temp' . $randomNum;
        return [
            'username' => $baseUserName . $randomNum,
            'password' => $temporaryPassword,
        ];
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
