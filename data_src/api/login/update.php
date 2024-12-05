<?php
/*
Author: Asher Wayde
This function just takes the user_id from the session variables, and resets the password for the account
*/
require_once "../../db_functions.php";
session_start();
// updating the password
$functions->updateTable($_SESSION['user_id'],'user_password',$_POST['user_password1'],'users');
// sending back a session variable to display the password
$_SESSION['msg']='Password Reset Successful';
header("location:../../../web_src/user/login.php");
?>