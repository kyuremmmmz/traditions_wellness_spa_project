<?php
namespace Project\App\Config;

use PDO;
class Connection {
	public static function connection (){
        session_start();
        header('Content-Type: application-json');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            header('Content-Type: application-json');
            $db = 'traditionswellnessspa';
            $password = 'root';
            $username = 'admin';
            $host = 'localhost:3307';
            try {
                header('Content-Type: application-json');
                $pdo = new PDO("mysql:host=$host;dbname=$db", $username, $password);
                echo json_encode([
                    'messge' => 'connected'
                ]);
                return $pdo;
            } catch (\Throwable $th) {
                echo json_encode([
                    'error' => "$th"
                ]);
            }
        } else {
            echo json_encode([
                'message' => 'This method should be a POST method'
            ]);
        }
	}
}


// Function testing
header('Content-Type: application-json');
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header('Content-Type: application-json');
    $db = 'traditionswellnessspa';
    $password = 'root';
    $username = 'admin';
    $host = 'localhost:3307';
    try {
        header('Content-Type: application-json');
        $pdo = new PDO("mysql:host=$host;dbname=$db", $username, $password);
        echo json_encode([
            'messge' => 'connected'
        ]);
        return $pdo;
    } catch (\Throwable $th) {
        echo json_encode([
            'error' => "$th"
        ]);
    }
} else {
    echo json_encode([
        'message' => 'This method should be a GET method'
    ]);
}