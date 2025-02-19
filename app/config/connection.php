<?php

namespace Project\App\Config;

use PDO;

class Connection
{
    public static function connection()
    {
        $db = 'traditionswellnessspa';
        $password = 'root';
        $username = 'admin';
        $host = 'localhost:3307';

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db", $username, $password);
            return $pdo;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}