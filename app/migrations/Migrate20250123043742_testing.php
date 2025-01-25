<?php

class Migrate20250123043742_testing
{
    public function up($pdo)
    {
        // Example: Create a table
        //$pdo->exec("CREATE TABLE testing (id INT AUTO_INCREMENT PRIMARY KEY, f_name VARCHAR(200), created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)");
    }

    public function down($pdo)
    {
        // Example: Drop the table
        $pdo->exec("DROP TABLE testing");
    }
}