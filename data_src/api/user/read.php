<?php
require_once "../../data_src/db_functions.php";

function readItems(){
    global $functions;
    $sql = "SELECT * FROM items
    join users using(user_id)
    join categories using(category_id)
    where user_email='".$_SESSION['user_email']."'";
    return $functions->queryDB($sql);
}
function readCats(){
    global $functions;
    $sql = "SELECT * FROM categories order by category_description;";
    return $functions->queryDB($sql);
}

function readSingleItem($itemID){
    global $functions;
    $sql = 
    "SELECT * FROM items
    Where item_id=:a";
    $db=$functions->getDB();
    $stmt=$db->prepare($sql);
    $stmt->bindParam(":a",$itemID,PDO::PARAM_INT);
    $stmt->execute();
    return ($stmt->fetchall())[0];
}


?>