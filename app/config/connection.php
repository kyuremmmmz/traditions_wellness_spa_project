<?php

namespace Project\App\Config;

use PDO;

class Connection
{
    public static function connection()
    {
        session_start();
        header('Content-Type: application/json');

        $db = 'traditionswellnessspa';
        $password = 'root';
        $username = 'admin';
        $host = 'localhost:3307';

        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                try {
                    $pdo = new PDO("mysql:host=$host;dbname=$db", $username, $password);
                    echo json_encode([
                        'message' => 'Connected successfully'
                    ]);
                    return $pdo;
                } catch (\Throwable $th) {
                    echo json_encode([
                        'error' => $th->getMessage()
                    ]);
                }
                break;

            case 'POST':

                try {
                    $pdo = new PDO("mysql:host=$host;dbname=$db", $username, $password);
                    echo json_encode([
                        'message' => 'Connected successfully'
                    ]);
                    return $pdo;
                } catch (\Throwable $th) {
                    echo json_encode([
                        'error' => $th->getMessage()
                    ]);
                }
                break;

            case 'PUT':
                try {
                    $pdo = new PDO("mysql:host=$host;dbname=$db", $username, $password);
                    echo json_encode([
                        'message' => 'Connected successfully'
                    ]);
                    return $pdo;
                } catch (\Throwable $th) {
                    echo json_encode([
                        'error' => $th->getMessage()
                    ]);
                }
                break;

            case 'DELETE':
                try {
                    $pdo = new PDO("mysql:host=$host;dbname=$db", $username, $password);
                    echo json_encode([
                        'message' => 'Connected successfully'
                    ]);
                    return $pdo;
                } catch (\Throwable $th) {
                    echo json_encode([
                        'error' => $th->getMessage()
                    ]);
                }
                break;

            default:
                http_response_code(405);
                echo json_encode([
                    'error' => 'Method Not Allowed'
                ]);
                break;
        }
    }
}
