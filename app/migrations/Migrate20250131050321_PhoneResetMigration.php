<?php   
class Migrate20250131050321_PhoneResetMigration
{
    public function up($pdo)
    {
        // Example: Create a table
        $pdo->exec("CREATE TABLE reset_phone_numbers_token (phone INT(20) PRIMARY KEY, token VARCHAR(250),created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)");
    }

    public function down($pdo)
    {
        // Example: Drop the table
        // $pdo->exec("DROP TABLE example");
    }
}