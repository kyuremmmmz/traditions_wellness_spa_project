<?php
namespace Project\App\Controllers\Mobile;

use Project\App\Entities\PrivateFunctions;
use Project\App\Mail\UserMailer;
use Project\App\Models\Auth\AuthModel;
use Project\App\Models\Auth\RolesModel;
use Project\App\Models\Auth\UserAuthModel;
use Project\App\Models\Auth\UserRolesModel;

use Predis\Client; // Import Predis for Redis

class AuthMobileController
{
    private $controller;
    private $controller2;
    private $controller3;
    private $webController;
    private $mail;
    private $entities;
    private $redis; // Redis client property
    private $secret_key = "secret_key";

    public function __construct()
    {
        $this->controller = new UserAuthModel();
        $this->controller3 = new UserRolesModel();
        $this->controller2 = new RolesModel();
        $this->webController = new AuthModel();
        $this->mail = new UserMailer();
        $this->entities = new PrivateFunctions();
        // Initialize Redis client
        $this->redis = new Client([
            'scheme' => 'tcp',
            'host'   => '127.0.0.1', // Localhost; adjust if Redis is on a different server
            'port'   => 6379,
        ]);
    }

    public function registration()
    {
        $file = json_decode(file_get_contents('php://input'), true);
        if (isset($file['email'])) {
            $file['email'] = trim(strtolower($file['email']));
            $findEmail = $this->webController->findByEmail($file['email']);
            if (is_array($findEmail) && $file['email'] === $findEmail['email']) {
                http_response_code(401);
                echo json_encode([
                    'message' => 'This email already exist',
                    'status' => 'error',
                    'error' => 'Email already exists'
                ]);
                $_SESSION['error'] = ['message' => 'This email already exist'];
                return;
            }

            $response = $this->controller->create(
                $file['lastName'],
                $file['firstName'],
                $file['gender'],
                $file['email']
            );

            $findRole = $this->webController->findByEmail($file['email']);
            if (!is_array($findRole) || !isset($findRole['email'])) {
                http_response_code(500);
                echo json_encode([
                    'message' => 'Error creating user',
                    'status' => 'error',
                    'error' => 'User creation failed'
                ]);
                return;
            }

            $createRole = $this->controller2->createRoles($findRole['id'], 'Customer', 'book_a_service');
            $findRoles = $this->controller2->findByID($findRole['id']);
            
            if (is_array($findRoles)) {
                $createUserRoles = $this->controller3->createUserRoles($findRole['userID'], $findRoles['roleID']);
            }

            $verification = $this->entities->verificationCode();
            $verifStatus = $this->controller->verifCode($verification, $file['email']);
            
            if (!$verifStatus) {
                http_response_code(500);
                echo json_encode([
                    'message' => 'Error storing verification code',
                    'status' => false
                ]);
                return;
            }

            $mailStatus = $this->mail->authMailer(
                $file['email'],
                'Good day! ' . $file['firstName'] . ', This is your Verification code please do not share this code below',
                '' . $verification,
                $file['firstName']
            );

            if (!$mailStatus) {
                http_response_code(500);
                echo json_encode([
                    'message' => 'Error sending verification email',
                    'status' => false
                ]);
                return;
            }

            // Generate JWT and store in Redis
            $jwt = $this->entities->generateJWT($findRole['id'], $file['email'], $this->secret_key);
            $this->redis->setex("session:".$file['email'], 86400, $jwt); // 24-hour expiry

            $response = [
                'message' => 'Signed up successfully',
                'status' => 'success',
                'error' => null,
                'verification_sent' => true,
                'token' => $jwt // Include token in response
            ];
            echo json_encode($response);
            $_SESSION['success'] = ['message' => 'Signed up successfully'];
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
                    'message' => 'Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.',
                    'status' => false,
                    'error' => 'Invalid password format'
                ]);
                return;
            }
    
            // Fix the object reference: use $this->webController instead of $this->webAuthController
            $response = $this->webController->findByCode($data['verifCode']);
    
            if (is_array($response)) {
                $verifyEmail = $this->controller->verifyEmail($data['verifCode']);
                
                if ($verifyEmail) {
                    $setPassword = $this->controller->setPassword(password_hash($password, PASSWORD_BCRYPT), $data['verifCode']);
                    
                    if ($setPassword) {
                        $setVerificationCodeToNull = $this->controller->updateVerifCodeTonull($response['email'], null);
                        
                        if ($setVerificationCodeToNull) {
                            echo json_encode([
                                'message' => 'Password applied and email verified successfully',
                                'status' => true,
                                'error' => null
                            ]);
                        } else {
                            http_response_code(500);
                            error_log("addPassword: Failed to set verification code to null for email: " . $response['email']);
                            echo json_encode([
                                'message' => 'Password set but failed to clear verification code',
                                'status' => false,
                                'error' => 'Failed to clear verification code'
                            ]);
                        }
                    } else {
                        http_response_code(500);
                        error_log("addPassword: Failed to set password for verifCode: " . $data['verifCode']);
                        echo json_encode([
                            'message' => 'Failed to set password',
                            'status' => false,
                            'error' => 'Password Set Failed'
                        ]);
                    }
                } else {
                    http_response_code(500);
                    error_log("addPassword: Failed to verify email for verifCode: " . $data['verifCode']);
                    echo json_encode([
                        'message' => 'Failed to verify email',
                        'status' => false,
                        'error' => 'Email Verification Failed'
                    ]);
                }
            } else {
                http_response_code(400);
                echo json_encode([
                    'message' => 'Invalid verification code',
                    'status' => false,
                    'error' => 'Invalid Code'
                ]);
            }
        } else {
            http_response_code(400);
            echo json_encode([
                'message' => 'Missing required fields',
                'status' => false,
                'error' => 'Missing Fields'
            ]);
        }
    }

    public function verifyEmailAndPhone()
    {
        $file = json_decode(file_get_contents('php://input'), true);
        if (isset($file['verifCode'])) {
            $findByVerif = $this->webController->findByCode($file['verifCode']);
            if (!$findByVerif) {
                http_response_code(404);
                echo json_encode([
                    'message' => 'Verification code not found',
                    'status' => false
                ]);
                return;
            }
            
            $response = $this->controller->verifyEmail($file['verifCode']);
            if (!$response) {
                http_response_code(500);
                echo json_encode([
                    'message' => 'Failed to verify email',
                    'status' => false
                ]);
                return;
            }

            $setVerificationCodeToNull = $this->controller->updateVerifCodeTonull($findByVerif['email'], null);
            if ($setVerificationCodeToNull) {
                echo json_encode([
                    'message' => 'Email verified successfully',
                    'status' => true
                ]);
            } else {
                http_response_code(500);
                echo json_encode([
                    'message' => 'Failed to update verification status',
                    'status' => false
                ]);
            }
        } else {
            http_response_code(400);
            echo json_encode([
                'message' => 'Verification code is required',
                'status' => false
            ]);
        }
    }

    // New function to check the verification code without consuming it
    public function checkVerificationCode()
    {
        $file = json_decode(file_get_contents('php://input'), true);
        if (isset($file['verifCode'])) {
            $findByVerif = $this->webController->findByCode($file['verifCode']);
            if (!$findByVerif) {
                http_response_code(404);
                echo json_encode([
                    'message' => 'Verification code not found',
                    'status' => false,
                    'error' => 'Invalid Code'
                ]);
                return;
            }

            // Simply return success if the code exists, without consuming it
            echo json_encode([
                'message' => 'Verification code is valid',
                'status' => true,
                'error' => null
            ]);
        } else {
            http_response_code(400);
            echo json_encode([
                'message' => 'Verification code is required',
                'status' => false,
                'error' => 'Missing Field'
            ]);
        }
    }

    public function login()
    {
        header('Content-Type: application/json');
        $file = json_decode(file_get_contents('php://input'), true);

        if (isset($file['email'])) {
            $email = $this->webController->findByEmail($file['email']);
            if (is_array($email)) {
                if (password_verify($file['password'], $email['password'])) {
                    if (!is_null($email['email_verified_at'])) {
                        $jwt = $this->entities->generateJWT($email['id'], $email['email'], $this->secret_key);
                        $this->redis->setex("session:".$email['email'], 86400, $jwt); // Store in Redis, 24-hour expiry
                        $response = [
                            'message' => 'Login successful',
                            'token' => $jwt,
                            'error' => null,
                            'status' => 'success',
                            'user' => [
                                'id' => $email['id'],
                                'email' => $email['email'],
                                'firstName' => $email['first_name'],
                                'lastName' => $email['last_name']
                            ]
                        ];
                        error_log("Login response: " . json_encode($response));
                        echo json_encode($response);
                        exit;
                    } else {
                        http_response_code(403);
                        $response = [
                            'message' => 'Email not verified',
                            'token' => null,
                            'error' => 'Please verify your email first',
                            'status' => 'unverified'
                        ];
                        error_log("Login failed: Email not verified for user " . $file['email']);
                        echo json_encode($response);
                        exit;
                    }
                } else {
                    http_response_code(401);
                    $response = [
                        'message' => 'Invalid credentials',
                        'token' => null,
                        'error' => 'Invalid password',
                        'status' => 'error'
                    ];
                    error_log("Login failed: Invalid password for user " . $file['email']);
                    echo json_encode($response);
                    exit;
                }
            } else {
                http_response_code(401);
                $response = [
                    'message' => 'Invalid credentials',
                    'token' => null,
                    'error' => 'Invalid credentials',
                    'status' => 'error'
                ];
                error_log("Login failed: User not found with email " . $file['email']);
                echo json_encode($response);
                exit;
            }
        }
    }

    public function checkToken()
    {
        header('Content-Type: application/json');
        $file = json_decode(file_get_contents('php://input'), true);

        if (isset($file['token']) && isset($file['email'])) {
            $storedToken = $this->redis->get("session:".$file['email']);
            if ($storedToken && $storedToken === $file['token']) {
                $decoded = $this->verifyJWT($file['token']);
                if ($decoded) {
                    $user = $this->webController->findByEmail($file['email']);
                    echo json_encode([
                        'message' => 'Token valid',
                        'status' => 'success',
                        'error' => null,
                        'user' => [
                            'id' => $decoded['data']['id'],
                            'email' => $decoded['data']['email'],
                            'firstName' => $user['first_name']
                        ]
                    ]);
                } else {
                    http_response_code(401);
                    echo json_encode([
                        'message' => 'Token expired or invalid',
                        'status' => 'error',
                        'error' => 'Token invalid'
                    ]);
                }
            } else {
                http_response_code(401);
                echo json_encode([
                    'message' => 'Token not found or mismatched',
                    'status' => 'error',
                    'error' => 'Token invalid'
                ]);
            }
        } else {
            http_response_code(400);
            echo json_encode([
                'message' => 'Token and email required',
                'status' => 'error',
                'error' => 'Missing fields'
            ]);
        }
        exit;
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
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['email'])) {
            $tokenForGenerate = $this->entities->generateToken();
            $token = base64_encode($tokenForGenerate);
            $decodedToken = base64_decode($token);
            $response = $this->webController->findByEmail($data['email']);
            if (isset($response['email'])) {
                $mailStatus = $this->mail->sendToken(
                    $response['email'],
                    'Good day! ' . $response['first_name'] . ', This is your password reset token below',
                    'Token: ' . $decodedToken,
                    $response['first_name']
                );
                if ($mailStatus) {
                    $this->webController->delete($response['email']); // Verify this is intentional
                    $this->webController->insertToken($token, $response['email']);
                    echo json_encode([
                        'message' => 'Verification token sent to your email',
                        'status' => 'success',
                        'error' => null
                    ]);
                } else {
                    http_response_code(500);
                    echo json_encode([
                        'message' => 'Failed to send verification token',
                        'status' => 'error',
                        'error' => 'Email sending failed'
                    ]);
                }
            } else {
                http_response_code(404);
                echo json_encode([
                    'message' => 'Email not found',
                    'status' => 'error',
                    'error' => 'Email not found'
                ]);
            }
        } else {
            http_response_code(400);
            echo json_encode([
                'message' => 'Email is required',
                'status' => 'error',
                'error' => 'Missing email'
            ]);
        }
        exit;
    }

    public function forgotPassword()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        session_start();
        if (isset($data['verification'])) {
            $response = $this->webController->findByToken(base64_encode($data W['verification']));
            if ($response) {
                $_SESSION['token'] = ['token' => $data['verification']];
                echo json_encode([
                    'message' => 'Token is valid',
                    'status' => 'success',
                    'error' => null
                ]);
            } else {
                $_SESSION['forgot_password_errors'] = ['verification' => 'Invalid token.'];
                http_response_code(400);
                echo json_encode([
                    'message' => 'Invalid token',
                    'status' => 'error',
                    'error' => 'Invalid token'
                ]);
            }
        }
    }

    public function resetPassword()
    {
        $data = json_decode(file_get_contents('php://input'), true);
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
                echo json_encode([
                    'message' => 'Password has been updated successfully',
                    'status' => 'success',
                    'error' => null
                ]);
            } else {
                http_response_code(400);
                echo json_encode([
                    'message' => 'Password update failed',
                    'status' => 'error',
                    'error' => 'Invalid token or password update failed'
                ]);
            }
        } else {
            $_SESSION['forgot_password_errors'] = ['verification' => 'Required fields are missing.'];
            http_response_code(400);
            echo json_encode([
                'message' => 'Missing required fields',
                'status' => 'error',
                'error' => 'Required fields are missing'
            ]);
        }
    }

    public function logout()
    {
        header('Content-Type: application/json');
        $file = json_decode(file_get_contents('php://input'), true);

        if (isset($file['token']) && isset($file['email'])) {
            $storedToken = $this->redis->get("session:".$file['email']);
            if ($storedToken && $storedToken === $file['token']) {
                // Remove the token from Redis
                $this->redis->del("session:".$file['email']);
                echo json_encode([
                    'message' => 'Logged out successfully',
                    'status' => 'success',
                    'error' => null
                ]);
            } else {
                http_response_code(401);
                echo json_encode([
                    'message' => 'Invalid or missing session',
                    'status' => 'error',
                    'error' => 'Token invalid or not found'
                ]);
            }
        } else {
            http_response_code(400);
            echo json_encode([
                'message' => 'Token and email required',
                'status' => 'error',
                'error' => 'Missing fields'
            ]);
        }
        exit;
    }
}