<?php
namespace Project\App\Controllers\Mobile;


use Project\App\Entities\PrivateFunctions;
use Project\App\Mail\UserMailer;
use Project\App\Models\Auth\AuthModel;
use Project\App\Models\Auth\RolesModel;
use Project\App\Models\Auth\UserAuthModel;
use Project\App\Models\Auth\UserRolesModel;


class AuthMobileController
{
    private $controller;
    private $controller2;
    private $controller3;
    private $webController;
    private $mail;
    private $entities;
    private $secret_key = "secret_key";

    public function __construct(){
        $this->controller = new UserAuthModel();
        $this->controller3 = new UserRolesModel();
        $this->controller2 = new RolesModel();
        $this->webController = new AuthModel();
        $this->mail = new UserMailer();
        $this->entities = new PrivateFunctions();
    }
    public function registration()
    {
        $file = json_decode(file_get_contents('php://input'), true);
        if (isset($file['email'])) {
            $findEmail = $this->webController->findByEmail($file['email']);
            if (is_array($findEmail) && $file['email'] === $findEmail['email']) {
                http_response_code(401);
                echo json_encode([
                    'message' => 'This email already exist'
                ]);
                $_SESSION['error'] = [
                    'message' => 'This email already exist'
                ];
            }else{
                if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&+=!]).{8,}$/', $file['password'])) {
                    http_response_code(400);
                    echo json_encode([
                        'error message' => 'Password must contain uppercase letters, lower case letters, special characters, and numbers'
                    ]);
                }else{
                    $response = $this->controller->create(
                        $file['lastName'],
                        $file['firstName'],
                        $file['gender'],
                        $file['email']
                    );
                    $findRole = $this->webController->findByEmail($file['email']);
                    if (is_array($findRole) && isset($findRole['email'])) {
                        $createRole = $this->controller2->createRoles($findRole['id'], 'Customer', 'book_a_service');
                        echo json_encode([
                            'status' => $createRole
                        ]);
                        $findRoles = $this->controller2->findByID($findRole['id']);
                        if (is_array($findRoles)) {
                            $createUserRoles = $this->controller3->createUserRoles($findRole['userID'], $findRoles['roleID']);
                            echo json_encode([
                                'status' => $createUserRoles
                            ]);
                        }
                    }
                    $verification = $this->entities->verificationCode();
                    $this->mail->authMailer(
                        $file['email'],
                        'Good day! ' . $file['firstName'] . ', This is your Vaerification code please do not share this code below',
                        '' . $verification,
                        $file['firstName']
                    );
                    $this->controller->verifCode($verification, $file['email']);
                    echo json_encode([
                        'message' => 'Signed up successfully',
                        'status' => $response
                    ]);
                    $_SESSION['success'] = [
                        'message' => 'Signed up successfully'
                    ];
                }
            }
        }
    }

    public function addPassword()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data['verifCode']) && isset($data['password'])) {
            $password = $data['password'];

            $passwordPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&_-])[A-Za-z\d@$!%*?&_-]{8,}$/';

            if (!preg_match($passwordPattern, $data['password'])) {
                http_response_code(400);
                echo json_encode([
                    'message' => 'Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.'
                ]);
                return;
            }

            $response = $this->webController->findByCode($data['verifCode']);

            if (is_array($response)) {
                $setPassword = $this->controller->setPassword(password_hash($password, PASSWORD_BCRYPT), $data['verifCode']);

                if ($setPassword) {
                    echo json_encode([
                        'value' => 'Password applied successfully',
                        'status' => $setPassword
                    ]);
                } else {
                    http_response_code(500);
                    echo json_encode([
                        'message' => 'Internal Server Error'
                    ]);
                }
            }
        } else {
            http_response_code(400);
            echo json_encode([
                'message' => 'Missing required fields'
            ]);
        }
    }



    public function verifyEmailAndPhone(){
        $file = json_decode(file_get_contents('php://input'), true);
        if (isset($file['verifCode'])) {
            $response = $this->controller->verifyEmail($file['verifCode']);
            $findByVerif = $this->webController->findByCode($file['verifCode']);
            if(!$findByVerif){
                echo json_encode([
                    'message' => 'Verification code not found',
                    'status' => false
                ]);
                return;
            }
            $setVerificationCodeToNull = $this->controller->updateVerifCodeTonull($findByVerif['email'], $file['verifCode']);
            if (is_array($findByVerif) && $response && $setVerificationCodeToNull) {
                echo json_encode(
                    [
                        'message' => 'Verified',
                        'status' => $setVerificationCodeToNull
                    ]
                );
            }
        }
    }



    public function login()
    {
        header('Content-Type: application/json');

        $file = json_decode(file_get_contents('php://input'), true);

        if (isset($file['email'])) {
            $email = $this->controller->login($file['email']);

            if (is_array($email)) {
                if (password_verify($file['password'], $email['password'])) {
                    if (!is_null($email['email_verified_at'])) {
                        $jwt = $this->entities->generateJWT($email['id'],  $email['email'], $this->secret_key);

                        echo json_encode([
                            'message' => 'Login successful',
                            'token' => $jwt
                        ]);
                    } else {
                        http_response_code(403);
                        echo json_encode(['message' => 'Please verify your email']);
                    }
                } else {
                    http_response_code(401);
                    echo json_encode(['error' => 'Invalid credentials']);
                }
            } else {
                http_response_code(401);
                echo json_encode(['error' => 'Invalid credentials']);
            }
        }
    }

    

    public function verifyJWT($jwt)
    {
        $tokenParts = explode('.', $jwt);
        if (count($tokenParts) !== 3) {
            return false;
        }

        list($header, $payload, $signature) = $tokenParts;
        $expectedSignature = hash_hmac('sha256', "$header.$payload", $this->secret_key, true);
        $expectedSignatureBase64 = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($expectedSignature));

        if ($signature !== $expectedSignatureBase64) {
            return false;
        }

        $decodedPayload = json_decode(base64_decode($payload), true);

        if ($decodedPayload['exp'] < time()) {
            return false;
        }

        return $decodedPayload;
    }

    public function forgotPasswordSend()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['email'])) {
            $tokenForGenerate = $this->entities->generateToken();
            $token = base64_encode($tokenForGenerate);
            $decodedToken = base64_decode($token);
            $response = $this->webController->findByEmail($data['email']);
            if (isset($response['email'])) {
                $this->mail->sendToken(
                    $response['email'],
                    'Good day! ' . $response['first_name'] . ', This is your temporary username and password below',
                    'Token: ' . $decodedToken,
                    $response['first_name'],
            );
                $this->webController->delete($response['email']);
                $this->webController->insertToken($token, $response['email']);
            }else{
                http_response_code(404);
                echo json_encode([
                    'response code' => 'Email not found'
                ]);
            }
        }
    }

    public function forgotPassword()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        session_start();
        if (isset($data['verification'])) {
            $response = $this->webController->findByToken(base64_encode($data['verification']));
            if ($response) {
                $_SESSION['token'] = [
                    'token' => $data['verification'],
                ];
                echo json_encode(['message' => 'Token is valid.']);
                header('Location: /resetpassword');
            } else {
                $_SESSION['forgot_password_errors'] = ['verification' => 'Invalid token.'];
                echo json_encode(['error' => 'Invalid token.']);
                header('Location: /verification');
            }
        }
    }

    public function resetPassword()
    {
        $data = json_decode(file_get_contents('php://input'),true);
        session_start();
        if (isset($data['token'], $data['password'])) {
            $hashedNewPassword = password_hash($data['password'], PASSWORD_BCRYPT);
            $result = $this->webController->forgotPassword(base64_encode($data['token']), $hashedNewPassword);
            $sessionPayloadData = $this->webController->findByToken(base64_encode($data['token']));
            if ($result) {
                $_SESSION['user'] = [
                    'role' => $sessionPayloadData['role'],
                    'last_name' => $sessionPayloadData['last_name'],
                    'first_name' => $sessionPayloadData['first_name'],
                    'email' => $sessionPayloadData['email'],
                    'photos' => $sessionPayloadData['photos'],
                ];
                echo json_encode(['message' => 'Password has been updated successfully.']);
            } else {
                echo json_encode(['error' => 'Invalid token or password update failed.']);
            }
        } else {
            $_SESSION['forgot_password_errors'] = ['verification' => 'Required fields are missing.'];
            echo json_encode(['error' => 'Required fields are missing.']);
            header('Location: /uploadprofile');
        }
    }


    


    public function logout($id)
    {
        // Code for deleting resources
        echo "This is the delete method of AuthMobileController for ID: $id.";
    }
    
}