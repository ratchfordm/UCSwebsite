<?php
    session_start();
    if(!$_SESSION['log_in']) header('location:login.php');

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

    <link rel="stylesheet" href="../css/checkout.css">
    <link rel="stylesheet" href="../css/global.css">
</head>
<body>

    <nav>
        <a class='noNav' href='https://conv.chaponline.com'>
            <img src='../images/UCSlogo.png' class='navLogo' alt='UCS Logo'>
        </a>
    
    </nav>
    
    <h1>Checkout</h1>
    <p>Review items before checking out</p>

    <!-- Table to review items before Checking Out -->

    <table id="shopping_cart">
        <!-- Table Head -->
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Price $</th>
            </tr>
        </thead>

        <!-- Table Body -->
        <tbody id="cartItems">
        <?php
            $totalPrice = 0;
           if (isset($_SESSION['cart_items'])) { // see if there are items in the cart array
            $cartItems = $_SESSION['cart_items']; // set a variable to the array
            
                for ($i = 0; $i < count($cartItems); $i++) { // add all items to the table on the page
                    echo "<tr> 
                            <td>{$cartItems[$i]['item_id']}</td>
                            <td>{$cartItems[$i]['title']}</td>
                            <td>{$cartItems[$i]['price']}</td>
                        </tr>";
                    $totalPrice += $cartItems[$i]['price'];
                }
            
            

        }
        ?>
        </tbody>
    </table> 

    <!-- display the total price to the user -->
    <div id="totalPrice"> Total Price: $<?php echo $totalPrice; ?></div>

    <!-- button to go back to the cart -->
    <a href="clearCart.php" class="button">Back to Cart</a>


    <?php
        require_once "../footer.php";
    ?>
</body>
</html>