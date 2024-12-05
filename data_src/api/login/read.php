<?php
/*
Author: Asher Wayde
This file is meant to support the login functions and the adding function by reading users from the database
*/
require_once "../../data_src/db_functions.php";

function getUserWPassword(){
    /*
    this function returns a user, with a email and password as inputs from the post data, and returns them as a data matrix
    */
    // getting the database connection
    global $functions;
    $db=$functions->getDB();
    // preparing a database connection
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql="select * from users where user_email=:a and user_password=:b";
    $stmt = $db->prepare($sql);
    // binding the parameters
    $_POST['user_email']=strtolower($_POST['user_email']);
    $stmt->bindParam(":a",$_POST['user_email']);
    $stmt->bindParam(":b",$_POST['user_password']);
    $stmt->execute();
    // returning the data as a 2d matrix
    return $stmt->fetchAll();
}
function getUser($email){
    /*
    This function returns a user without a password, it is only meant to be used by the forgot password function
    */
    // getting the database connection
    global $functions;
    $db=$functions->getDB();
    // preparing the database connection
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql="select * from users where user_email=:a";
    $stmt = $db->prepare($sql);
    // preparing and binding parameters
    $email=strtolower($email);
    $stmt->bindParam(":a",$email);
    $stmt->execute();
    // returning the data as a 2d matrix
    return $stmt->fetchAll();
}
?>