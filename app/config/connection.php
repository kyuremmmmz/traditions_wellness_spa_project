<?php

namespace Project\App\Config;

use PDO;

class Connection
{
    public static function globalConnection()
    {
        session_start();
        $db = 'traditionswellnessspa';
        $password = '';
        $username = 'root';
        $host = 'localhost:3306';
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function connection()
    {
        $db = 'traditionswellnessspa';
        $password = '';
        $username = 'root';
        $host = 'localhost:3306';

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
