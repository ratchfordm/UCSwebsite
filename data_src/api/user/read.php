<?php

/*
Author: Asher Wayde
This file reads the items, categories, and single items, anything that the client side user might need to use the website
*/

require_once "../../data_src/db_functions.php";

function readItems(){
    /*
    This function reads all the data accosiated with the user stored in the session data
    this function is not parameritized, but since it should only be called with session data, it should be secure
    */
    // this sets up the sql
    global $functions;
    $sql = "SELECT * FROM items
    join users using(user_id)
    join categories using(category_id)
    where user_email='".$_SESSION['user_email']."'
    order by title";
    // return the data as a 2d matrix
    return $functions->queryDB($sql);
}
function readCats(){
    /*
    This reads all the categories from the database
    */
    global $functions;
    $sql = "SELECT * FROM categories order by category_description;";
    // return the data as a 2d matrix
    return $functions->queryDB($sql);
}

function readSingleItem($itemID){
    /*
    This reads one item, using the item id as an input
    */
    global $functions;
    // setup the sql and get the database
    $sql = 
    "SELECT * FROM items
    Where item_id=:a";
    $db=$functions->getDB();
    // bind the parameters
    $stmt=$db->prepare($sql);
    $stmt->bindParam(":a",$itemID,PDO::PARAM_INT);
    $stmt->execute();
    // return a single array with the item parameters as input
    return ($stmt->fetchall())[0];
}


?>