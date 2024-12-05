<?php
/*
    Author: Asher Wayde
    The Purpose of this file is to take the inputs from the form and authenticate the user
    for the website, and store some session data needed by other pages.
*/
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();
// this is the api endpoint for reading the data
require_once "../../data_src/api/login/read.php";
// This refrences getting the user with the password
$data=getUserWPassword();
// if the data returns something they have successfully logged in
// TODO: fix this and make it better, this is a lazy way to validate.
if(sizeof($data)){
    $_SESSION['logged_in']=True;
    $_SESSION['user_email']=$_POST['user_email'];
    $_SESSION['first_name']=$data[0]['first_name'];
    $_SESSION['last_name']=$data[0]['last_name'];
    $_SESSION['admin_level']=$data[0]['admin_level'];
    $_SESSION['user_id']=$data[0]['user_id'];
    header("Location:displayItems.php");
}
// if they don't pass the verification process send them back to the login page
else
    header("Location:login.php");

?>