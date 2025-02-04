<?php
namespace Project\App\Controllers;

use Project\App\Mail\Mailer;
use Project\App\Models\AuthModel;
use Project\App\Models\PhotoUpdloadModel;
use Project\App\Models\RolesModel;
use Project\App\Models\UserRolesModel;

class RegistrationController
{
    private $controller;
    private $userRolesModel;
    private $mailer;
    private $photos;
    private $roleModel;
    public function __construct()
    {
        $this->controller = new AuthModel();
        $this->mailer = new Mailer();
        $this->userRolesModel = new UserRolesModel();
        $this->photos = new PhotoUpdloadModel();
        $this->roleModel = new RolesModel();
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
    public function register()
    {
        try {
            $data = $_POST;
            $temporaryData = $this->generateTemporaryUserNameAndPassword($data['first_name'], $data['last_name']);
            $emailPattern = '/^[\w.%+-]+@[\w.-]+\.[a-zA-Z]{2,}$/';
            if (!preg_match($emailPattern, $data['email'])) {
                echo json_encode([
                    'error' => 'Invalid email format'
                ]);
                http_response_code(400);
                return;
            }
            $findByEmail = $this->controller->findByEmail($data['email']);
            if ($findByEmail && isset($findByEmail['email'])) {
                if ($findByEmail['phone'] === $data['phone']) {
                    echo json_encode([
                        'Message' => 'An account with this phone number already exists.'
                    ]);
                }
                if ($findByEmail['email'] === $data['email']) {
                    echo json_encode([
                        'Message' => 'An account with this email already exists.'
                    ]);
                }
            }
            $photo = file_get_contents($_FILES['photos']['tmp_name']);
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
                'data:image/jpeg;base64,' . base64_encode($photo),
            );
            $findId = $this->controller->findByEmail($data['email']);
            $roleIDs = [
                'super_admin' => 1,
                'branch_admin' => 2,
                'assistant_admin' => 3,
                'therapist' => 4,
                'staff' => 5,
                'customer' => 6,
            ];
            // this variable will remove the _ inside the array of strings
            $roleName = strtolower(str_replace(' ', '_', $findId['role']));
            $search = $roleIDs[$roleName] ?? null;
            if (!$search) {
                http_response_code(400);
                echo json_encode([
                    'success' => false,
                    'message' => 'Invalid role provided.',
                ]);
            }
            $rolePermissions = [
                1 => 'all',
                2 => 'inventory_management_system,appointment_system,book_a_service',
                3 => 'inventory_management_system,appointment_system',
                4 => 'book_a_service',
                5 => 'inventory_management_system',
                6 => 'book_a_service',
            ];
            $searchPermissions = $rolePermissions[$search] ?? null;

            $createRole = $this->roleModel->createRoles($findId['id'], $findId['role'], $searchPermissions);
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
        } catch (\Throwable $th) {
            http_response_code(500);
            echo json_encode([
                'message' => 'Something went wrong on our end. Please try again later.',
                'error' => $th->getMessage()
            ]);
        }
    }

}