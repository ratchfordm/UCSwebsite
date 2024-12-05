<?php
session_start();


$_SESSION['cart_items'] = null; // clears the cart

header('location:cart.php');
?>

