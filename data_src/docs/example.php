<?php

    // Note that including db_config is unnecessary; db_functions does that itself
    require_once "../../data_src/db_functions.php";

    // SELECT (or literally anything else)
    // Simply send a statement. You must paramaterize the query yourself!

    echo "SELECT<br><br>";

    $sql = "SELECT * FROM categories";
    $data = $functions->queryDB($sql);
    print_r($data);

    // INSERT
    // Send a basic array of values that correspond to a table's columns
    // Note that because of unique constraints on various tables insert might fail if you don't come up w/ new info

    echo "<br><br>INSERT<br><i>(Un)comment lines in the code to test this.";

    // $functions->insertInto(["email", "password", "first name", "last name", 0], "u"); // into users
    // $functions->insertInto(["fire category"], "c"); // into categories
    // $functions->insertInto(["gang time", "2024-10-24 08:00:00", "2024-10-27 17:00:00", "2024-10-28 07:00:00", "2024-11-2 19:00:00", "mcgovern"], "e"); // into events
    // $functions->insertInto([3, 0, 1, 1234567890000, "title", "author", 1.00, 2012, True], "i"); // into items

    // DELETE
    // Send a column and a condition to a table

    echo "<br><br>DELETE<br><i>(Un)comment lines in the code to test this.";

    // $functions->deleteFrom("items", 19);

    echo "<br><br>UPDATE<br><i>(Un)comment lines in the code to test this.";

    // $functions->updateTable(0, "category_description", "when the category :crying:", "categories");

?>