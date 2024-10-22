<?php

    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    // Note that including db_config is unnecessary; db_functions does that itself
    require_once "../../data_src/db_functions.php";

    // SELECT
    // Simply send a statement. You must paramaterize the query yourself!

    echo "SELECT<br><br>";

    $sql = "SELECT * FROM users";
    $data = $queryDB($sql);
    print_r($data);

    // INSERT
    // Send a basic array of values that correspond to the table's columns

    echo "<br><br>INSERT<br><br>";
    $insertInto(["inserted@garbage.net", "one billion eggs", "garrison", "de france", 0], "u");

?>