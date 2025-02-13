<?php

/**
 * Controller Generator Script
 * Generates a controller file for a vanilla PHP project via terminal.
 */


if (php_sapi_name() !== 'cli') {
    die("This script must be run from the command line.\n");
}

echo "Enter the folder name: ";
$folderName = trim(fgets(STDIN));
echo "Enter the controller name: ";
$controllerName = trim(fgets(STDIN));

if (!$controllerName) {
    echo "Error: Controller name cannot be empty.\n";
    exit(1);
}


$controllerName = ucfirst(preg_replace('/[^a-zA-Z0-9]/', '', $controllerName)) . 'Controller';


switch (strtoupper($folderName)) {
    case 'MOBILE':
        $controllerDir = __DIR__ . '/app/controllers/Mobile';
        $controllerFile = $controllerDir . '/' . $controllerName . '.php';


        if (!is_dir($controllerDir)) {
            mkdir($controllerDir, 0755, true);
        }

        $controllerTemplate = <<<PHP
<?php

class $controllerName
{
    public function index()
    {
        // Code for listing resources
        echo "This is the index method of $controllerName.";
    }

    public function create()
    {
        // Code for showing a create form
        echo "This is the create method of $controllerName.";
    }

    public function store()
    {
        // Code for storing new resources
        echo "This is the store method of $controllerName.";
    }

    public function edit(\$id)
    {
        // Code for showing an edit form
        echo "This is the edit method of $controllerName for ID: \$id.";
    }

    public function update(\$id)
    {
        // Code for updating resources
        echo "This is the update method of $controllerName for ID: \$id.";
    }

    public function delete(\$id)
    {
        // Code for deleting resources
        echo "This is the delete method of $controllerName for ID: \$id.";
    }
}
PHP;


        if (file_exists($controllerFile)) {
            echo "Error: Controller '$controllerName' already exists!\n";
        } else {
            file_put_contents($controllerFile, $controllerTemplate);
            echo "Controller '$controllerName' has been created successfully in the 'controllers' directory.\n";
        }

        break;
    case 'WEB':
        $controllerDir = __DIR__ . '/app/controllers';
        $controllerFile = $controllerDir . '/' . $controllerName . '.php';


        if (!is_dir($controllerDir)) {
            mkdir($controllerDir, 0755, true);
        }

        $controllerTemplate = <<<PHP
<?php

class $controllerName
{
    public function index()
    {
        // Code for listing resources
        echo "This is the index method of $controllerName.";
    }

    public function create()
    {
        // Code for showing a create form
        echo "This is the create method of $controllerName.";
    }

    public function store()
    {
        // Code for storing new resources
        echo "This is the store method of $controllerName.";
    }

    public function edit(\$id)
    {
        // Code for showing an edit form
        echo "This is the edit method of $controllerName for ID: \$id.";
    }

    public function update(\$id)
    {
        // Code for updating resources
        echo "This is the update method of $controllerName for ID: \$id.";
    }

    public function delete(\$id)
    {
        // Code for deleting resources
        echo "This is the delete method of $controllerName for ID: \$id.";
    }
}
PHP;


        if (file_exists($controllerFile)) {
            echo "Error: Controller '$controllerName' already exists!\n";
        } else {
            file_put_contents($controllerFile, $controllerTemplate);
            echo "Controller '$controllerName' has been created successfully in the 'controllers' directory.\n";
        }
        break;
    default:
        echo 'NA';
        break;
}