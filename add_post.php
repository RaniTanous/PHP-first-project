<?php

require_once 'app/helpers.php';
session_start();

redirect_unauthorized(false, './signin.php');

$errors = [
    'title' => '',
    'article' => ''
];


if (validate_csrf() && isset($_POST['submit'])) {
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $article = filter_input(INPUT_POST, 'article', FILTER_SANITIZE_STRING);

    $is_form_valid = true;

    if (!$title || mb_strlen($title) <= 2) {
        $is_form_valid = false;
        $errors['title'] = '* Title is required for minimum of 2 characters';
    }
    if (!$article || mb_strlen($article) <= 2) {
        $is_form_valid = false;
        $errors['article'] = '* Article is required for minimum of 2 characters';
    }

    if ($is_form_valid) {
        $uid = $_SESSION['user_id'];

        $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);

        $title = mysqli_real_escape_string($link, $title);
        $article = mysqli_real_escape_string($link, $article);

        $sql = "INSERT INTO posts(user_id, title, article, created_at) VALUES('$uid', '$title', '$article', NOW())";
        $result = mysqli_query($link, $sql);


        if ($result && mysqli_affected_rows($link) === 1) {
            header('location: ./blog.php');
            exit();
        }
    }
}

$title_page = 'HOME';
include_once './tpl/header.php';


?>

<main class="container-fluid flex-fill">
    <!-- PAGE HEADER -->
    <section id="main-top-content">
        <div class="row">
            <div class="col-12 mt-5 text-center">
                <h1 class="display-3 text-primary">
                    Add a New Post
                </h1>

            </div>
        </div>
    </section>

    <!-- PAGE CONTENT -->
    <section class="main-content container mt-5">
        <div class="row">
            <div class="col-md-6">
                <form action="" method="POST" novalidate="novalidate" autocomplete="off">

                    <input type="hidden" name="<?= csrf_name(); ?>" value="<?= csrf(); ?>">

                    <div class="form-group">
                        <label for="title">
                            <span class="text-danger">*</span> Title
                        </label>
                        <input type="text" id="title" name="title" value="<?= old_field_value('title'); ?>" class="form-control">
                        <?= field_error('title'); ?>
                    </div>

                    <div class="form-group mt-3">
                        <label for="article">
                            <span class="text-danger">*</span> Article
                        </label>
                        <textarea type="text" id="article" name="article" col="30" rows="10" class="form-control"><?= old_field_value('article'); ?></textarea>
                        <?= field_error('article'); ?>
                    </div>

                    <div class="d-flex my-3">
                        <input type="submit" name="submit" value="Save Post" class="btn btn-primary">

                        <a href="./blog.php" class="btn btn-secondary ms-2">Cancel</a>
                    </div>

                </form>
            </div>
        </div>
    </section>
</main>

<?php include_once './tpl/footer.php'; ?>