<?php
require_once "../../data_src/db_config.php";
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$sql="select * from users where user_email=:a and user_password=:b";
$stmt = $db->prepare($sql);
//print_r($_POST);
$stmt->bindParam(":a",$_POST['user_email']);
$stmt->bindParam(":b",$_POST['user_password']);
$stmt->execute();
$data=$stmt->fetchAll();
?>