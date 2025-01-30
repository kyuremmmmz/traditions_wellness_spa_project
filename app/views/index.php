<?php

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
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.23/dist/full.min.css" rel="stylesheet" type="text/css" />
    <title>Traditions Wellness Spa</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0F172A',
                        secondary: '#2d3748',
                    },
                },
            },
        };
    </script>
</head>

<body id="theme" class="flex flex-col items-center justify-center w-full min-h-screen text-white bg-secondary">
    <button class="py-20" onclick="themeHandler()" type="button">press</button>
    <div class="w-full">
        <?php
        Header::render('flex flex-row items-center gap-2 bg-primary py-4 px-8 w-full h-[60px]');
        ?>
        <div class="h-screen ">
            <?= $content; ?>
        </div>
        <?php
        Footer::handle();
        ?>
    </div>
</body>
<script>
function themeHandler() {  
        const themeElement = document.getElementById("theme");
        themeElement.classList.toggle("bg-secondary");
        themeElement.classList.toggle("bg-white");
        themeElement.classList.toggle("text-black");
    }

</script>
</html>