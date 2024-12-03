<!DOCTYPE html>
<html lang="en">
<head>
    <link href='../css/global.css' rel='stylesheet'>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .tables {

            background-color: white;

        }
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
            text-align: center;
            outline: none;
            font-size: 15px;

        }
        .active, .collapsible:hover {

            background-color: #555;

        }
        .admin_view, .admin_insert, .admin_update, .admin_delete {

            padding: 0 18px;
            background-color: lightblue;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.2s ease-out;

        }
    </style>
    <title>UCS Console</title>
</head>
<noscript>
    <style>
        .page {display: none;}
    </style>
    <div class = "nojsmsg">
        <p>The console requires Javascript to function.<br>I assure you there's no spyware (at least that I know of).</p>
    </div>
</noscript>
<?php

    //session_start();
    //if (!(isset($_SESSION["admin_level"]) && $_SESSION["admin_level"] == 2)) header("Location:../user/login.php");
    require_once("../user/navbar.php");
    require_once("../../data_src/db_functions.php");

    if (array_key_exists("usersButton", $_POST)) $activeTable = "Users";
    else if (array_key_exists("categoriesButton", $_POST)) $activeTable = "Categories";
    else if (array_key_exists("eventsButton", $_POST)) $activeTable = "Events";
    else if (array_key_exists("itemsButton", $_POST)) $activeTable = "Items";
    else {

        if (array_key_exists("consoleTable", $_SESSION)) {

            switch ($_SESSION["consoleTable"]) {

                case "Users":
                case "Categories":
                case "Events":
                case "Items":
    
                    $activeTable = $_SESSION["consoleTable"];
                    break;
    
                default:
    
                    $activeTable = "None";
                    break;
    
            }

        } else $activeTable = "None";

    }

    $_SESSION["consoleTable"] = $activeTable;

