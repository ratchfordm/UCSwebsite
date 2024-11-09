<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentation</title>
</head>
<body>
    <h2 id='top'>Quick Access Links</h2>
    <ul>
        <li><a href="#db_functions">Database Functions</a></li>
        <ul>
            <li><a href="#queryDB">queryDB()</a></li>
            <li><a href="#insertInto">insertInto()</a></li>
            <li><a href="#deleteFrom">deleteFrom()</a></li>
            <li><a href="#updateTable">updateTable()</a></li>
        </ul>
        <li>
            <a href="#webAPI">Web API</a>
        </li>
        <ul>
            <li><a href="#loginAPI">Login API</a></li>
            <li><a href="#userAPI">User API</a></li>
        </ul>
    </ul>
    <h2 id="db_functions">-= Database Functions =-</h2>
    <p>There are several premade functions that can be used to interact with the database.</p>
    <p>Using these prevents having to reconnect to the actual database every time something is needed, and also reduces technical debt.</p>
    <h3 "queryDB">queryDB($stmt)</h3>
    <p>Very simple and straigtforward function that takes any SQL statement and executes it.</p>
    <p><i>You must parameterize your statements beforehand!</i></p>
    <p>Input(s):</p>
    <ul>
        <li>stmt : <i>String</i> -> The statement to be executed.</li>
    </ul>
    <p>Output(s):</p>
    <ul>
        <li><i>array</i> -> Whatever the SQL statement returned.</li>
    </ul>
    <h3 id="insertInto">insertInto($info, $table)</h3>
    <p>This function takes an array of information and inserts it into the specified table.</p>
    <p>The array's length and content should match the columns of the targeted table.</p>
    <p>Input(s):</p>
    <ul>
        <li>info : <i>array</i> -> The data to be inserted.</li>
        <li>table : <i>String</i> -> The name of the target table. Only one character is needed, as no table's start with the same letter.</li>
    </ul>
    <p>Output(s):</p>
    <ul>
        <li><i>bool</i> -> Returns True if the insert succeeded; False otherwise.</li>
    </ul>
    <h3 id="deleteFrom">deleteFrom($table, $id)</h3>
    <p>Deletes data from a specified table that corresponds to the given ID number.</p>
    <p>Input(s):</p>
    <ul>
        <li>id : <i>int</i> -> The target ID number.</li>
        <li>table : <i>String</i> -> The name of the target table. Only one character is needed, as no table's start with the same letter.</li>
    </ul>
    <p>Output(s):</p>
    <ul>
        <li><i>bool</i> -> Returns True if the insert succeeded; False otherwise.</li>
    </ul>
    <h3 id="updateTable">updateTable($id, $col, $value, $table)</h3>
    <p>Allows for updating a column's value.<p>
    <p>Only does one column at a time; use a loop if you have a lot (for col in colNames, for example).</p>
    <p>Input(s):</p>
    <ul>
        <li>id : <i>int</i> -> The target ID number.</li>
        <li>col : <i>String</i> -> The column that you want to update.</li>
        <li>value : <i>any</i> -> The value that the chosen column should get set to.</li>
        <li>table : <i>String</i> -> The name of the target table. Only one character is needed, as no table's start with the same letter.</li>
    </ul>
    <p>Output(s):</p>
    <ul>
        <li><i>bool</i> -> Returns True if the insert succeeded; False otherwise.</li>
    </ul>
    <h2 id="webAPI">-= Website API =-</h2>
    <a href='#top'>Back to top</a>
    <p>
        These files are called by the frontend to access the database, most of them will use the premade 
        functions that John Created. While prepared select statements will be their own connection files, 
        because the standard connection is using unprepared sql statements
    </p>
    <h3 id="loginAPI">Login API</h3>
    <a href='#top'>Back to top</a>
    <h4>by Asher Wayde</h4>
    <h3>Read.php</h3>
    <strong><p>input($_POST['user_email', 'user_password'])</p> <p>output(global $data[][])</p></strong>
    <p>
        This file is used by the login system to do basic verification.
        <p>Inputs:</p>
        <ul>
            <li>user_email: <i>String</i> -> the user's email address</li>
            <li>user_password: <i>String</i> -> the user's password</li>
        </ul>

        <p>Output:</p>
        <ul>
            <li>$data: <i>Matrix</i> -> 1 row from the user table, or a null value</li>
        </ul>
    </p>
    <h3 id="userAPI">User API</h3>
    <a href='#top'>Back to top</a>
    <h4>by Asher Wayde</h4>
    <h3>Read</h3>
    <strong>
        <p>input($_SESSION['user_email'])</p>
        <p>output(global $data[][])</p>
    </strong>
    <p>
        This file grabs all the rows attached to a user, and provides it to the front end.
        <p>Input:</p>
        <ul>
            <li>user_email: <i>String</i> -> the user's email</li>
        </ul>
        <p>Output:</p>
        <ul>
            <li>$data: <i>Matrix</i> -> all the rows linked to the user from the items table</li>
        </ul>
    </p>
    <h3>Add</h3>
    <strong>
        <p>input($_SESSION['user_email'], $_GET['isbn','title','author','price','year','qty','donation'])</p>
        <p>output NONE</p>
    </strong>
    <p>
        this file takes inputs from the frontend and adds one row to the database.
        <p>Input:</p>
        <ul>
            <li>user_email: <i>String</i> -> user's email</li>
            <li>isbn: <i>Int</i> -> isbn for the item</li>
            <li>title: <i>String</i> -> title of the item</li>
            <li>author: <i>String</i> -> the item's author</li>
            <li>price: <i>Float</i> -> price of the item</li>
            <li>year: <i>Int</i> -> year published for the item</li>
            <li>qty: <i>Int</i> -> quantity of the item</li>
            <li>donation: <i>Boolean</i> -> if item is to be donated afterwards</li>

        </ul>
        <p>Output:</p>
        <ul>
            <li>N/A</li>
        </ul>
    </p>
    <?php
    require_once('../../web_src/footer.php');
    ?>
</body>
</html>