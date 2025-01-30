<?php

$baseDir = __DIR__ . '/app/views/php/components';

if (!is_dir($baseDir)) {
    mkdir($baseDir, 0755, true);
}

echo "Choose an action: [1] Create Component, [2] List Components: ";
$action = trim(fgets(STDIN));

switch ($action) {
    case '1':
        echo "Enter the folder name to store the component (or press Enter for root): ";
        $folderName = trim(fgets(STDIN));
        $targetDir = $baseDir;

        if ($folderName) {
            $targetDir .= '/' . $folderName;
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
                echo "Folder created: $targetDir\n";
            } else {
                echo "Using existing folder: $targetDir\n";
            }
        }

        echo "Enter component name (e.g., Button, Card, etc.): ";
        $componentName = trim(fgets(STDIN));
        $className = ucfirst($componentName);
        $fileName = "{$className}.php";

        $filePath = "$targetDir/$fileName";

        $template = <<<PHP
<?php

namespace Project\App\Views\Php\Components;

class {$className}
{
    public static function render(?string \$className = null): void
    {
        // Render the component starting with a <div>
        \$classAttribute = \$className ? " class=\"\$className\"" : '';
        echo <<<HTML
        <div{\$classAttribute}>
            <!-- Add your content here -->
        </div>
        HTML;
    }
}
PHP;

        file_put_contents($filePath, $template);
        echo "Component created: $filePath\n";
        break;

    case '2':
        $folders = glob("$baseDir/*", GLOB_ONLYDIR);
        if (empty($folders)) {
            echo "No folders found in components directory.\n";
        } else {
            echo "Available folders:\n";
            foreach ($folders as $folder) {
                echo "- " . basename($folder) . "\n";
            }
        }

        $components = glob("$baseDir/**/*.php");
        if (empty($components)) {
            echo "No components found.\n";
        } else {
            echo "Available components:\n";
            foreach ($components as $component) {
                echo "- " . str_replace("$baseDir/", '', $component) . "\n";
            }
        }
        break;

    default:
        echo "Invalid option. Exiting.\n";
}
