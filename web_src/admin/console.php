<?php

    require_once("../../data_src/db_functions.php");
    session_start();
    
    if (!(isset($_SESSION["admin_level"]) && $_SESSION["admin_level"] == 2)) header("Location:../user/login.php");

    if (array_key_exists("usersButton", $_POST)) $activeTable = "Users";
    else if (array_key_exists("categoriesButton", $_POST)) $activeTable = "Categories";
    else if (array_key_exists("eventsButton", $_POST)) $activeTable = "Events";
    else if (array_key_exists("itemsButton", $_POST)) $activeTable = "Items";
    else $activeTable = "None";

    $_SESSION["consoleTable"] = $activeTable;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .console_select {

            cursor: pointer;

        }
        .console_collap {

            background-color: #777;
            color: white;
            cursor: pointer;
            padding: 18px;
            width: 100%;
            border: none;
            text-align: left;
            outline: none;
            font-size: 15px;

        }
        .active, .collapsible:hover {

            background-color: #555;

        }
        .admin_view, .admin_insert, .admin_update, .admin_delete {

            padding: 0 18px;
            background-color: white;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.2s ease-out;

        }
    </style>
    <title>Admin</title>
</head>
<body>
    <h2>Welcome to the Admin Console!</h2>
    <form method = "post">
        <input type = "submit" name = "usersButton" id = "usersButton" class = "button" value = "Users">
        <input type = "submit" name = "categoriesButton" id = "categoriesButton" class = "button" value = "Categories">
        <input type = "submit" name = "eventsButton" id = "eventsButton" class = "button" value = "Events">
        <input type = "submit" name = "itemsButton" id = "itemsButton" class = "button" value = "Items">
    </form>
    <br><p>
    <?php

        if ($activeTable == "None") {

            echo "Please select a table.
            <form action='../user/logout.php'>
                <input type = 'submit' value = 'Log Out'>
            </form>";
            exit();

        } else echo "Active table: $activeTable";

    ?></p>
    <button type='button' class='console_collap'>Search</button>
    <div class='admin_view'>
        <br>
        <form action = "actions/adminSearch.php">
            <input type = "text" name = "term" id = "term">
            <input type = "submit" name = "search" id = "search" class = "button" value = "Search">
        </form>
        <p>Search <?php echo $activeTable; ?> for a record.</p>
    </div>
    <button type='button' class='console_collap'>Insert</button>
    <div class='admin_insert'>
        <br>
        <?php

            switch ($activeTable) {

                case "Users":

                    echo "<form action = 'actions/adminInsert.php'>
                        <input type = 'email' name = 'email' id = 'email' label = 'Email'><br>
                        <input type = 'text' name = 'password' id = 'password' label = 'Password'><br>
                        <input type = 'text' name = 'firstName' id = 'firstName' label = 'First Name'><br>
                        <input type = 'text' name = 'lastName' id = 'lastName' label = 'Last Name'><br>
                        <input type = 'range' name = 'level' id = 'level' max = 2 min = 0 step = 1 value = 0 label = 'Admin Level'><br>
                        <input type = 'submit' value = 'Insert'><br>
                    </form>";
                    break;

                case "Categories":

                    echo "<form action = 'actions/adminInsert.php'>
                        <input type = 'text' name = 'desc' id = 'desc'><br>
                        <input type = 'submit' value = 'Insert'><br>
                    </form>";
                    break;

                case "Events":

                    echo "<form action = 'actions/adminInsert.php'>
                        <input type = 'text' name = 'event_name' id = 'event_name'><br>
                        <input type = 'date' name = 'post_begin' id = 'post_begin'><br>
                        <input type = 'date' name = 'post_end' id = 'post_end'><br>
                        <input type = 'date' name = 'event_begin' id = 'event_begin'><br>
                        <input type = 'date' name = 'event_end' id = 'event_end'><br>
                        <input type = 'text' name = 'op_code' id = 'op_code'><br>
                        <input type = 'submit' value = 'Insert'><br>
                    </form>";
                    break;

                case "Items":

                    echo "<p>Please insert items here:<p>
                        <a href = '../../web_src/user/addItem.php'>Add Item</a>";
                    break;

            }

        ?><br>
    </div>
    <button type='button' class='console_collap'>Update </button>
    <div class='admin_update'>
        <p>Select a table, an ID, and an updated piece of information.</p>
    </div>
    <button type='button' class='console_collap'>Delete</button>
    <div class='admin_delete'>
        <p>Select a table and a record to remove.</p>
    </div><br>
    <form action='../user/logout.php'>
        <input type = 'submit' value = 'Log Out'>
    </form>
    <script>

        var coll = document.getElementsByClassName('console_collap');

        for (var i = 0; i < coll.length; i++) {

            coll[i].addEventListener('click', function() {

                var buttons = document.getElementsByClassName('console_collap');

                for (var i = 0; i < buttons.length; i++) {

                    if (buttons[i] == this) continue;
                    buttons[i].classList.remove("active");
                    var contents = buttons[i].nextElementSibling;
                    contents.style.maxHeight = null;

                }

                this.classList.toggle('active');
                var contents = this.nextElementSibling;

                if (contents.style.maxHeight) contents.style.maxHeight = null;
                else contents.style.maxHeight = contents.scrollHeight + "px";

            });

        }

    </script>
</body>
</html>