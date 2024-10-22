<?php

    require_once "../../data_src/db_config.php";

    $queryDB = function($sql, $type = "s") use ($db) {
        /*
        Sends a query to the database.
        Use the type parameter to specify the type of statement (select, insert, etc); defaults to SELECT.
        */

        $stmt = $db->prepare($sql);
        $stmt->execute();

        if ($type = "s" || !isset($type) || empty($type)) {

            $data = $stmt->fetchAll();
            return $data;

        } else return "Done.";

    };

    $insertInto = function($info, $table) use ($db) {
        /*
        Inserts something into the database.
        Automatically parameterizes stuff; just pass an array matching the desired table's columns.
        Also enforces VARCHAR length limits via substr()
        */

        if (!strcmp(substr($table, 0, 1), "u")) { // Users

            $data["user_email"] = substr($info[0], 0, 45);
            $data["user_password"] = substr($info[1], 0, 45);
            $data["first_name"] = substr($info[2], 0, 45);
            $data["last_name"] = substr($info[3], 0, 45);
            $data["admin_level"] = $info[4];

            $sql = $db->prepare("INSERT INTO users (user_email, user_password, first_name, last_name, admin_level) VALUES (?, ?, ?, ?, ?);");
            $sql->bindParam(1, $data["user_email"], PDO::PARAM_STR);
            $sql->bindParam(2, $data["user_password"], PDO::PARAM_STR);
            $sql->bindParam(3, $data["first_name"], PDO::PARAM_STR);
            $sql->bindParam(4, $data["last_name"], PDO::PARAM_STR);
            $sql->bindParam(5, $data["admin_level"], PDO::PARAM_INT);

        } else if (!strcmp(substr($table, 0, 1), "c")) { // Categories

            $data["category_descriptions"] = substr($info[0], 0, 30);

            $sql = $db->prepare("INSERT INTO categories (category_description) VALUES (?);");
            $sql->bindParam(1, $data["category_descriptions"], PDO::PARAM_STR);

        } else if (!strcmp(substr($table, 0, 1), "e")) { // Events
            
            $data["event_name"] = substr($info[0], 0, 45);
            $data["posting_begin_date"] = info[1];
            $data["posting_end_date"] = info[2];
            $data["event_begin_date"] = info[3];
            $data["event_end_date"] = info[4];
            $data["operator_code"] = substr($info[5], 0, 8);

            $sql = $db->prepare("INSERT INTO events (event_name, posting_begin_date, posting_end_date, event_begin_date, event_end_date, operator_code) VALUES (?, ?, ?, ?, ?, ?);");
            $sql->bindParam(1, $data["event_name"], PDO::PARAM_STR);
            $sql->bindParam(2, $data["posting_begin_date"]);
            $sql->bindParam(3, $data["posting_end_date"]);
            $sql->bindParam(4, $data["even_begin_date"]);
            $sql->bindParam(5, $data["event_end_date"]);
            $sql->bindParam(6, $data["operator_code"]);

        } else if (!strcmp(substr($table, 0, 1), "i")) { // Items

            $data["ISBN"] = $info[0];
            $data["title"] = substr($info[1], 0, 90);
            $data["author"] = substr($info[2], 0, 90);
            $data["price"] = $info[3];
            $data["year_published"] = $info[4];
            $data["qty"] = $info[5];
            $data["donation"] = $info[6];

            if (isset($info[7])) $data["sold"] = $info[7];
            else $data["sold"] = 0;

            $sql = $db->prepare("INSERT INTO items (ISBN, title, author, price, year_published, qty, donation, sold) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $sql->bindParam(1, $data["ISBN"], PDO::PARAM_INT);
            $sql->bindParam(2, $data["title"], PDO::PARAM_STR);
            $sql->bindParam(3, $data["author"], PDO::PARAM_STR);
            $sql->bindParam(4, $data["price"]);
            $sql->bindParam(5, $data["year_published"], PDO::PARAM_INT);
            $sql->bindParam(6, $data["qty"], PDO::PARAM_INT);
            $sql->bindParam(7, $data["donation"]);
            $sql->bindParam(8, $data["sold"]);

        } else {

            echo "Invalid table.";
            return;

        }

        $sql->execute();

    };

?>