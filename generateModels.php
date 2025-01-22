<?php

/**
 * Model Generator Script
 * Generates a model file for a vanilla PHP project via terminal.
 */

// Check if the script is run via CLI
if (php_sapi_name() !== 'cli') {
    die("This script must be run from the command line.\n");
}


echo "Enter the model name: ";
$modelName = trim(fgets(STDIN));

if (!$modelName) {
    echo "Error: Model name cannot be empty.\n";
    exit(1);
}


$modelName = ucfirst(preg_replace('/[^a-zA-Z0-9]/', '', $modelName)) . 'Model';


$modelDir = __DIR__ . '/app/models';
$modelFile = $modelDir . '/' . $modelName . '.php';


if (!is_dir($modelDir)) {
    mkdir($modelDir, 0755, true);
}

$modelTemplate = <<<PHP
<?php

class $modelName
{
    private \$pdo;

    public function __construct(\$pdo)
    {
        \$this->pdo = \$pdo;
    }

    public function getAll()
    {
        \$stmt = \$this->pdo->query("SELECT * FROM your_table_name");
        return \$stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(\$id)
    {
        \$stmt = \$this->pdo->prepare("SELECT * FROM your_table_name WHERE id = :id");
        \$stmt->execute(['id' => \$id]);
        return \$stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create(\$data)
    {
        \$stmt = \$this->pdo->prepare("INSERT INTO your_table_name (column1, column2) VALUES (:value1, :value2)");
        return \$stmt->execute(\$data);
    }

    public function update(\$id, \$data)
    {
        \$stmt = \$this->pdo->prepare("UPDATE your_table_name SET column1 = :value1, column2 = :value2 WHERE id = :id");
        \$data['id'] = \$id;
        return \$stmt->execute(\$data);
    }

    public function delete(\$id)
    {
        \$stmt = \$this->pdo->prepare("DELETE FROM your_table_name WHERE id = :id");
        return \$stmt->execute(['id' => \$id]);
    }
}
PHP;


if (file_exists($modelFile)) {
    echo "Error: Model '$modelName' already exists!\n";
} else {
    file_put_contents($modelFile, $modelTemplate);
    echo "Model '$modelName' has been created successfully in the 'models' directory.\n";
}
