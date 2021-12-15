<?php
function clear_table($link)
{
    if (isset($_GET['clear'])) {
        mysqli_query($link, 'TRUNCATE categories');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MySQLi</title>
</head>

<body>

    <p>
        by clicking this link the table will be cleared with truncate query.<br>
        be aware it sets a url query parameter 'clear' be sure to remove it in case you would like to add more than 1 row.<br>
        every refresh without this query parameter a new record is inserted. <br>
        <a href="./db_example.php?clear">RESET TABLE</a>
    </p>
    <br><br>


    <?php
    define('HOST', 'localhost');
    define('USER', 'root');
    define('PW', '');
    define('DB', 'eshop');

    $db = mysqli_connect(HOST, USER, PW, DB);
    if (!$db) :
        echo '<br>could not connect to db<br>';
        var_dump($db); // $link is false in case error in connection occurred
    else :

        clear_table($db);
    ?>
        <br>connected to db<br><br>

        <details>
            <summary>INSERT EXAMPLE</summary>
            <h1>INSERT Example</h1><br>
            <pre>
                  <?php
                    // // for queries which are not SELECT, SHOW and DESCRIBE will return true on success false on failure
                    $result = mysqli_query($db, "INSERT INTO categories (name, machine_name) VALUES ('test', 'test')");
                    // $result = mysqli_query($db, "INSERT INTO categories (name, machine_name) VALUES 'test', 'test'"); /// enable for a syntax error
                    echo '<br>result: ';
                    var_dump($result);
                    echo 'error: ';
                    var_dump(mysqli_error($db)); //returns error for last command
                    ?>
            </pre>
        </details>

        <details>
            <summary>SELECT EXAMPLE</summary>
            <h1>SELECT Example</h1><br>
            <pre>

                <?php
                $result = mysqli_query($db, 'SELECT * FROM categories');
                // $result = mysqli_query($db, 'SELECT * FFROM categories'); // enable for a syntax error
                echo '<br>result: ';
                var_dump($result);
                echo 'error: ';
                var_dump(mysqli_error($db)); //returns error for last command
                ?>
            </pre>
        </details>


        <details>
            <summary>MYSQLi Result Class</summary>
            <h1>MySQLi Result object</h1><br>

            <pre>
               <?php
                echo '<br>mysqli_num_rows: ';
                var_dump(mysqli_num_rows($result));
                ?>
            </pre>

            <details>
                <summary>mysqli_fetch_all</summary>
                <h2>mysqli_fetch_all</h2><br>
                <pre>
                    <?php

                    echo '<br><h3>MYSQLI_NUM</h3><br>';
                    $result = mysqli_query($db, 'SELECT * FROM categories');
                    var_export(mysqli_fetch_all($result, MYSQLI_NUM));

                    echo '<h3>MYSQLI_ASSOC</h3><br>';
                    $result = mysqli_query($db, 'SELECT * FROM categories');
                    var_export(mysqli_fetch_all($result, MYSQLI_ASSOC));

                    echo '<h3>MYSQLI_BOTH</h3><br>';
                    $result = mysqli_query($db, 'SELECT * FROM categories');
                    var_export(mysqli_fetch_all($result, MYSQLI_BOTH));
                    ?>
                </pre>
            </details>


            <h2>Retrieve row by row</h2>
            <details>
                <summary>mysqli_fetch_object</summary>
                <pre>
                    <?php
                    $result = mysqli_query($db, 'SELECT * FROM categories');

                    echo '<h3>mysqli_fetch_object</h3>';
                    echo 'record 1:<br>';
                    var_export(mysqli_fetch_object($result));
                    echo '<br>record 2 :<br>';
                    var_export(mysqli_fetch_object($result));
                    echo '<br>record 3:<br>';
                    var_export(mysqli_fetch_object($result));
                    echo '<br>record 4 :<br>';
                    var_export(mysqli_fetch_object($result));
                    echo '<br>record 5:<br>';
                    var_export(mysqli_fetch_object($result));
                    echo '<br>record 6 :<br>';
                    var_export(mysqli_fetch_object($result));
                    echo '<br>record 7:<br>';
                    var_export(mysqli_fetch_object($result));
                    echo '<br>record 8 :<br>';
                    var_export(mysqli_fetch_object($result));
                    echo '<br>record 9:<br>';
                    var_export(mysqli_fetch_object($result));
                    ?>
                </pre>
            </details>
            <details>
                <summary>mysqli_fetch_assoc</summary>
                <pre>
                    <?php
                    $result = mysqli_query($db, 'SELECT * FROM categories');

                    echo '<h3>mysqli_fetch_assoc</h3>';
                    echo 'record 1:<br>';
                    var_export(mysqli_fetch_assoc($result));
                    echo '<br>record 2 :<br>';
                    var_export(mysqli_fetch_assoc($result));
                    echo '<br>record 3:<br>';
                    var_export(mysqli_fetch_assoc($result));
                    echo '<br>record 4 :<br>';
                    var_export(mysqli_fetch_assoc($result));
                    echo '<br>record 5:<br>';
                    var_export(mysqli_fetch_assoc($result));
                    echo '<br>record 6 :<br>';
                    var_export(mysqli_fetch_assoc($result));
                    echo '<br>record 7:<br>';
                    var_export(mysqli_fetch_assoc($result));
                    echo '<br>record 8 :<br>';
                    var_export(mysqli_fetch_assoc($result));
                    echo '<br>record 9:<br>';
                    var_export(mysqli_fetch_assoc($result));
                    ?>
                </pre>
            </details>
            <details>
                <summary>mysqli_fetch_array</summary>
                <pre>
                    <?php
                    $result = mysqli_query($db, 'SELECT * FROM categories');

                    echo '<h3>mysqli_fetch_array</h3>';
                    echo 'record 1:<br>';
                    var_export(mysqli_fetch_array($result));
                    echo '<br>record 2 :<br>';
                    var_export(mysqli_fetch_array($result));
                    echo '<br>record 3:<br>';
                    var_export(mysqli_fetch_array($result));
                    echo '<br>record 4 :<br>';
                    var_export(mysqli_fetch_array($result));
                    echo '<br>record 5:<br>';
                    var_export(mysqli_fetch_array($result));
                    echo '<br>record 6 :<br>';
                    var_export(mysqli_fetch_array($result));
                    echo '<br>record 7:<br>';
                    var_export(mysqli_fetch_array($result));
                    echo '<br>record 8 :<br>';
                    var_export(mysqli_fetch_array($result));
                    echo '<br>record 9:<br>';
                    var_export(mysqli_fetch_array($result));
                    ?>
                </pre>
            </details>

            <details>
                <summary>using fetch with while</summary>
                <pre>
                    <?php
                    $result = mysqli_query($db, 'SELECT * FROM categories');

                    $i = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<br>record ' . ++$i . ':<br>';
                        var_export($row);
                    }
                    ?>
                </pre>
            </details>
        </details>

    <?php endif; ?>
    </pre>
</body>

</html>