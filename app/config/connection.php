<?php

namespace Project\App\Config;

use PDO;
use PDOException;

class Connection
{
    public static function connection()
    {
        $db = 'traditionswellnessspa';
        $password = '';
        $username = 'root';
        $host = 'localhost:3306';

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db", $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
            return $pdo;
        } catch (PDOException $e) {
            echo json_encode([
                'error' => $e->getMessage()
            ]);
            return null;
        }
    }
}
