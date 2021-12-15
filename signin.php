<?php

require_once 'app/helpers.php';

session_start();

redirect_unauthorized(true);

$title_page = 'SIGN IN';


$errors = [
    'email' => '',
    'password' => '',
    'submit' => ''
];

if (validate_csrf() && isset($_POST['submit'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    if (!$email) {
        $errors['email'] = '* A valid email is required';
    } elseif (!$password) {
        $errors['password'] = '* Please enter your password';
    } else {
        $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);

        $email = mysqli_real_escape_string($link, $email);
        $password = mysqli_real_escape_string($link, $password);

        $sql = "SELECT u.*, up.profile_image 
         FROM users u
         JOIN users_profile up
         WHERE email='$email' 
         LIMIT 1";
        $result = mysqli_query($link, $sql);

        if ($result && mysqli_num_rows($result) === 1) {
            $user  = mysqli_fetch_assoc($result);

            if (password_verify($password, $user['password'])) {
                login_user($user['id'], $user['name'], $user['profile_image'], './blog.php');
            }
        } else {
            $errors['submit'] = '* Wrong email or password';
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
                    Sign in with your account
                </h1>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro facere tempore beatae doloremque a accusantium recusandae similique quasi, voluptatibus eum?
                </p>
            </div>
        </div>
    </section>

    <!-- PAGE CONTENT -->
    <section class="main-content container mt-5">
        <div class="row">
            <div class="col-12 col-md-6 mt-3 mx-auto">

                <form action="" method="POST" novalidate="novalidate" autocomplete="off">

                    <input type="hidden" name="<?= csrf_name(); ?>" value="<?= csrf(); ?>">

                    <div class="form-group">
                        <label for="email">
                            <span class="text-danger">*</span>
                            Email
                        </label>
                        <input type="email" name="email" id="email" class="form-control">
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

                    <div class="d-flex my-3">
                        <input type="submit" name="submit" value="sign in" class="btn btn-primary">

                        <?= field_error('submit'); ?>
                    </div>

                </form>

            </div>
        </div>
    </section>
</main>

<?php include_once './tpl/footer.php'; ?>