<?php

use Project\App\Views\Php\Components\Footer;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>Traditions Wellness Spa</title>
</head>

<body>
    <?= $content; ?>
    <?php
    Footer::handle();
    ?>
</body>

</html>