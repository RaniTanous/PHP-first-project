<?php

require_once 'app/helpers.php';

session_start();

redirect_unauthorized(true);

$title_page = 'SIGN UP';

$errors = [
    'name' => '',
    'email' => '',
    'password' => '',
    'submit' => ''
];

if (validate_csrf() && isset($_POST['submit'])) {
    $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);

    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $name = mysqli_real_escape_string($link, $name);

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = mysqli_real_escape_string($link, $email);

    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $password = mysqli_real_escape_string($link, $password);

    $is_form_valid = true;
    $profile_image  = 'default_profile.png';
    define('MAX_FILE_SIZE', 1024 * 1024 * 5);

    if (!$name || mb_strlen($name) < 2 || mb_strlen($name) > 70) {
        $errors['name'] = '* Name is required for minimum 2 characters and maximum 70';
        $is_form_valid = false;
    }

    if (email_exists($link, $email)) {
        $errors['email'] = '* Email is already taken';
        $is_form_valid = false;
    }

    if (!$password || mb_strlen($password) < 6 || mb_strlen($password) > 20) {
        $errors['password'] = '* Password is required for minimum 6 characters and maximum 20';
        $is_form_valid = false;
    }

    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
    $image = $_FILES['image'] ?? null;

    if (
        $is_form_valid &&
        isset($image) &&
        isset($image['name']) &&
        $image['error'] === UPLOAD_ERR_OK &&
        $image['size'] <= MAX_FILE_SIZE &&
        is_uploaded_file($image['tmp_name']) &&
        in_array(pathinfo($image['name'])['extension'], $allowed)
    ) {
        $profile_image = date('Y.m.d.H.i.s')  . '-' . $image['name'];
        move_uploaded_file($image['tmp_name'], "images/profiles/$profile_image");
    }

    if ($is_form_valid) {
        $password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users(name, email, password) VALUES ('$name', '$email', '$password')";

        $result = mysqli_query($link, $sql);

        if ($result && mysqli_affected_rows($link) === 1) {
            $new_user_id = mysqli_insert_id($link);
            $sql = "INSERT INTO users_profile (user_id, profile_image) VALUES ($new_user_id, '$profile_image')";

            $result = mysqli_query($link, $sql);

            if ($result && mysqli_affected_rows($link) === 1) {
                login_user($new_user_id, $name, $profile_image, './blog.php');
            }
        }
    }
}

include_once './tpl/header.php';
?>

<main class="container-fluid flex-fill">
    <!-- PAGE HEADER -->
    <section id="main-top-content">
        <div class="row">
            <div class="col-12 mt-5 text-center">
                <h1 class="display-3 text-primary">
                    Sign up for a new account
                </h1>
            </div>
        </div>
    </section>

    <!-- PAGE CONTENT -->
    <section class="main-content container mt-5">
        <div class="row">
            <div class="col-12 col-md-6 mt-3 mx-auto">

                <form action="" method="POST" novalidate="novalidate" autocomplete="off" enctype="multipart/form-data">

                    <input type="hidden" name="<?= csrf_name(); ?>" value="<?= csrf(); ?>">

                    <div class="form-group">
                        <label for="name">
                            <span class="text-danger">*</span>
                            Name
                        </label>
                        <input type="text" name="name" id="name" value="<?= old_field_value('name'); ?>" class="form-control">
                        <?= field_error('name'); ?>
                    </div>

                    <div class="form-group mt-3">
                        <label for="email">
                            <span class="text-danger">*</span>
                            Email
                        </label>
                        <input type="email" name="email" id="email" value="<?= old_field_value('email'); ?>" class="form-control">
                        <?= field_error('email'); ?>
                    </div>

                    <div class="form-group mt-3">
                        <label for="password">
                            <span class="text-danger">*</span>
                            Password
                        </label>
                        <input type="password" name="password" id="password" class="form-control">
                        <?= field_error('password'); ?>
                    </div>

                    <div class="form-group mt-3">

                        <div class="mb-3">
                            <label for="image" class="form-label">
                                Profile Image
                            </label>
                            <input type="file" class="form-control" name="image" id="image">
                        </div>
                    </div>

                    <div class="d-flex my-3">
                        <input type="submit" name="submit" value="Sign Up" class="btn btn-primary">

                        <?= field_error('submit'); ?>
                    </div>

                </form>

            </div>
        </div>
    </section>
</main>

<?php include_once './tpl/footer.php'; ?>