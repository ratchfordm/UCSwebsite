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
    require_once "../../../data_src/db_functions.php";

    try {

        $responses = [];

        switch ($_SESSION["consoleTable"]) {

            case "Users":
                
                if (is_numeric($_GET["term"])) {
                    
                    $cols = ["user_id", "admin_level"];
                    foreach ($cols as $col) {

                        $sql = $functions->getDB()->prepare("SELECT * FROM users WHERE $col = :term;");
                        $sql->bindParam(":term", $_GET["term"], PDO::PARAM_INT);
                        $sql->execute();
                        $response = $sql->fetchAll();
                        array_push($responses, $response);

                    }

                } else if (gettype($_GET["term"]) === "string") {

                    $term = '%' . $_GET["term"] . '%';
                    $cols = ["user_email", "user_password", "first_name", "last_name"];
                    foreach ($cols as $col) {

                        $sql = $functions->getDB()->prepare("SELECT * FROM users WHERE $col LIKE :term;");
                        $sql->bindParam(":term", $term, PDO::PARAM_STR);
                        $sql->execute();
                        $response = $sql->fetchAll();
                        array_push($responses, $response);

                    }

                } else {

                    echo "Invalid search parameter.";
                    exit();

                }

                print_r($responses);
                break;
            
            case "Categories":

                if (is_numeric($_GET["term"])) {

                    $sql = $functions->getDB()->prepare("SELECT * FROM categories WHERE category_id = :term;");
                    $sql->bindParam(":term", $_GET["term"], PDO::PARAM_INT);
                    $sql->execute();
                    $response = $sql->fetchAll();
                    array_push($responses, $response);

                } else if (gettype($_GET["term"]) === "string") {

                    $term = '%' . $_GET["term"] . '%';
                    $sql = $functions->getDB()->prepare("SELECT * FROM categories WHERE category_description LIKE :term;");
                    $sql->bindParam(":term", $term, PDO::PARAM_STR);
                    $sql->execute();
                    $response = $sql->fetchAll();
                    array_push($responses, $response);

                } else {

                    echo "Invalid search parameter.";
                    exit();

                }

                print_r($responses);
                break;

            case "Events":
                echo "events";
                if (is_numeric($_GET["term"])) {

                    $sql = $functions->getDB()->prepare("SELECT * FROM events WHERE event_id = :term;");
                    $sql->bindParam(":term", $_GET["term"], PDO::PARAM_INT);
                    $sql->execute();
                    $response = $sql->fetchAll();
                    array_push($responses, $response);

                } else if (gettype($_GET["term"]) === "string") {

                    $cols = ["event_name", "operator_code"];
                    foreach ($cols as $col) {

                        $term = '%' . $_GET["term"] . '%';
                        $sql = $functions->getDB()->prepare("SELECT * FROM events WHERE $col LIKE :term;");
                        $sql->bindParam(":term", $term, PDO::PARAM_STR);
                        $sql->execute();
                        $response = $sql->fetchAll();
                        array_push($responses, $response);

                    }

                } else {

                    echo "Invalid search parameter.";
                    exit();

                }

                print_r($responses);
                break;

            case "Items":

                if (is_numeric($_GET["term"])) {
                    
                    $cols = ["item_id", "user_id", "category_id", "event_id", "ISBN", "price", "year_published"];
                    foreach ($cols as $col) {

                        $sql = $functions->getDB()->prepare("SELECT * FROM items WHERE $col = :term;");
                        $sql->bindParam(":term", $_GET["term"], PDO::PARAM_INT);
                        $sql->execute();
                        $response = $sql->fetchAll();
                        array_push($responses, $response);

                    }

                } else if (gettype($_GET["term"]) === "string") {
                    
                    $cols = ["title", "author"];
                    foreach ($cols as $col) {
                        
                        $term = '%' . $_GET["term"] . '%';
                        $sql = $functions->getDB()->prepare("SELECT * FROM items WHERE $col LIKE :term;");
                        $sql->bindParam(":term", $term, PDO::PARAM_STR);
                        $sql->execute();
                        $response = $sql->fetchAll();
                        array_push($responses, $response);

                    }

                } else {

                    echo "Invalid search parameter.";
                    exit();

                }
                
                print_r($responses);
                break;

            default:

                echo "Invalid table detected";
                break;

        }

    } catch(PDOException $err) {

        echo "Caught!<br>";
        print_r($err->errorInfo);

    }

?>
<body>
    <br>
    <form action = "../console.php">
        <input type="submit" value = "OK">
    </form>
</body>
</html>