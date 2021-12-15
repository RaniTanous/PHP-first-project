<?php


if (
    !empty($_FILES['profile']) &&
    $_FILES['profile']['error'] === UPLOAD_ERR_OK &&
    $_FILES['profile']['size'] <= 1024 * 1024 * 5 &&
    is_uploaded_file($_FILES['profile']['tmp_name'])
) {
    move_uploaded_file($_FILES['profile']['tmp_name'], 'file_upload_tutorial/profile.png');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload Tutorial</title>
</head>

<body>


    <h1>$_FILES</h1>
    <pre><?php var_export($_FILES); ?></pre>
    <br><br>

    <form action="" method="POST" enctype="multipart/form-data">
        <label for="profile">Upload Profile</label>
        <br>
        <input type="file" name="profile" id="profile" siz>
        <br><br>
        <input type="submit" value="submit">
    </form>



    <br><br>

    <h1>last uploaded</h1>

    <pre>
    <?php var_export(pathinfo($_FILES['profile']['name'])); ?>
    </pre>
    <img width="200px" src="file_upload_tutorial/profile.png" />

</body>

</html>