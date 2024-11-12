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
        <li><a href="#database_schema">Database Schema</a></li>
        <li><a href="#db_functions">Database Functions</a></li><br>
        <ul>
            <li><a href="#queryDB">queryDB()</a></li>
            <li><a href="#insertInto">insertInto()</a></li>
            <li><a href="#deleteFrom">deleteFrom()</a></li>
            <li><a href="#updateTable">updateTable()</a></li>
        </ul><br>
        <li><a href="#webAPI">Web API</a></li><br>
        <ul>
            <li><a href="#loginAPI">Login API</a></li>
            <li><a href="#userAPI">User API</a></li>
        </ul>
    </ul>
    <h2 id="database_schema">-= Database Schema =-</h2>
    <p>This section describes how the database is structured.</p>
    <h3>Basic Info</h3>
    <ul>
        <li><b>Database name: </b>chapweb_ucs</li>
        <li><b>Database type: </b>MySQL</li>
        <li><b>Tables:</b></li><br>
        <ul>
            <li>Users</li>
            <li>Categories</i>
            <li>Events</i>
            <li>Items</li>
        </ul><br>
        <li><b>Structure of users: </b></li><br>
        <ul>
            <li>user_id INT NOT NULL AUTO_INCREMENT</li>
            <li>user_email VARCHAR(45) NOT NULL</li>
            <li>user_password VARCHAR(45) NOT NULL</li>
            <li>first_name VARCHAR(45) NOT NULL</li>
            <li>last_name VARCHAR(45) NOT NULL</li>
            <li>admin_level INT NOT NULL DEFAULT 0</li>
        </ul><br>
        <ul>
            <li>PRIMARY KEY (user_id)</li>
            <li>UNIQUE user_email_unique (user_email)</li>
        </ul><br>
        <li><b>Structure of categories:</b></li><br>
        <ul>
            <li>category INT NOT NULL</li>
            <li>category_description VARCHAR(30)</li>
        </ul><br>
        <ul>
            <li>PRIMARY KEY (category_id)</li>
            <li>UNIQUE category_description_unique (category_description)</li>
        </ul><br>
        <li><b>Structure of events:</b></li><br>
        <ul>
            <li>event_id INT NOT NULL auto_increment</li>
            <li>event_name VARCHAR(45) NOT NULL</li>
            <li>posting_begin_date DATETIME NOT NULL</li>
            <li>posting_end_date DATETIME NOT NULL</li>
            <li>event_begin_date DATETIME NOT NULL</li>
            <li>event_end_date DATETIME NOT NULL</li>
            <li>operator_code VARCHAR(8) NOT NULL</li>
        </ul><br>
        <ul>
            <li>PRIMARY KEY (event_id)</li>
            <li>CONSTRAINT operator_code_min_length CHECK (length(operator_code) >= 8)</li>
            <li>UNIQUE event_name_unique (event_name)</li>
        </ul><br>
        <li><b>Structure of items:</b></li><br>
        <ul>
            <li>item_id INT NOT NULL AUTO_INCREMENT</li>
            <li>user_id INT NOT NULL</li>
            <li>category_id INT NOT NULL</li>
            <li>event_id INT NOT NULL</li>
            <li>ISBN INT</li>
            <li>title VARCHAR(90) NOT NULL</li>
            <li>author VARCHAR(90)</li>
            <li>price DECIMAL(65, 2) NOT NULL</li>
            <li>year_published INT</li>
            <li>donation BOOLEAN NOT NULL</li>
            <li>sold BOOLEAN NOT NULL DEFAULT 0</li>
        </ul><br>
        <ul>
            <li>PRIMARY KEY (item_id)</li>
            <li>UNIQUE INDEX book_id_unique_index (item_id)</li>
            <li>CONSTRAINT user_id_books_fk FOREIGN KEY (user_id) REFERENCES users (user_id)</li>
            <li>CONSTRAINT category_id_books_fk FOREIGN KEY (category_id) REFERENCES categories (category_id)</li>
            <li>CONSTRAINT event_id_books_fk FOREIGN KEY (event_id) REFERENCES events (event_id)</li>
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