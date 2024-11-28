<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Search</title>
</head>
<?php

    session_start();
    if (!(isset($_SESSION["admin_level"]) && $_SESSION["admin_level"] == 2)) header("Location:../user/login.php");

    if (!(gettype($_GET["term"]) === "string") || strlen($_GET["term"]) == 0) echo "Invalid search term!";
    else {

        require_once "../../../data_src/db_functions.php";

        $responses = [];

        $cols = ["posting_begin_date", "posting_end_date", "event_begin_date", "event_end_date"];
        foreach ($cols as $col) {

            $term = '%' . $_GET["term"] . '%';
            $sql = $functions->getDB()->prepare("SELECT * FROM events WHERE $col LIKE :term;");
            $sql->bindParam(":term", $term, PDO::PARAM_STR);
            $sql->execute();
            $response = $sql->fetchAll();
            array_push($responses, $response);

        }

        print_r($responses);

    }

?>
<body>
    <br><br>
    <form action = "../console.php">
        <input type="submit" value = "OK">
    </form>
</body>
</html>