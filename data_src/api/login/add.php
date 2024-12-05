<?php
    /*
    Author: Asher Wayde
    The purpose of this file, is to insert a user if one linked to that email address does not exist
    */
    require "../../db_functions.php";
    
    // This gets the database connection and prepares the connection
    $db=$functions->getDB();
    $sql="select * from users where user_email=:a";
    $stmt = $db->prepare($sql);
    // This prepares and parameterized the queries
    $_POST['user_email']=strtolower($_POST['user_email']);
    $stmt->bindParam(":a",$_POST['user_email']);
    $stmt->execute();
    // this will get any users linked to the email that was requested to create an account under
    $data=$stmt->fetchAll();
    // if any users were returned, send back and error message, and quit
    if(sizeof($data)>0){
        session_start();
        $_SESSION['ErrCode']='The Email Provided is already linked to an account';
        header('location:../../../web_src/user/register.php');
    }
    // if no users were returned from the database, attempt ot add the user
    if($functions->insertInto([$_POST['user_email'],$_POST['user_password'],$_POST['first_name'],$_POST['last_name'],0],'users')){
        // if success send back a success message
        $_SESSION['msg']='Registration Sucessful';
        header('location:../../../web_src/user/login.php');
    }
    else{
        // if it failed, send back a failure message
        session_start();
        $_SESSION['ErrCode']='Error Adding Account, Please try again later';
        header("location:../../../web_src/user/register.php");
    }
    
    
?>