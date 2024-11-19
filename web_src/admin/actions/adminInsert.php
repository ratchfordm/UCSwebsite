<?php
    
    session_start();
    require_once "../../../data_src/db_functions.php";

    switch ($_SESSION["consoleTable"]) {

        case "Users":

            if ($functions->insertInto(array($_GET["email"], $_GET["password"], $_GET["firstName"], $_GET["lastName"], $_GET["level"]), "u")) {

                echo "Successfully inserted data.<br>";
        
            } else echo "Failed to insert data!<br>";

        case "Categories":

            if ($functions->insertInto(array($_GET["desc"]), "c")) {

                echo "Successfully inserted data.<br>";
        
            } else echo "Failed to insert data!<br>";

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Insert</title>
</head>
<body>
    <form action = "../console.php">
        <input type="submit" value = "OK">
    </form>
</body>
</html>