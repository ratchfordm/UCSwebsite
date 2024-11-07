<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();
require_once "../../data_src/api/checkout/read.php";

if(sizeof($data) == 1){
    $_SESSION['logged_in']=True;
    header("Location:cart.php");
}
else
    header("Location:login.php");
?>