<?php

class Migrate20250122044144_test
{
    public function up($pdo)
    {
        // Example: Create a table
        $pdo->exec("CREATE TABLE test (id INT AUTO_INCREMENT PRIMARY KEY, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)");
    }

    public function down($pdo)
    {
        // Example: Drop the table
        // $pdo->exec("DROP TABLE example");
    }
}