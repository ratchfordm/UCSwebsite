<?php

    require_once "../../data_src/db_functions.php";

    $db=$functions->getDB();

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

    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql="select * from events where operator_code=:a";
    $stmt = $db->prepare($sql);
  
    $stmt->bindParam(":a",$_POST['operator_code']);
    $stmt->execute();
    $data=$stmt->fetchAll();

?>