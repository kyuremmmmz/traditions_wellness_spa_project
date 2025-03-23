<?php

class Migrate20250323121602_Therapist
{
    public function up($pdo)
    {
        // Example: Create a table
        $pdo->exec("CREATE TABLE therapist (id INT AUTO_INCREMENT PRIMARY KEY, first_name text, last_name text, gender ENUM('male', 'female', 'others'),status ENUM('active', 'inactive'), email text,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)");
    }

    public function down($pdo)
    {
        // Example: Drop the table
        // $pdo->exec("DROP TABLE example");
    }
}