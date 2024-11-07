<?php
    //print_r($_POST);
    require "../../db_functions.php";
    require "../../db_config.php";
    $db=new PDO("mysql:host=$host;dbname=$database",$username,$password);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql="select * from users where user_email=:a";
    $stmt = $db->prepare($sql);
    $_POST['user_email']=strtolower($_POST['user_email']);
    $stmt->bindParam(":a",$_POST['user_email']);
    $stmt->execute();
    $data=$stmt->fetchAll();
    if(sizeof($data)>0){
        session_start();
        $_SESSION['ErrCode']='The Email Provided is already linked to an account';
        header('location:../../../web_src/user/register.php');
    }
    //Insert Time.
    if($functions->insertInto([$_POST['user_email'],$_POST['user_password'],$_POST['first_name'],$_POST['last_name'],0],'users'))
        header('location:../../../web_src/user/login.php');
    else{
        session_start();
        $_SESSION['ErrCode']='Error Adding Account, Please try again later';
        header("location:../../../web_src/user/register.php");
    }
    
    
?>