<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/views/php/components/Component.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/views/php/components/assets/Logo.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="/app/views/css/global.css">
    <link rel="stylesheet" href="/app/views/css/password-input.css">
    <link rel="stylesheet" href="/app/views/css/logo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"> <!-- FontAwesome -->
</head>
<body>

    <div class="form-container">
        <?php 
            Logo::render(); 
        ?>

    <h2 style="text-align: center;">Login to your account</h2>

    <div class="form-container">
        <?php 
            Component::inputField("text", "username", "Username");
            Component::passwordField("password", "Password");
        ?>
    </div>

    <script src="/app/views/js/password-input.js"></script>

</body>
</html>
