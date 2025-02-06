<?php

    namespace Project\App\Controllers;

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
        // THIS IS FOR API TESTING DON'T REMOVE IT: $data = json_decode(file_get_contents('php://input'), true);
        if (isset($_POST['email'])) {
            $tokenForGenerate = $this->generateToken();
            $token = base64_encode($tokenForGenerate);
            $decodedToken = base64_decode($token);
            $response = $this->controller->findByEmail($_POST['email']);
            if (isset($response['username'])) {
                $this->mailer->sendToken(
                    $response['email'],
                    'Good day! ' . $response['first_name'] . ', This is your temporary username and password below',
                    'Token: ' . $decodedToken,
                    $response['first_name'],);
                $this->controller->delete($response['email']);
                $this->controller->insertToken($token, $response['email']);
                header('Location: /verification');
            }
        }
    }

    public function forgotPassword()
    {
        // THIS VAR IS FOR API: $data = json_decode(file_get_contents('php://input'), true);
        session_start();
        if (isset($_POST['remember_token']))  {
            $response = $this->controller->findByToken(base64_encode($_POST['remember_token']));
            if ($response) {
                $_SESSION['token'] = [
                    'token' => $_POST['remember_token'],
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
        if (isset($_SESSION['token']['token'], $_POST['newPassword'])) {
            $hashedNewPassword = password_hash($_POST['newPassword'], PASSWORD_BCRYPT);
            $result = $this->controller->forgotPassword(base64_encode($_SESSION['token']['token']), $hashedNewPassword);
            if ($result) {
                header('Location: /success');
                echo json_encode(['message' => 'Password has been updated successfully.']);
            } else {
                echo json_encode(['error' => 'Required fields are missing.']);
            }
        } else {
            $_SESSION['forgot_password_errors'] = ['verification' => 'Required fields are missing.'];
            echo json_encode(['error' => 'Required fields are missing.']);
            header('Location: /resetpassword');
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
                setcookie('user', base64_encode(json_encode($_SESSION['user'])), time() + 3600, '/');
                if (is_null($response['email_verified_at'])) {
                    $this->controller->update(
                        $response['email'],
                        date('Y-m-d H:i:s')
                    );
                }
                header('Location: /dashboard');
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

    }
}
