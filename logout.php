<?php

require_once 'app/helpers.php';
session_start();

redirect_unauthorized();


session_destroy();
setcookie(
    session_name(),
    '',
    time() - 1,
    ini_get('session.cookie_path')
);

header('location: ./');
