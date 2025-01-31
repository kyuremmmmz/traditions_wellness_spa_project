<?php

class Migrate20250131113710_phone_reset_tokens
{
    public function up($pdo)
    {
        // Example: Create a table
        $pdo->exec("CREATE TABLE phone_reset_tokens (phone INT(250) PRIMARY KEY, token VARCHAR(250), created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)");
    }

    public function down($pdo)
    {
        // Example: Drop the table
        // $pdo->exec("DROP TABLE example");
    }
}