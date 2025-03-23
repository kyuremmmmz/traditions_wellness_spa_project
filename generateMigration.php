<?php
require 'C:\xampp\htdocs\TraditionsWellnessSpa\Project\app\config\connection.php';
use Project\App\Config\Connection;
// File: generateMigration.php

$migrationsDir = __DIR__ . '/app/migrations';


if (!is_dir($migrationsDir)) {
    mkdir($migrationsDir, 0755, true);
}


echo "Choose an action: [1] Create Migration, [2] Run Migrations, [3] Rollback Migrations: ";
$action = trim(fgets(STDIN));

$pdo =  Connection::globalConnection();

switch ($action) {
    case '1':
        echo "Enter migration name: ";
        $migrationName = trim(fgets(STDIN));
        $timestamp = date('YmdHis');
        $className = "Migrate{$timestamp}_{$migrationName}";
        $fileName = "{$className}.php";

        $filePath = "$migrationsDir/$fileName";
        $template = <<<PHP
<?php

class {$className}
{
    public function up(\$pdo)
    {
        // Example: Create a table
        // \$pdo->exec("CREATE TABLE example (id INT AUTO_INCREMENT PRIMARY KEY, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)");
    }

    public function down(\$pdo)
    {
        // Example: Drop the table
        // \$pdo->exec("DROP TABLE example");
    }
}
PHP;

        file_put_contents($filePath, $template);
        echo "Migration created: $filePath\n";
        break;

    case '2':
        $migrations = glob("$migrationsDir/*.php");
        sort($migrations);

        foreach ($migrations as $migrationFile) {
            require_once $migrationFile;
            $className = pathinfo($migrationFile, PATHINFO_FILENAME);

            if (!class_exists($className)) {
                echo "Migration class '$className' not found in file '$migrationFile'.\n";
                continue;
            }

            $migration = new $className();
            echo "Applying migration: $className\n";

            try {
                $migration->up($pdo);
                echo "Migration '$className' applied successfully.\n";
            } catch (Exception $e) {
                echo "Error applying migration '$className': " . $e->getMessage() . "\n";
            }
        }
        break;

    case '3':
        $migrations = glob("$migrationsDir/*.php");
        rsort($migrations);

        foreach ($migrations as $migrationFile) {
            require_once $migrationFile;
            $className = pathinfo($migrationFile, PATHINFO_FILENAME);

            if (!class_exists($className)) {
                echo "Migration class '$className' not found in file '$migrationFile'.\n";
                continue;
            }

            $migration = new $className();
            echo "Rolling back migration: $className\n";

            try {
                $migration->down($pdo);
                echo "Migration '$className' rolled back successfully.\n";
            } catch (Exception $e) {
                echo "Error rolling back migration '$className': " . $e->getMessage() . "\n";
            }
        }
        break;

    default:
        echo "Invalid option. Exiting.\n";
}
