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

        echo "idk if everything on console.php works yet, so i have this turned off :)";
        // $worked = $functions->updateTable($_GET["updateID"], $_GET["updateCol"], $_GET["updateVal"], $table);
        // if ($worked) echo "Set the value of <b>" . $_GET["updateCol"] . "</b> to <b>" . $_GET["updateVal"] . "</b> for <b>" . $_SESSION["consoleTable"] . "</b> ID number <b>" . $_GET["updateID"] . "</b>.";

    }

?>
<body>
    <br><br>
    <form action = "../console.php">
        <input type="submit" value = "OK">
    </form>
</body>
</html>