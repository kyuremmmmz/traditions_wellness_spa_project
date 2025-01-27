<?php

use Project\App\Views\Php\Components\Button\GlobalButton;
use Project\App\Views\Php\Components\Footer;
use Project\App\Views\Php\Components\Header;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>Traditions Wellness Spa</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1a202c',
                        secondary: '#2d3748',
                    },
                },
            },
        };
    </script>
</head>

<body>
    <div class=" w-full h-screen">
        <?php
        Header::render();
        ?>
        <div class="h-screen">
            <?= $content; ?>
        </div>
        <?php
        Footer::handle();
        ?>
    </div>
</body>

</html>