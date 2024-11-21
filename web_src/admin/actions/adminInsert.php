<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Insert</title>
</head>
<?php
    
    session_start();
    if (!(isset($_SESSION["admin_level"]) && $_SESSION["admin_level"] == 2)) header("Location:../user/login.php");
    require_once "../../../data_src/db_functions.php";

    echo "Targeting table " . $_SESSION["consoleTable"];

    try {

        switch ($_SESSION["consoleTable"]) {

            case "Users":
    
                if ($functions->insertInto(array($_GET["email"], $_GET["password"], $_GET["firstName"], $_GET["lastName"], $_GET["level"]), "u")) {
    
                    echo "Successfully inserted data.<br>";
            
                } else echo "Failed to insert data!<br>";

                break;
    
            case "Categories":
    
                if ($functions->insertInto(array($_GET["desc"]), "c")) {
    
                    echo "Successfully inserted data.<br>";
            
                } else echo "Failed to insert data!<br>";

                break;
    
            case "Events":
                
                if ($functions->insertInto(array($_GET["event_name"], $_GET["post_begin"], $_GET["post_end"], $_GET["event_begin"], $_GET["event_end"], $_GET["op_code"]), "e")) {
    
                    echo "Successfully inserted data.";
    
                } else echo "Failed to insert data!";

                break;
    
            default:
    
                echo "Invalid table detected";
                break;
    
        }

    } catch(PDOException $err) {

        echo "Caught!<br>".$err->getMessage();

    }

?>
<body>
    <form action = "../console.php">
        <input type="submit" value = "OK">
    </form>
</body>
</html>