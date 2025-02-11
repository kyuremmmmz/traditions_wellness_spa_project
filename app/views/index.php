<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traditions Wellness Spa</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.23/dist/full.min.css" rel="stylesheet" type="text/css" />

    <!-- Inter Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="http://localhost/TraditionsWellnessSpa/Project/app/views/js/tailwind.config.js"></script>
</head>

<!-- Content -->

<body class="flex flex-col items-center w-full min-h-screen p-0 m-0 bg-background font-inter tracking-custom leading-custom">
    <button onclick="toggleTheme()" class="bg-primary text-onPrimary dark:bg-darkPrimary dark:text-darkOnPrimary">
        Toggle Theme
    </button><!-- TESTING PURPOSES -->
    <?= $content; ?>
</body>
<script src="http://localhost/TraditionsWellnessSpa/Project/app/views/js/Dom.js"></script>
<script src="http://localhost/TraditionsWellnessSpa/Project/app/views/js/LightModeDarkMode.js"></script>

</html>