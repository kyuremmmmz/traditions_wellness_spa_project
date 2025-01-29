<?php

namespace Project\App\Controllers;

use Project\App\Mail\Mailer;
use Project\App\Models\AuthModel;




class AuthController
{
    private $controller;
    private $mailer;
    public function __construct()
    {
        $this->controller = new AuthModel();
        $this->mailer = new Mailer();
    }

    public function forgotPasswordSend()
    {
       // FOR POSTMAN TESTING HUWAG GALAWIN PLS: $data = json_decode(file_get_contents('php://input'), true);
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
            }
        }
    }

    public function forgotPassword()
    {
        // FOR POSTMAN TESTING HUWAG GALAWIN PLS: $data = json_decode(file_get_contents('php://input'), true);
        if (isset($_POST['remember_token'], $_POST['newPassword'])) {
            $response = $this->controller->findByToken(base64_encode($_POST['remember_token']));
            $hashedNewPassword = password_hash($_POST['newPassword'], PASSWORD_BCRYPT);
            $result = $this->controller->forgotPassword($response['remember_token'], $hashedNewPassword);
            if ($result) {
                echo json_encode(['message' => 'Password has been updated successfully.']);
            } else {
                echo json_encode(['error' => 'Invalid token or password update failed.']);
            }
        } else {
            echo json_encode(['error' => 'Required fields are missing.']);
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

    public function register()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $temporaryData = $this->generateTemporaryUserNameAndPassword($data['first_name'], $data['last_name']);
        $emailPattern = '/^[\w.%+-]+@[\w.-]+\.[a-zA-Z]{2,}$/';
        if (!preg_match($emailPattern, $data['email'])) {
            echo json_encode([
                'error' => 'Invalid email format'
            ]);
            http_response_code(400);
            return;
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
            echo json_encode(['error' => 'Too many attempts. Please try again after 5 minutes.']);
            return;
        }

        if (!isset($_POST['username'], $_POST['password'])) {
            http_response_code(400);
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
                    'email' => $response['email']
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
                http_response_code(401);
                echo json_encode(['Error' => 'Invalid credentials']);
            }
        } else {
            $_SESSION['login_attempts']++;
            $_SESSION['last_attempt_time'] = time();
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

    }

    public function update($id)
    {

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
