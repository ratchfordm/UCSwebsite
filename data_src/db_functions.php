<?php

    // PHP error settings
    // Any file that includes this one should get these same settings

    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    class DatabaseFunctions {
        /*
        The class that manages the database connection and several related functions
        Using this class ensures that only a single connection to the database is used
        */

        private static $db = null;
        
        function __construct() {
            /* Constructor */

            self::connect();

        }

        private static function connect() {
            /*
            Connects to the database.
            Prevents reconnecting if a connection is already open.
            */

            if (self::$db === null) {

                require_once "db_config.php";

                try {
                    
                    // Make the connection
                    self::$db = new PDO("mysql:host=$host;dbname=$database", $username, $password);
                    self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                } catch (PDOException $err) {

                    // If connection fails
                    echo "CONNECTION FAILED: " . $err->getMessage();
                    http_response_code(500);
                    exit();

                }

            }

        }

        public static function getDB() {
            /* Get current database connection reference */

            self::connect();
            return self::$db;

        }

        public static function queryDB(string $stmt) {
            /*
            All-purpose function that sends any statement to the database
            Statements must be parameterized beforehand!
            */

            self::connect();

            $sql = self::$db->prepare($stmt);
            $sql->execute();
            $response = $sql->fetchAll();

            return $response;

        }

        public static function insertInto($info, string $table) {
            /*
            Inserts data given as an array into the specified table.
            Automatically parameterizes queries and enforces length constraints.
            Returns True if SQL *executes* and False if it does not.
            */

            self::connect();

            if (!strcmp(substr($table, 0, 1), "u")) { // Users

                $data["user_email"] = substr($info[0], 0, 45);
                $data["user_password"] = substr($info[1], 0, 45);
                $data["first_name"] = substr($info[2], 0, 45);
                $data["last_name"] = substr($info[3], 0, 45);
                $data["admin_level"] = $info[4];
    
                $sql = self::$db->prepare("INSERT INTO users (user_email, user_password, first_name, last_name, admin_level) VALUES (?, ?, ?, ?, ?);");
                $sql->bindParam(1, $data["user_email"], PDO::PARAM_STR);
                $sql->bindParam(2, $data["user_password"], PDO::PARAM_STR);
                $sql->bindParam(3, $data["first_name"], PDO::PARAM_STR);
                $sql->bindParam(4, $data["last_name"], PDO::PARAM_STR);
                $sql->bindParam(5, $data["admin_level"], PDO::PARAM_INT);
    
            } else if (!strcmp(substr($table, 0, 1), "c")) { // Categories
    
                $data["category_description"] = substr($info[0], 0, 30);
    
                $sql = self::$db->prepare("INSERT INTO categories (category_description) VALUES (?);");
                $sql->bindParam(1, $data["category_description"], PDO::PARAM_STR);
    
            } else if (!strcmp(substr($table, 0, 1), "e")) { // Events
                
                $data["event_name"] = substr($info[0], 0, 45);
                $data["posting_begin_date"] = $info[1];
                $data["posting_end_date"] = $info[2];
                $data["event_begin_date"] = $info[3];
                $data["event_end_date"] = $info[4];
                $data["operator_code"] = substr($info[5], 0, 8);
                
                $sql = self::$db->prepare("INSERT INTO events (event_name, posting_begin_date, posting_end_date, event_begin_date, event_end_date, operator_code) VALUES (?, ?, ?, ?, ?, ?);");
                $sql->bindParam(1, $data["event_name"], PDO::PARAM_STR);
                $sql->bindParam(2, $data["posting_begin_date"], PDO::PARAM_STR);
                $sql->bindParam(3, $data["posting_end_date"], PDO::PARAM_STR);
                $sql->bindParam(4, $data["event_begin_date"], PDO::PARAM_STR);
                $sql->bindParam(5, $data["event_end_date"], PDO::PARAM_STR);
                $sql->bindParam(6, $data["operator_code"], PDO::PARAM_STR);
    
            } else if (!strcmp(substr($table, 0, 1), "i")) { // Items
                
                $data["user_id"] = $info[0];
                $data["category_id"] = $info[1];
                $data["event_id"] = $info[2];
                $data["isbn"] = substr($info[3], 0, 13);
                $data["title"] = substr($info[4], 0, 200);
                $data["author"] = substr($info[5], 0, 90);
                $data["price"] = $info[6];
                $data["year_published"] = $info[7];
                $data["donation"] = $info[8];
    
                if (isset($info[9])) $data["sold"] = $info[9];
                else $data["sold"] = 0;
    
                $sql = self::$db->prepare("INSERT INTO items (user_id, category_id, event_id, isbn, title, author, price, year_published, donation, sold) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
                $sql->bindParam(1, $data["user_id"], PDO::PARAM_INT);
                $sql->bindParam(2, $data["category_id"], PDO::PARAM_INT);
                $sql->bindParam(3, $data["event_id"], PDO::PARAM_INT);
                $sql->bindParam(4, $data["isbn"], PDO::PARAM_STR);
                $sql->bindParam(5, $data["title"], PDO::PARAM_STR);
                $sql->bindParam(6, $data["author"], PDO::PARAM_STR);
                $sql->bindParam(7, $data["price"]);
                $sql->bindParam(8, $data["year_published"], PDO::PARAM_INT);
                $sql->bindParam(9, $data["donation"], PDO::PARAM_BOOL);
                $sql->bindParam(10, $data["sold"], PDO::PARAM_BOOL);
    
            } else {
    
                echo "Invalid table.";
                return False;
    
            }
    
            $sql->execute();
            return True;
    
        }

        public static function deleteFrom(int $id, string $table) {
            /* Deletes a row from the specified table via primary key. */

            self::connect();

            try {

                switch (substr($table, 0, 1)) {

                    case "u":

                        $sql = self::$db->prepare("DELETE FROM users WHERE user_id = :id;");
                        break;
                    
                    case "c":

                        $sql = self::$db->prepare("DELETE FROM categories WHERE category_id = :id;");
                        break;

                    case "e":

                        $sql = self::$db->prepare("DELETE FROM events WHERE event_id = :id;");
                        break;

                    case "i":

                        $sql = self::$db->prepare("DELETE FROM items WHERE item_id = :id;");
                        break;

                    default:

                        echo "Invalid table.";
                        return False;

                }

                $sql->bindValue(":id", $id, PDO::PARAM_INT);
                $sql->execute();

            } catch(PDOException $err) {

                echo "Caught PDO error! See message:<br><br>";
                print_r($err->errorInfo());
                return False;

            }

            return True;

        }

        public static function updateTable(int $id, string $col, $value, string $table) {
            /*
            Changes a specific piece of information via primary key and column name.
            Validates column names to (hopefully) prevent injection.
            Blocks updating primary keys.
            */

            self::connect();
            $valid = False;

            switch (substr($table, 0, 1)) {

                case "u":

                    switch ($col) {

                        case "user_id":

                            echo "You cannot alter the primary key.<br>";
                            break;

                        case "user_email":
                        case "user_password":
                        case "first_name":
                        case "last_name":
                        case "admin_level":

                            $valid = True;
                            break;

                    }

                    $sql = self::$db->prepare("UPDATE users SET $col = :val WHERE user_id = :id;");
                    break;
                
                case "c":

                    $valid = True;
                    $sql = self::$db->prepare("UPDATE categories SET category_description = :val WHERE category_id = :id;");
                    break;

                case "e":

                    switch ($col) {

                        case "event_id":

                            echo "You cannot alter the primary key.<br>";
                            break;

                        case "event_name":
                        case "posting_begin_date":
                        case "posting_end_date":
                        case "event_begin_date":
                        case "event_end_date":
                        case "operator_code":

                            $valid = True;
                            break;

                    }

                    $sql = self::$db->prepare("UPDATE events SET $col = :val WHERE event_id = :id;");
                    break;

                case "i":

                    switch ($col) {

                        case "item_id":

                            echo "You cannot alter the primary key.<br>";
                            break;

                        case "user_id":
                        case "category_id":
                        case "event_id":
                        case "isbn":
                        case "title":
                        case "author":
                        case "price":
                        case "year_published":
                        case "donation":
                        case "sold":

                            $valid = True;
                            break;

                    }

                    $sql = self::$db->prepare("UPDATE items SET $col = :val WHERE item_id = :id;");
                    break;

                default:

                    echo "Invalid table.";
                    return False;

            }

            if ($valid) {

                $sql->bindParam(":val", $value, PDO::PARAM_STR);
                $sql->bindParam(":id", $id, PDO::PARAM_INT);
                $sql->execute();

            } else {

                echo "Invalid column: $col";
                return False;

            }

            return True;

        }

        public static function searchDB(string $term, string $table) {
            /*
            Search the database for a specific piece of information.
            Note that the following MUST be IN the loop for some reason:
                $response = $sql->fetchAll();
                array_push($responses, [$response]);
            Returns False if it fails to setup, or an array of responses.
            */

            self::connect();
            $responses = [];
            
            switch (strtolower(substr($table, 0, 1))) {
            // Determine the target table, and whether the search term is numeric or a string.
            // Then select the columns that match the search data type.

                case "u":

                    $target = "users";

                    if (is_numeric($term)) $cols = ["user_id", "admin_level"];
                    else {

                        $cols = ["user_email", "user_password", "first_name", "last_name"];
                        $term = '%' . $term . '%';

                    }

                    break;

                case "c":

                    $target = "categories";

                    if (is_numeric($term)) $cols = ["category_id"];
                    else {

                        $cols = ["category_description"];
                        $term = '%' . $term . '%';

                    }

                    break;

                case "e":

                    $target = "events";

                    if (is_numeric($term)) $cols = ["event_id"];
                    else {

                        $cols = ["event_name", "posting_begin_date", "posting_end_date", "event_begin_date", "event_end_date", "operator_code"];
                        $term = '%' . $term . '%';

                    }

                    break;

                case "i":

                    $target = "items";

                    if (is_numeric($term)) $cols = ["item_id", "user_id", "category_id", "event_id", "price", "year_published"];
                    else {

                        $cols = ["isbn", "title", "author"];
                        $term = '%' . $term . '%';

                    }

                    break;

                default:

                    return False;

            }

            foreach ($cols as $col) {
            // Cycle through the selected columns and check for the search term

                try {

                    if (is_numeric($term)) {

                        $sql = self::$db->prepare("SELECT * FROM $target WHERE $col = ?");
                        $sql->bindParam(1, $term, PDO::PARAM_INT);

                    } else {

                        $sql = self::$db->prepare("SELECT * FROM $target WHERE $col LIKE ?");
                        $sql->bindParam(1, $term, PDO::PARAM_STR);

                    }
                    
                    $sql->execute();

                } catch(PDOException $err) {

                    echo "Caught PDO error! See message:<br><br>";
                    print_r($err->errorInfo());
                    return False;

                }

                $response = $sql->fetchAll();
                array_push($responses, $response);

            }

            return $responses;

        }

    }

    // The variable that other files should be using to access the above class
    // Renaming would require a lot of work
    $functions = new DatabaseFunctions();

?>