<?php
namespace Project\App\Controllers\Web\UseCases;

use Project\App\Mail\Mailer;
use Project\App\Models\Auth\AuthModel;
use Project\App\Models\Auth\PhotoUpdloadModel;
use Project\App\Models\Auth\RolesModel;
use Project\App\Models\Auth\UserRolesModel;



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
        $randomNum = rand(100000, 999999);
        $randomPnum = rand(100000, 999999);
        $temporaryPassword = $randomPnum;
        return [
            'username' => $baseUserName . $randomNum,
            'password' => $temporaryPassword,
        ];
    }
    public function register()
    {
        header('Content-Type: application-json');
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
            $findId = $this->controller->findByEmail($data['email']);
            $roleIDs = [
                'super_admin' => 1,
                'branch_admin' => 2,
                'assistant_admin' => 3,
                'therapist' => 4,
                'staff' => 5,
                'customer' => 6,
            ];
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
            if (isset($createRole)) {
                $this->mailer->sendVerification(
                    $data['email'],
                    'Good day! ' . $data['first_name'] . ', This is your temporary username and password below',
                    'Username: ' . $temporaryData['username'],
                    'Password: ' . $temporaryData['password'],
                    $data['first_name'],
                );
                $findRole = $this->roleModel->findByID($findId['id']);
                $createUserRoles = $this->userRolesModel->createUserRoles($findId['userID'], $findRole['roleID']);
                echo json_encode([
                    'data' => $createRole,
                    'roles' => json_decode($findRole['permissions'], true)
                ]);
                echo json_encode([
                    'status' => $createUserRoles
                ]);
            }
        } catch (\Throwable $th) {
            http_response_code(500);
            echo json_encode([
                'message' => 'Something went wrong on our end. Please try again later.',
                'error' => $th->getMessage()
            ]);
        }
    }

}