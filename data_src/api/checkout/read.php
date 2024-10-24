<?php

    require_once "../../data_src/db_config.php";

    $queryDB = function($sql, $params, $type = "s") use ($db) {
        /*
        Sends a query to the database.
        Use the type parameter to specify the type of statement (select, insert, etc); defaults to SELECT.
        */

        $stmt = $db->prepare($sql);
        $stmt->execute($params);

        if ($type === "s" || !isset($type) || empty($type)) {

            $data = $stmt->fetchAll();
            return $data;

        } else return "Done.";

    };

    $insertInto = function($info, $table) use ($db) {
        /*
        Uses queryDB to insert info into the database.
        Automatically parameterizes stuff; just pass an array matching the user table columns.
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
            $sql->bindParam(5, $data["admin_level"], PDO::PARAM_STR);

        } else if (!strcmp(substr($table, 0, 1), "c")) { // Categories

            $data["category_descriptions"] = substr($info[0], 0, 30);

            $sql = "INSERT INTO categories (category_description) VALUES (?);";
            $sql->bindParam("s", $data["category_descriptions"]);

        } else if (!strcmp(substr($table, 0, 1), "e")) { // Events
            
            $data["event_name"] = substr($info[0], 0, 45);
            $data["posting_begin_date"] = info[1];
            $data["posting_end_date"] = info[2];
            $data["event_begin_date"] = info[3];
            $data["event_end_date"] = info[4];

            $sql = "INSERT INTO events (event_name, posting_begin_date, posting_end_date, event_begin_date, event_end_date) VALUES (?, ?, ?, ?, ?);";
            $sql->bindParam(1, $data["event_name"], PDO::PARAM_STR);

        }

        // echo $sql;

    };

?>