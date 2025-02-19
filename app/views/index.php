<?php
?>

<!DOCTYPE html>
<html lang="en" class="bg-background dark:bg-darkBackground">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traditions Wellness Spa</title>

    <!-- Favicon -->

    <!-- Inter Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="http://192.168.0.3/TraditionsWellnessSpa/Project/app/views/js/tailwind.config.js"></script>
    <script src="http://192.168.0.3/TraditionsWellnessSpa/Project/app/views/js/hooks/LightModeDarkMode.js"></script>
    <script src="http://192.168.0.3/TraditionsWellnessSpa/Project/app/views/js/hooks/ContinueRegDom.js"></script>
    <script src="http://192.168.0.3/TraditionsWellnessSpa/Project/app/views/js/hooks/ServicesDom.js"></script>
    <script src="http://192.168.0.3/TraditionsWellnessSpa/Project/app/views/js/Services/FetchApiData.js"></script>

</head>

<!-- Content -->

<body class="flex flex-col items-center w-full min-h-screen p-0 m-0 bg-background dark:bg-darkBackground font-inter tracking-custom leading-custom">
    <!--<button onclick="toggleTheme()" class="bg-primary text-onPrimary dark:bg-darkPrimary dark:text-darkOnPrimary">
        Toggle Theme
    </button>--><!-- TESTING PURPOSES -->
    <?= $content; ?>
</body>

</html>