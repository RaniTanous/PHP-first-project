<?php
session_start();

require_once('app/helpers.php');

$title_page = 'ABOUT US';
include_once './tpl/header.php';
?>

<main class="container-fluid flex-fill">
    <!-- PAGE HEADER -->
    <section id="main-top-content">
        <div class="row">
            <div class="col-12 mt-5 text-center">
                <h1 class="display-3 text-primary">
                    About <?= LOGO; ?>
                </h1>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro facere tempore beatae doloremque a accusantium recusandae similique quasi, voluptatibus eum?
                </p>
            </div>
        </div>
    </section>

    <!-- PAGE CONTENT -->
    <section class="main-content container mt-5">
        <!-- ADD YOUR OWN ABOUT PAGE !!!!!!!!!!!!!!!!!!!!!!!!! -->
    </section>
</main>

<?php include_once './tpl/footer.php'; ?>