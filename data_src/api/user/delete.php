<?php
/*
Author: Asher Wayde
This file deletes the item passed into it from the get array, as long as the user is logged in to the account that owns the item
and the item exists
*/

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();
// if the user is logged in, delete the item they requested
if(key_exists('logged_in',$_SESSION) && $_SESSION['logged_in']){
    require_once "../../db_functions.php";
    // get the database
    $db = $functions->getDB();
    // prepare the sql and bind the parameters
    $sql = 
    "SELECT * FROM items
    Where item_id=:a";
    $stmt=$db->prepare($sql);
    $stmt->bindParam(":a",$_GET['item_id'],PDO::PARAM_INT);
    $stmt->execute();
    // return the item data
    $data = ($stmt->fetchall())[0];
    // if the user owns the item, and it's not sold yet, delete it
    if($data['user_id']==$_SESSION['user_id'] && !$data['sold']){
        $functions->deleteFrom($_GET['item_id'],'items');
        // report a sucessfull delete
        $_SESSION['deleteMsg']='<p>'.$data['title'].' deleted successfully';
    }
    // else report the error
    else
        $_SESSION['deleteMsg']='<p class="Err">items that have been sold cannot be deleted';

}
// and report the error for not owning this item as well
else
    $_SESSION['deleteMsg']='<p class="Err">You must own an item to delete it';
// send them back to the display items page
header("location:../../../web_src/user/displayItems.php");
?>