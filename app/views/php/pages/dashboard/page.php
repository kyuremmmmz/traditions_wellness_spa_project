<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    Hello <?php echo $_SESSION['user']['first_name']; ?> <?php echo $_SESSION['user']['last_name']; ?>
    <form action="/logout" method="post">
        <button type="submit">Logout puta</button>
    </form>
</body>

</html>