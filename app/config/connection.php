<?php
session_start();
header('Content-Type: application-json');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application-json');
    $db = 'traditionswellnessspa';
    $password = 'root';
    $username = 'admin';
    $host = 'localhost:3307';

    $pdo = new PDO("mysql:host=$host;dbname=$db", $username, $password);
    if (!$pdo) {
        header('Content-Type: application-json');
        echo json_encode([
            'errorMessage' => 'not connected'
        ]);
    } else {
        echo json_encode([
            'message' => 'connected'
        ]);
    }
}else{
    echo json_encode([
        'message' => 'This method should be a POST method'
    ]);
}