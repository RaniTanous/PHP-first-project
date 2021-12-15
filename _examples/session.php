<?php session_start(); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session Tutorial</title>
</head>

<body>

    <pre>

    <?php var_export($_SESSION); ?>
</pre>

    <?php
    // create / update
    $_SESSION['id'] = 555;
    $_SESSION['name'] = 'daniel';
    $_SESSION['age'] = 26;
    $_SESSION['email'] = 'daniel@gmail.com';
    $_SESSION['isActive'] = true;

    // delete
    unset($_SESSION['id']);


    //destroy session 
    session_destroy();
    setcookie(
        session_name(),
        '',
        time() - 1,
        ini_get('session.cookie_path')
    );

    ?>

</body>

</html>