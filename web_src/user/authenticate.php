<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();
require_once "../../data_src/api/login/read.php";
$data=getUserWPassword();
//print_r($data);
if(sizeof($data)){
    //print_r($data);
    $_SESSION['logged_in']=True;
    $_SESSION['user_email']=$_POST['user_email'];
    $_SESSION['first_name']=$data[0]['first_name'];
    $_SESSION['last_name']=$data[0]['last_name'];
    $_SESSION['admin_level']=$data[0]['admin_level'];
    $_SESSION['user_id']=$data[0]['user_id'];
    header("Location:displayItems.php");
}
else
    header("Location:login.php");

?>