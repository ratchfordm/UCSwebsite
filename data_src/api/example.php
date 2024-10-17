<?php

require_once "../../data_src/db_config.php";
$sql="select * from users";
$stmt=$db->prepare($sql);
$stmt->execute();
$data=$stmt->fetchAll();
print_r($data);
?>