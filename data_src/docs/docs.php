<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentation</title>
</head>
<body>
    <h2>Links to the Documentation</h2>
    <ul>
        <li>
            <a href="docs.php#webAPI">Web API</a>
        </li>
    </ul>
    <h2>-= Database Functions =-</h2>
    <p>There are several premade functions that can be used to interact with the database.</p>
    <p>Using these prevents having to reconnect to the actual database every time something is needed, and also reduces technical debt.</p>
    <h3>queryDB($stmt)</h3>
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
    <h3>insertInto($info, $table)</h3>
    <p>This function takes an array of information and inserts it into the specified table.</p>
    <p>The array's length and content should match the columns of the targeted table.</p>
    <p>Input(s):</p>
    <ul>
        <li>info : <i>array</i> -> The data to be inserted.</li>
        <li>table : <i>String</i> -> The name of the target table. Technically only one character is needed, as no table's start with the same letter.</li>
    </ul>
    <p>Output(s):</p>
    <ul>
        <li><i>bool</i> -> Returns True if the insert succeeded; False otherwise.</li>
    </ul>
    <h3>deleteFrom($table, $column, $condition)</h3>
    <p>Deletes data from a specified table.</p>
    <p>Function is still under construction.</p>

    <h2 id="webAPI">-= Website API =-</h2>
    <p>
        These files are called by the frontend to access the database, most of them will use the premade 
        functions that John Created. While prepared select statements will be their own connection files, 
        because the standard connection is using unprepared sql statements
    </p>
    <h3>Login API</h3>
    <h4>by Asher Wayde</h4>
    <h3>Read</h3>
    <p>
        This function needs to be called by the login system, it takes in the "user_email" and "user_password"
        from the $_POST data and sends back the results from the database in a variable called $data
    </p>
    <h3>User API</h3>
    <h4>by Asher Wayde</h4>
    <h3>Read</h3>
    <p>
        This file grabs the rows connected with the specific account from the "user_email" stored in the session variable
        and returns them in the variable $data this file uses database support functions from John
    </p>
    <h3>Add</h3>
    <p>
        This file adds one row to the database taking the user_email and getting the correct values from the table
        to form an item row in the database. It does not currently send any response back from the database.
        It uses John's database helper functions.
    </p>
</body>
</html>