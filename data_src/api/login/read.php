<?php
require_once "../../data_src/db_functions.php";
function getUserWPassword(){
    global $functions;
    $db=$functions->getDB();
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql="select * from users where user_email=:a and user_password=:b";
    $stmt = $db->prepare($sql);
    //print_r($_POST);
    $_POST['user_email']=strtolower($_POST['user_email']);
    $stmt->bindParam(":a",$_POST['user_email']);
    $stmt->bindParam(":b",$_POST['user_password']);
    $stmt->execute();
    return $stmt->fetchAll();
}
function getUser($email){
    global $functions;
    $db=$functions->getDB();
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql="select * from users where user_email=:a";
    $stmt = $db->prepare($sql);
    //print_r($_POST);
    $email=strtolower($email);
    $stmt->bindParam(":a",$email);
    $stmt->execute();
    return $stmt->fetchAll();
}
?>