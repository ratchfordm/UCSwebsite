
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

        switch ($_SESSION["consoleTable"]) {

            case "Users":

                break;
            
            case "Categories":

                break;

            case "Events":

                break;

            case "Items":

                break;

            default:

                echo "Invalid table detected";
                break;

        }

    } catch(PDOException $err) {

        echo "Caught!" . $err.getMessage();

    }

?>
<body>
    <form action = "../console.php">
        <input type="submit" value = "OK">
    </form>
</body>
</html>