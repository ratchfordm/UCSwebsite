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

    switch ($_SESSION["consoleTable"]) {

        case "Users":

            $table = 'u';
            break;

        case "Categories":

            $table = 'c';
            break;

        case "Events":

            $table = 'e';
            break;

        case "Items":

            $table = 'i';
            break;

        default:

            $table = '!';
            echo "Invalid table detected.";
            break;

    }

    if ($table != '!') {

        $worked = $functions->deleteFrom($_GET["deleteID"], $table);
        if ($worked) echo "Deleted <b>" . $_GET["deleteID"] . "</b> from <b>" . $_SESSION["consoleTable"] . "</b> (if that ID existed).";

    }

?>
<body>
    <br><br>
    <form action = "../console.php">
        <input type="submit" value = "OK">
    </form>
</body>
</html>