?>
<body>
    <div class = "page">
    <h2>Welcome to the Admin Console!</h2>
    <br><br>
    <div class = "tables">
    <form method = "post">
        <input type = "submit" name = "usersButton" id = "usersButton" class = "button" value = "Users">
        <input type = "submit" name = "categoriesButton" id = "categoriesButton" class = "button" value = "Categories">
        <input type = "submit" name = "eventsButton" id = "eventsButton" class = "button" value = "Events">
        <input type = "submit" name = "itemsButton" id = "itemsButton" class = "button" value = "Items">
    </form>
    <p><?php

        if ($activeTable == "None") {

            echo "<br>Please select a table.<br><br>
            <form action='../user/logout.php'>
                <input type = 'submit' value = 'Log Out'>
            </form>";
            exit();

        } else echo "<i>Active table: $activeTable</i><br><br>";

    ?></p>
    <button type='button' class='console_collap'>Search</button>
    <div class='admin_view'>
        <br>
        <?php

            switch ($activeTable) {

                case "Events":

                    echo "<p>Search by key value:</p>
                    <form action = 'actions/adminSearch.php'>
                        <input type = 'text' id = 'term' name = 'term' required><br><br>
                        <input type = 'submit' value = 'Search'><br>
                    </form>
                    <br><p>Search by date:</p>
                    <form action = 'actions/adminSearch.php'>
                        <input type = 'date' id = 'term' name = 'term' required><br><br>
                        <input type = 'submit' value = 'Search'><br>
                    </form><br>";

                    break;

                default:

                    echo "<form action = 'actions/adminSearch.php'>
                        <label for = 'term'>Search term:<br></label>
                        <input type = 'text' id = 'term' name = 'term' required><br><br>
                        <input type = 'submit' value = 'Search'><br>
                    </form><br>";

                    break;

            }

        ?>
    </div>
    <button type='button' class='console_collap'>Insert</button>
    <div class='admin_insert'>
        <br>
        <?php

            switch ($activeTable) {

                case "Users":

                    echo "<form action = 'actions/adminInsert.php'>
                        Information:<br>
                        <input type = 'email' name = 'email' id = 'email' placeholder = 'Email' required><br>
                        <input type = 'password' name = 'password' id = 'password' placeholder = 'Password' required>
                        <input type = 'checkbox' onclick = 'passVisibility()'><br>
                        <input type = 'text' name = 'firstName' id = 'firstName' placeholder = 'First Name' required><br>
                        <input type = 'text' name = 'lastName' id = 'lastName' placeholder = 'Last Name' required><br><br>
                        Admin Level:<br>
                        <input type = 'range' name = 'level' id = 'level' max = 2 min = 0 step = 1 value = 0 oninput = 'lvlTxt()'>
                        <label for = 'level' id = 'adLvlTxt'>0</label><br>
                        <input type = 'submit' value = 'Insert'><br>
                    </form>";
                    break;

                case "Categories":

                    echo "<form action = 'actions/adminInsert.php'>
                        <label for = 'desc'>Brief category description:<br></label>
                        <input type = 'text' name = 'desc' id = 'desc' placeholder = 'Description' required><br><br>
                        <input type = 'submit' value = 'Insert'><br>
                    </form>";
                    break;

                case "Events":

                    echo "<form action = 'actions/adminInsert.php'>
                        <label for = 'event_name'>Event info:<br></label>
                        <input type = 'text' name = 'event_name' id = 'event_name' placeholder = 'Name'required><br>
                        <input type = 'text' name = 'operator_code' id = 'operator_code' placeholder = 'OP Code'required><br><br>
                        <label for = 'post_begin'>Dates:<br></label>
                        <input type = 'date' name = 'post_begin' id = 'post_begin' placeholder = ''required><br>
                        <input type = 'date' name = 'post_end' id = 'post_end' placeholder = '' required><br>
                        <input type = 'date' name = 'event_begin' id = 'event_begin' placeholder = ''required><br>
                        <input type = 'date' name = 'event_end' id = 'event_end' placeholder = '' required><br><br>
                        <input type = 'submit' value = 'Insert'><br>
                    </form>";
                    break;

                case "Items":

                    echo "<p>Please insert items here: <a href = '../../web_src/user/addItem.php'>Add Item</a><p>";
                    break;

                default:

                    echo "Critical error encountered:\nactiveTable set to null or invalid value.";
                    break;

            }

        ?><br>
    </div>
    <button type='button' class='console_collap'>Update</button>
    <div class='admin_update'>
        <br>
        <?php

            switch ($activeTable) {

                case "Users":

                    echo "<form action = 'actions/adminUpdate.php'>
                        <label for = 'updateID'>ID of target record:<br></label>
                        <input type = 'number' id = 'updateID' name = 'updateID' min = '0' value = '0' required><br><br>
                        <label for = 'updateCol'>Column to be edited:<br></label>
                        <select id = 'updateCol' name = 'updateCol' onchange = 'usersSelectChange()'>
                            <option value = 'user_email'>user_email</option>
                            <option value = 'user_password'>user_password</option>
                            <option value = 'first_name'>first_name</option>
                            <option value = 'last_name'>last_name</option>
                            <option value = 'admin_level'>admin_level</option>
                        </select><br><br>
                        <label for = 'updateVal'>New value:<br></label>
                        <input type = 'email' id = 'updateVal' name = 'updateVal' max = 2 min = 0 step = 1 required><br><br>
                        <input type = 'submit' value = 'Update'>
                    </form>";
                    break;

                case "Categories":

                    echo "<form action = 'actions/adminUpdate.php'>
                        <label for = 'updateID'>ID of target category:<br></label>
                        <input type = 'number' id = 'updateID' name = 'updateID' min = '0' value = '0' required>
                        <input type = 'hidden' id = 'updateCol' name = 'updateCol' value = 'category_description' required><br><br>
                        <label for = 'updateVal'>New description:<br></label>
                        <input type = 'text' id = 'updateVal' name = 'updateVal' required><br><br>
                        <input type = 'submit' value = 'Update'>
                    </form>";
                    break;

                case "Events":

                    echo "<form action = 'actions/adminUpdate.php'>
                        <label for = 'updateID'>ID of target record:<br></label>
                        <input type = 'number' id = 'updateID' name = 'updateID' min = '0' value = '0' required><br><br>
                        <label for = 'updateCol'>Column to be edited:<br></label>
                        <select id = 'updateCol' name = 'updateCol' onchange = 'eventsSelectChange()'>
                            <option value = 'event_name'>event_name</option>
                            <option value = 'operator_code'>operator_code</option>
                            <option value = 'posting_begin_date'>posting_begin_date</option>
                            <option value = 'posting_end_date'>posting_end_date</option>
                            <option value = 'event_begin_date'>event_begin_date</option>
                            <option value = 'event_end_date'>event_end_date</option>
                        </select><br><br>
                        <label for = 'updateVal'>New value:<br></label>
                        <input type = 'text' id = 'updateVal' name = 'updateVal' required><br><br>
                        <input type = 'submit' value = 'Update'>
                    </form>";
                    break;

                case "Items":

                    echo "<form action = 'actions/adminUpdate.php'>
                        <label for = 'updateID'>ID of target record:<br></label>
                        <input type = 'number' id = 'updateID' name = 'updateID' min = '1000000' value = '1000000' required><br><br>
                        <label for = 'updateCol'>Column to be edited:<br></label>
                        <select id = 'updateCol' name = 'updateCol' onchange = 'itemsSelectChange()'>
                            <option value = 'user_id'>user_id</option>
                            <option value = 'category_id'>category_id</option>
                            <option value = 'event_id'>event_id</option>
                            <option value = 'ISBN'>ISBN</option>
                            <option value = 'title'>title</option>
                            <option value = 'author'>author</option>
                            <option value = 'price'>price</option>
                            <option value = 'year_published'>year_published</option>
                            <option value = 'donation'>donation</option>
                            <option value = 'sold'>sold</option>
                        </select><br><br>
                        <label for = 'updateVal'>New value:<br></label>
                        <input type = 'number' id = 'updateVal' name = 'updateVal' required><br><br>
                        <input type = 'submit' value = 'Update'>
                    </form>";
                    break;

            }

        ?><br>
    </div>
    <button type='button' class='console_collap'>Delete</button>
    <div class='admin_delete'>
        <br>
        <?php

            switch ($activeTable) {

                case "Items":

                    echo "<form action = 'actions/adminDelete.php' onsubmit = 'return confirm(\"Delete chosen ID from $activeTable?\")'>
                        <label for ='deleteID'>ID to delete:<br></label>
                        <input type = 'number' id = 'deleteID' name = 'deleteID' min = '1000000' value = '1000000' required>
                        <input type = 'submit' value = 'Delete'>
                    </form>";
                    break;

                default:

                    echo "<form action = 'actions/adminDelete.php' onsubmit = 'return confirm(\"Delete chosen ID from $activeTable?\")'>
                        <label for ='deleteID'>ID to delete:<br></label>
                        <input type = 'number' id = 'deleteID' name = 'deleteID' min = '0' value = '0' required>
                        <input type = 'submit' value = 'Delete'>
                    </form>";
                    break;

            }

        ?><br>
    </div></div><br>
    </div>
    <form action='../user/logout.php'>
        <input type = 'submit' value = 'Log Out'>
    </form>
    <script>

        function passVisibility() {

            var input = document.getElementById("password");
            if (input.type === "password") input.type = "text";
            else input.type = "password";

        }

        function lvlTxt() {

            var txt = document.getElementById("adLvlTxt");

            switch (parseInt(document.getElementById("level").value)) {

                case 0:

                    txt.innerHTML = "0";
                    break;

                case 1:
                    
                    txt.innerHTML = "1";
                    break;

                case 2:

                    txt.innerHTML = "2";
                    break;

                default:

                    txt.innerHTML = document.getElementById("level").value;
                    break;

            }

        }

        function usersSelectChange() {

            var select = document.getElementById("updateCol");
            var input = document.getElementById("updateVal");

            input.value = '';
            if (select.value === "user_email") input.type = 'email';
            else if (select.value === "admin_level") input.type = 'range';
            else input.type = 'text';

        }

        function eventsSelectChange() {

            var select = document.getElementById("updateCol");
            var input = document.getElementById("updateVal");
            
            input.value = '';
            if (select.value === "event_name" || select.value === "operator_code") input.type = 'text';
            else input.type = 'date';

        }

        function itemsSelectChange() {

            var select = document.getElementById("updateCol");
            var input = document.getElementById("updateVal");

            input.value = '';
            if (select.value === "donation" || select.value === "sold") input.type = 'checkbox';
            else if (select.value === "title" || select.value === "author") input.type = 'text';
            else input.type = 'number';

        }

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