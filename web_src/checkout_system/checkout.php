<?php
    session_destroy();

    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    require_once "../../data_src/api/checkout/read.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
</head>
<body>
    <h1>Checkout</h1>
    <p>Review items before checking out</p>

    <!-- Table to review items before Checking Out -->

    <!-- Set local variable to the cart items array, then display table.
         Then end the session from the previous page. -->


    <?php
        require_once "../footer.php";
    ?>
</body>
</html>