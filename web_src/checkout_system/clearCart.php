<?php
session_start();


$_SESSION['cart_items'] = null;

header('location:cart.php');
?>

