<?php
require_once "../../data_src/db_functions.php";

$sql = "SELECT * FROM items
join users using(user_id)
where user_email='".$_SESSION['user_email']."'";
$data = $queryDB($sql);
?>