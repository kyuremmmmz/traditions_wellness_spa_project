<?php
namespace Project\App\Controllers\Mobile;


use Project\App\Controllers\Web\RegistrationController;
use Project\App\Mail\UserMailer;
use Project\App\Models\AuthModel;
use Project\App\Models\RolesModel;
use Project\App\Models\UserAuthModel;
use Project\App\Models\UserRolesModel;

class AuthMobileController
{
    private $controller;
    private $controller2;
    private $webController;
    private $mail;
    private $secret_key = "secret_key"; 
    public function __construct(){
        $this->controller = new UserAuthModel();
        $this->controller2 = new UserRolesModel();
        $this->controller2 = new RolesModel();
        $this->webController = new AuthModel();
        $this->mail = new UserMailer();
    }
    public function registration()
    {
        $file = json_decode(file_get_contents('php://input'), true);
        if (isset($file['phone'])) {
            $findPhone = $this->webController->findByPhone($file['phone']);
            if (is_array($findPhone) && $file['phone'] === $findPhone['phone']) {
                http_response_code(401);
                echo json_encode([
                    'message' => 'This phone already exist'
                ]);
                $_SESSION['error'] = [
                    'message' => 'This phone already exist'
                ];
            }else{
                $response = $this->controller->create(
                    $file['lastName'],
                    $file['firstName'],
                    $file['gender'],
                    $file['phone'],
                    password_hash($file['password'], PASSWORD_BCRYPT),
                    $file['email']
                );
                $verification = $this->verificationCode();
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

    private function verificationCode(){
        $verification = random_int(100000, 999999);
        return $verification;
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
            $setVerificationCodeToNull = $this->controller->updateVerifCodeTonull($findByVerif['email']);
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

        if (isset($file['phone'])) {
            $phone = $this->controller->login($file['phone']);

            if (is_array($phone)) {
                if (password_verify($file['password'], $phone['password'])) {
                    if (!is_null($phone['email_verified_at'])) {
                        $jwt = $this->generateJWT($phone['id'], $phone['phone'], $phone['email']);

                        echo json_encode([
                            'message' => 'Login successful',
                            'token' => $jwt
                        ]);
                    } else {
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

    private function generateJWT($id, $phone, $email)
    {
        $header = json_encode(['alg' => 'HS256', 'typ' => 'JWT']);
        $payload = json_encode([
            'iss' => "your_website.com",
            'aud' => "your_website.com",
            'iat' => time(),
            'exp' => time() + (60 * 60),
            'data' => [
                'id' => $id,
                'phone' => $phone,
                'email' => $email
            ]
        ]);

        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
        $signature = hash_hmac('sha256', "$base64UrlHeader.$base64UrlPayload", $this->secret_key, true);
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        return "$base64UrlHeader.$base64UrlPayload.$base64UrlSignature";
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




    public function forgotPassword($id)
    {
        // Code for showing an edit form
        echo "This is the edit method of AuthMobileController for ID: $id.";
    }

    public function forgotPasswordSend($id)
    {
        // Code for updating resources
        echo "This is the update method of AuthMobileController for ID: $id.";
    }

    public function logout($id)
    {
        // Code for deleting resources
        echo "This is the delete method of AuthMobileController for ID: $id.";
    }
}