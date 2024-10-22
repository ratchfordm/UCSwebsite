<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();
require_once "../../data_src/api/login/read.php";
//print_r($data);
if(sizeof($data)){
    $_SESSION['logged_in']=True;
    $_SESSION['User_email']=$_POST['user_email'];
    header("Location:displayItems.php");
}
else
    header("Location:login.php");

?>