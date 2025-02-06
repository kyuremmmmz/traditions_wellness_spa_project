<?php

$baseDir = __DIR__ . '/app/views/php/pages';
$routesFile = __DIR__ . '/public/index.php';

// Ensure the base directory exists
if (!is_dir($baseDir)) {
    mkdir($baseDir, 0755, true);
}

echo "Enter the page name (e.g., login, register, dashboard): ";
$pageName = trim(fgets(STDIN));

$folderPath = $baseDir . "/$pageName";
$pageFile = $folderPath . "/page.php";


if (!is_dir($folderPath)) {
    mkdir($folderPath, 0755, true);
    echo "✅ Folder created: $folderPath\n";
} else {
    echo "ℹ️ Folder already exists: $folderPath\n";
}


$template = <<<PHP
<?php
class Page {
    public static function page() {
        ?>
        <div>
            <h1>$pageName Page</h1>
        </div>
        <?php
    }
}
PHP;


if (!file_exists($pageFile)) {
    file_put_contents($pageFile, $template);
    echo "✅ Page created: $pageFile\n";
} else {
    echo "ℹ️ Page already exists: $pageFile\n";
}


$routeEntry = "\$router->view('/$pageName', 'page', '$pageName');\n";


file_put_contents($routesFile, $routeEntry, FILE_APPEND);
echo "✅ Route added: /$pageName -> page/$pageName\n";


echo "🚀 Page and route successfully created!\n";
