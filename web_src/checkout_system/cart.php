<?php
    session_start();

    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    require_once "../../data_src/api/checkout/read.php";

    if (!empty($_POST['item_id'])) { // if form is filled with item_id, continue
        $item_id = $_POST['item_id']; // set variable item_id with item id from form

        $sql = "SELECT item_id, title, price FROM items WHERE item_id = ?";
        $data = $queryDB($sql, [$item_id]); // executes the query with the parameter item_id

        if($data!=null) {
            $_SESSION['cart_items'][] = $data[0]; // add first item retreived to cart
        } else print("Item does not exist!");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>

    <link rel="stylesheet" href="../css/checkout.css">
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/user.css">



    <!-- <script src="cart.js"></script> -->

</head>
<body>

    <nav>
        <a class='noNav' href='https://conv.chaponline.com'>
            <img src='../images/UCSlogo.png' class='navLogo' alt='UCS Logo'>
        </a>
    
    </nav>
    
    <h1>Shopping Cart</h1>
    <p>Scan items with the barcode reader to add them to the cart.</p>

    <form method="POST" action="cart.php">
        <input type="text" id="itemId" name="item_id" placeholder="Item ID" maxlength="7" required>
        <button type="submit">Add to Cart</button>
    </form>

    <table id="shopping_cart">
        <!-- Table Head -->
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
            </tr>
        </thead>

        <!-- Table Body -->
        <tbody id="cartItems">
        <?php
           if (isset($_SESSION['cart_items'])) { // see if there are items in the cart array
            $cartItems = $_SESSION['cart_items']; // set a variable to the array
        
            for ($i = 0; $i < count($cartItems); $i++) { // add all items to the table on the page
                echo "<tr> 
                        <td>{$cartItems[$i]['item_id']}</td>
                        <td>{$cartItems[$i]['title']}</td>
                        <td>{$cartItems[$i]['price']}</td>
                      </tr>";
            }
        }
        ?>


        </tbody>

    </table>    

    <button id="clearCart">Clear Cart</button>

    <div>Ready to Checkout? Review Items <a href="checkout.php" class="button">Here</a></div>
    
    <?php
        require_once "../footer.php";

    ?>
</body>
</html>

