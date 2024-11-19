<?php
/*
Delete the item from the get array
*/
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();
if(key_exists('logged_in',$_SESSION) && $_SESSION['logged_in']){
    require_once "../../db_functions.php";
    $db = $functions->getDB();
    $sql = 
    "SELECT * FROM items
    Where item_id=:a";
    $stmt=$db->prepare($sql);
    $stmt->bindParam(":a",$_GET['item_id'],PDO::PARAM_INT);
    $stmt->execute();
    $data = ($stmt->fetchall())[0];
    if($data['user_id']==$_SESSION['user_id'] && !$data['sold']){
        $functions->deleteFrom($_GET['item_id'],'items');
        $_SESSION['deleteMsg']='<p>'.$data['title'].' deleted successfully';
        
    }
    else
        $_SESSION['deleteMsg']='<p class="Err">items that have been sold cannot be deleted';

}
else
    $_SESSION['deleteMsg']='<p class="Err">You must own an item to delete it';
header("location:../../../web_src/user/displayItems.php");
?>