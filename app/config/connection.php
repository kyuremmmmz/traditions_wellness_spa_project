<?php

namespace Project\App\Config;

use PDO;

class Connection
{
    public static function globalConnection()
    {
        session_start();
        $db = 'traditionswellnessspa';
        $password = 'admin';
        $username = 'root';
        $host = 'localhost:3306';
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db", $username, $password);
            return $pdo;
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }

    public static function connection()
    {
        $db = 'traditionswellnessspa';
        $password = 'admin';
        $username = 'root';
        $host = 'localhost:3306';
        
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db", $username, $password);
            return $pdo;
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }
}
