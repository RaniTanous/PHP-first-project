<?php
require_once 'db_config.php';




if (!function_exists('old_field_value')) {

    /**
     * Returns last input value of a field
     * 
     * @param string $field_name The field name
     * @return string The input's last value or an empty string
     */
    function old_field_value($field_name)
    {
        return isset($_REQUEST[$field_name]) ? $_REQUEST[$field_name] : '';
    }
}


if (!function_exists('field_error')) {

    $errors = [];

    /**
     * get the error message by a $field_name. 
     * be aware to add $errors array with field's error messages.
     * 
     * @param string $field_name the field's name
     * @return string the error in a span or an empty string
     */
    function field_error($field_name)
    {

        global $errors;

        if (isset($errors) && !empty($errors[$field_name])) {
            return '<span class="text-danger">' . $errors[$field_name] . '</span>';
        }

        return '';
    }
}

if (!function_exists('email_exists')) {

    function email_exists($link, $email)
    {
        $email = mysqli_real_escape_string($link, $email);
        $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
        $result = mysqli_query($link, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            return true;
        }

        return false;
    }
}

if (!function_exists('csrf')) {

    /**
     * Generate random string for csrf security
     */
    function csrf()
    {
        $token = sha1(rand(1, 100000) . '$$' . rand(1, 10000) . 'icar');
        $_SESSION[csrf_name()] = $token;

        return $token;
    }
}

if (!function_exists('validate_csrf')) {
    function validate_csrf()
    {
        if (isset($_REQUEST[csrf_name()]) && isset($_SESSION[csrf_name()])) {
            return $_SESSION[csrf_name()] === $_REQUEST[csrf_name()];
        }

        return false;
    }
}


if (!function_exists('csrf_name')) {
    function csrf_name()
    {
        return 'csrf_token';
    }
}



if (!function_exists('login_user')) {
    function login_user($id, $name, $profile_image, $location)
    {
        $_SESSION['user_id'] = $id;
        $_SESSION['user_name'] = $name;

        // digital fingerprint
        $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
        $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];

        if (isset($profile_image)) {
            $_SESSION['profile_image'] = $profile_image;
        }

        if (isset($location)) {
            header("location: $location");
            exit();
        }
    }
}

if (!function_exists('user_auth')) {
    function user_auth()
    {
        if (
            isset($_SESSION['user_id']) &&
            isset($_SESSION['user_ip']) &&
            $_SESSION['user_ip'] === $_SERVER['REMOTE_ADDR'] &&
            isset($_SESSION['user_agent']) &&
            $_SESSION['user_agent'] === $_SERVER['HTTP_USER_AGENT']
        ) {
            return true;
        }

        return false;
    }
}


if (!function_exists('redirect_unauthorized')) {

    /**
     * Redirects user to a specific location if is logged or not logged in
     * After redirection exists the program.
     * 
     * @param bool $redirect_if_is_logged if true redirects logged out users, if false redirects logged in users
     * @param string $location where to redirect the user in case condition is true
     */
    function redirect_unauthorized($redirect_if_is_logged = false, $location = './')
    {
        if ($redirect_if_is_logged && user_auth()) {
            header("location: $location");
            exit();
        }

        if (!$redirect_if_is_logged  && !user_auth()) {
            header("location: $location");
            exit();
        }
    }
}
