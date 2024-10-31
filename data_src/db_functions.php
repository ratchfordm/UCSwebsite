<?php

    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    class DatabaseFunctions {

        public static $db = null;
        
        function __construct() {

            self::connect();

        }

        private static function connect() {
            
            if (self::$db === null) {

                require_once "../../data_src/db_config.php";

                try {
                    
                    self::$db = new PDO("mysql:host=$host;dbname=$database", $username, $password);
                    self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                } catch (PDOException $err) {

                    echo "CONNECTION FAILED: " . $err->getMessage();
                    http_response_code(500);
                    exit();

                }

            }

        }

        public static function queryDB($stmt) {
            // All-purpose function that sends any statement to the database
            // Statements must be parameterized beforehand!

            self::connect();

            $sql = self::$db->prepare($stmt);
            $sql->execute();
            $response = $sql->fetchAll();

            return $response;

        }

        public static function insertInto($info, $table) {
            // Inserts data given as an array into the specified table
            // Automatically parameterizes queries
            // Automatically enforces length constraints

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
    
                $data["category_descriptions"] = substr($info[0], 0, 30);
    
                $sql = self::$db->prepare("INSERT INTO categories (category_description) VALUES (?);");
                $sql->bindParam(1, $data["category_descriptions"], PDO::PARAM_STR);
    
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
                $data["isbn"] = $info[3];
                $data["title"] = substr($info[4], 0, 90);
                $data["author"] = substr($info[5], 0, 90);
                $data["price"] = $info[6];
                $data["year_published"] = $info[7];
                $data["qty"] = $info[8];
                $data["donation"] = $info[9];
    
                if (isset($info[10])) $data["sold"] = $info[10];
                else $data["sold"] = 0;
    
                $sql = self::$db->prepare("INSERT INTO items (user_id, category_id, event_id, ISBN, title, author, price, year_published, qty, donation, sold) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $sql->bindParam(1, $data["user_id"], PDO::PARAM_INT);
                $sql->bindParam(2, $data["category_id"], PDO::PARAM_INT);
                $sql->bindParam(3, $data["event_id"], PDO::PARAM_INT);
                $sql->bindParam(4, $data["ISBN"], PDO::PARAM_INT);
                $sql->bindParam(5, $data["title"], PDO::PARAM_STR);
                $sql->bindParam(6, $data["author"], PDO::PARAM_STR);
                $sql->bindParam(7, $data["price"]);
                $sql->bindParam(8, $data["year_published"], PDO::PARAM_INT);
                $sql->bindParam(9, $data["qty"], PDO::PARAM_INT);
                $sql->bindParam(10, $data["donation"], PDO::PARAM_BOOL);
                $sql->bindParam(11, $data["sold"], PDO::PARAM_BOOL);
    
            } else {
    
                echo "Invalid table.";
                return False;
    
            }
    
            $sql->execute();
            return True;
    
        }

        public static function deleteFrom($table, $column, $condition) {

            self::connect();

            $data[0] = $column;
            $data[1] = $condition;

            switch (substr($table, 0, 1)) {

                case "u":

                    switch ($column) {

                        case "user_id":
                        case "admin_level":

                            $sql = self::$db->prepare("DELETE FROM users WHERE ? = ?;");
                            $sql->bindParam(1, $column, PDO::PARAM_STR);
                            $sql->bindParam(2, $condition, PDO::PARAM_INT);
                            break;

                        case "user_email":
                        case "user_password":
                        case "first_name":
                        case "last_name":

                            $sql = self::$db->prepare("DELETE FROM users WHERE ? LIKE ?;");
                            $sql->bindParam(1, $column, PDO::PARAM_STR);
                            $sql->bindParam(2, $condition, PDO::PARAM_STR);
                            break;

                        default:

                            echo "Invalid column in users.";
                            return False;

                    }

                    break;

                case "c":

                    switch ($column) {

                        case "category_id":

                            $sql = self::$db->prepare("DELETE FROM categories WHERE ? = ?;");
                            $sql->bindParam(1, $column, PDO::PARAM_STR);
                            $sql->bindParam(2, $condition, PDO::PARAM_INT);
                            break;
                        
                        case "category_description":

                            $sql = self::$db->prepare("DELETE FROM categories WHERE ? LIKE ?;");
                            $sql->bindParam(1, $column, PDO::PARAM_STR);
                            $sql->bindParam(2, $condition, PDO::PARAM_STR);
                            break;

                        default:

                            echo "Invalid column in categories.";
                            return False;

                    }

                    break;

                case "e":

                    switch ($column) {

                        case "event_id":
                        
                            $sql = self::$db->prepare("DELETE FROM events WHERE ? = ?;");
                            $sql->bindParam(1, $column, PDO::PARAM_STR);
                            $sql->bindParam(2, $condition, PDO::PARAM_INT);
                            break;

                        case "event_name":
                        case "posting_begin_date":
                        case "posting_end_date":
                        case "event_begin_date":
                        case "event_end_date":
                        case "operator_code":

                            $sql = self::$db->prepare("DELETE FROM events WHERE ? LIKE ?;");
                            $sql->bindParam(1, $column, PDO::PARAM_STR);
                            $sql->bindParam(2, $condition, PDO::PARAM_STR);
                            break;

                        default:

                            echo "Invalid column in events.";
                            return False;

                    }

                    break;

                case "i":

                    switch ($column) {

                        case "item_id":
                        case "user_id":
                        case "category_id":
                        case "event_id":
                        case "ISBN":
                        case "price":
                        case "year_published":
                        case "qty":
                        case "donation":
                        case "sold":

                            $sql = self::$db->prepare("DELETE FROM items WHERE ? = ?;");
                            $sql->bindParam(1, $column, PDO::PARAM_STR);
                            $sql->bindParam(2, $condition, PDO::PARAM_INT);
                            break;
                        
                        case "title":
                        case "author":
                        
                            $sql = self::$db->prepare("DELETE FROM items WHERE ? LIKE ?;");
                            $sql->bindParam(1, $column, PDO::PARAM_STR);
                            $sql->bindParam(2, $condition, PDO::PARAM_STR);
                            break;

                        default:

                            echo "Invalid column in items.";
                            break;

                    }

                    break;

                default:

                    echo "Invalid table.";
                    return False;

            }
            echo "<br>";
            $sql->debugDumpParams();
            //$sql->execute();
            return True;

        }

    }

    $functions = new DatabaseFunctions();

?>