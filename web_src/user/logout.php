<?php
/*
Author: Asher Wayde
This file deletes the session, effectively logging out the user
*/
session_start();
session_destroy();
header("location:login.php");
?>