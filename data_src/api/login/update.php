<?php
require_once "../../db_functions.php";
session_start();
//print_r($_POST);
//print_r($_SESSION);
$functions->updateTable($_SESSION['user_id'],'user_password',$_POST['user_password1'],'users');
$_SESSION['msg']='Password Reset Successful';
header("location:../../../web_src/user/login.php");
?>