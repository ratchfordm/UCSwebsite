<?php

    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    // Note that including db_config is unnecessary; db_functions does that itself
    require_once "../../data_src/db_functions.php";

    // SELECT
    // Simply send a statement. You must paramaterize the query yourself!

    echo "SELECT<br><br>";

    $sql = "SELECT * FROM categories";
    $data = $queryDB($sql);
    print_r($data);

    // INSERT
    // Send a basic array of values that correspond to the table's columns
    // Note that because of unique constraints on various tables insert might fail if you don't come up w/ new info

    echo "<br><br>INSERT<br><br>";

    $insertInto(["email", "password", "first name", "last name", 0], "u"); // into users
    $insertInto(["very epic category"], "c"); // into categories
    // $insertInto([], "e"); // into events NOTE YET WORKING
    // $insertInto([1234567890000, "title", "author", 1.00, 2012, 100, 0], "i"); // into items NOT YET WORKING

?>