<?php

namespace Project\App\Controllers\Web;

use Project\App\Mail\Mailer;
use Project\App\Models\AuthModel;
use Project\App\Models\UserRolesModel;

class AuthController
{
    private $controller;
    private $photos;
    private $userRolesModel;
    private $mailer;
    public function __construct()
    {
        $this->controller = new AuthModel();
        $this->mailer = new Mailer();
        $this->userRolesModel = new UserRolesModel();
        $this->photos = new \Project\App\Models\PhotoUpdloadModel();
    }

    public function forgotPasswordSend()
    {
        if (isset($_POST['email'])) {
            $tokenForGenerate = $this->generateToken();
            $token = base64_encode($tokenForGenerate);
            $decodedToken = base64_decode($token);
            $response = $this->controller->findByEmail($_POST['email']);
            if (isset($response['username'])) {
                    $token_sender = $this->mailer->sendToken(
                        $response['email'],
                        'Good day! ' . $response['first_name'] . ', This is your temporary username and password below',
                        'Token: ' . $decodedToken,
                        $response['first_name']
                    );
                    if ($token_sender['status'] === 'error') {
                        session_start();
                        $_SESSION['server_error'] = [
                            'error' => 'Email sending failed. Please try again.'
                        ];
                        header('Location: /forgotpassword');
                        exit();
                    } else {
                        $this->controller->delete($response['email']);
                        $this->controller->insertToken($token, $response['email']);
                        header('Location: /verification');
                        exit();
                    }
                } 
            } else {
                $_SESSION['server_error'] = [
                    'error' => 'Email not found.'
                ];
                header('Location: /forgotpassword');
                exit();
            }
        } 


    public function forgotPassword()
    {
        // THIS VAR IS FOR API: $data = json_decode(file_get_contents('php://input'), true);
        session_start();
        if (isset($_POST['verification']))  {
            $response = $this->controller->findByToken(base64_encode($_POST['verification']));
            if ($response) {
                $_SESSION['token'] = [
                    'token' => $_POST['verification'],
                ];
                echo json_encode(['message' => 'Token is valid.']);
                header('Location: /resetpassword');
            }else{
                $_SESSION['forgot_password_errors'] = ['verification' => 'Invalid token.']; 
                echo json_encode(['error' => 'Invalid token.']);
                header('Location: /verification');
            }
        } 
    }

    public function resetPassword(){
        session_start();
        if (isset($_SESSION['token']['token'], $_POST['password'])) {
            $hashedNewPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $result = $this->controller->forgotPassword(base64_encode($_SESSION['token']['token']), $hashedNewPassword);
            $sessionPayloadData = $this->controller->findByToken(base64_encode($_SESSION['token']['token']));
            if ($result) {
                $_SESSION['user'] = [
                    'role' => $sessionPayloadData['role'],
                    'username' => $sessionPayloadData['username'],
                    'last_name' => $sessionPayloadData['last_name'],
                    'first_name' => $sessionPayloadData['first_name'],
                    'email' => $sessionPayloadData['email'],
                    'photos' => $sessionPayloadData['photos'],
                ];
                setcookie('user', base64_encode(json_encode($_SESSION['user'])), time() + 3600, '/');
                header('Location: /dashboard');
                echo json_encode(['message' => 'Password has been updated successfully.']);
            } else {
                echo json_encode(['error' => 'Required fields are missing.']);
            }
        } else {
            $_SESSION['forgot_password_errors'] = ['verification' => 'Required fields are missing.'];
            echo json_encode(['error' => 'Required fields are missing.']);
            header('Location: /uploadprofile');
        }
    }


        private function generateToken()
        {
            $randomToken = rand(100000, 999999);
            return $randomToken;
        }

        public function resetPasswordAndUserName(){
            $file = json_decode(file_get_contents('php://input'), true);
            $passwordPattern = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/';
            if (!preg_match($passwordPattern, $file['password'])) {
                echo json_encode([
                    'error' => 'Password must be at least 8 characters long and include an uppercase letter, a lowercase letter, a number, and a special character'
                ]);
                http_response_code(400);
                return;
            }
        }

    public function store()
    {
        session_start();
        if (!isset($_SESSION['login_attempts'])) {
            $_SESSION['login_attempts'] = 0;
            $_SESSION['last_attempt_time'] = time();
        }

        if (time() - $_SESSION['last_attempt_time'] > 300) {
            $_SESSION['login_attempts'] = 0;
        }
        if ($_SESSION['login_attempts'] >= 5) {
            http_response_code(429);
            header('Location: /');
            $_SESSION['login_errors']['username'] = 'Invalid username and password.';
            $_SESSION['login_errors']['password'] = 'Invalid username and password';
            echo json_encode(['error' => 'Too many attempts. Please try again after 5 minutes.']);
            return;
        }

        if (!isset($_POST['username'], $_POST['password'])) {
            http_response_code(400);
            $_SESSION['login_errors']['username'] = 'Invalid username and password.';
            $_SESSION['login_errors']['password'] = 'Invalid username and password';
            echo json_encode(['Error' => 'Username and password are required.']);
            return;
        }
        $response = $this->controller->find($_POST['username']);
        if (is_array($response)) {
            if (password_verify($_POST['password'], $response['password'])) {
                $_SESSION['login_attempts'] = 0;
                $_SESSION['user'] = [
                    'role' => $response['role'],
                    'username' => $response['username'],
                    'last_name' => $response['last_name'],
                    'first_name' => $response['first_name'],
                    'email' => $response['email'],
                    'photos' => $response['photos'],
                ];
                if (!empty($_POST['remember_me'])) {
                    setcookie('remember_cookie', base64_encode(json_encode($_SESSION['user']['role'])), time() + 3600);
                }
                setcookie('user', base64_encode(json_encode($_SESSION['user'])), time() + 3600, '/');
                if (is_null($response['email_verified_at'])) {
                    $this->controller->update(
                        $response['email'],
                        date('Y-m-d H:i:s')
                    );
                }
                if ($response['isFirstTimeLogin'] === 1) {
                    header('Location: /continueregistration');
                }else{
                    header('Location: /dashboard');
                }
                exit;
            } else {
                $_SESSION['login_attempts']++;
                $_SESSION['last_attempt_time'] = time();
                $_SESSION['login_errors']['username'] = 'Invalid username and password.';
                $_SESSION['login_errors']['password'] = 'Invalid username and password';
                http_response_code(401);
                echo json_encode(['Error' => 'Invalid credentials']);
                header('Location: /login');
                exit();
            }
        } else {
            $_SESSION['login_attempts']++;
            $_SESSION['last_attempt_time'] = time();
            $_SESSION['login_errors']['username'] = 'Invalid username and password.';
            $_SESSION['login_errors']['password'] = 'Invalid username and password';
            http_response_code(404);
            echo json_encode(['Error' => 'User not found']);
            header('Location: /login');
            exit();
        }
    }


    public function logout()
    {
        session_start();
        session_destroy();
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 3600, '/'); 
        }
        if (isset($_COOKIE['user'])) {
            setcookie('user', '', time() - 3600, '/');
        }
        header('Location: /login');
        exit;
    }
}
