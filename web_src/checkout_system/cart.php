<?php
    session_start();
    if(!$_SESSION['log_in']) header('location:login.php');

    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    require_once "../../data_src/api/checkout/read.php";

    $message = "";

    function itemExists($itemId, $cartItems) {
        for ($i = 0; $i < count($cartItems); $i++) {
            if ($cartItems[$i]['item_id'] == $itemId) {
                return true; // Item already exists
            }
        }
        return false; // Item doesn't exist
    }

    if (!empty($_POST['item_id'])) { // if form is filled with item_id, continue
        

            $item_id = $_POST['item_id']; // set variable item_id with item id from form

            $sql = "SELECT item_id, title, price FROM items WHERE item_id = ?";
            $data = $queryDB($sql, [$item_id]); // executes the query with the parameter item_id

            if ($data != null) {
                if (!isset($_SESSION['cart_items'])) {
                    $_SESSION['cart_items'] = []; // set cart if it doesnt exist yet
                }
                
                if (!itemExists($item_id, $_SESSION['cart_items'])) {
                    $_SESSION['cart_items'][] = $data[0]; // if item doesnt exist, add it
                    $message = "";
                } else {
                    $message = "Item already in cart!"; // else, say item already in cart
                }
            } else {
                $message = "Item doesn't exist!"; // else, say item does exist
            }

    
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
</head>
<body>

    <nav>
        <a class='noNav' href='https://conv.chaponline.com'>
            <img src='../images/UCSlogo.png' class='navLogo' alt='UCS Logo'>
        </a>
    
    </nav>
    
    <h1>Shopping Cart</h1>
    <p>Scan items with the barcode reader to add them to the cart.</p>

    <script>
        function checkLength(input) {
            let maxLength = 7; 
            if (input.value.length >= maxLength) {
                document.getElementById("form").submit(); // auto-submit the form
            }
        }
    </script>

    <form method="POST" action="cart.php" id="form">
        <input type="text" id="itemId" name="item_id" placeholder="Item ID" maxlength="7" oninput="checkLength(this)"  autofocus required>
        <!-- <button type="submit">Add to Cart</button> -->
    </form>

    

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

    <div id="itemExist"><?php echo $message; ?></div>

    <a href="clearCart.php" class="button">Clear Cart</a>
    

    <div>Ready to Checkout? Review Items <a href="checkout.php" class="button">Here</a></div>
    
    <?php
        require_once "../footer.php";
    ?>


</body>
</html>

