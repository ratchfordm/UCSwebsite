<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>

    <link rel="stylesheet" href="../css/checkout.css">
</head>
<body>
    <h1>Checkout Cart</h1>
    <p>Scan items with the barcode reader to add them to the cart.</p>

    <label>Item ID: </label><input>

    <table id="shopping_cart">
        <!-- Table Head -->
        <thead>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
        </thead>

        <!-- Table Body -->
        <tbody>

            <?php
                // accessing the database
                require_once "../../data_src/db_config.php";

                mysql_select_db("db") or die;
                $results = mysql_query("SELECT item_id, title, price FROM items");
                while($row = mysql_fetch_array($results)) {
            ?>
                <!-- TODO: only update table with scanned items -->
                <tr>
                    <td><?php echo $row['item_id']?></td>
                    <td><?php echo $row['title']?></td>
                    <td><?php echo $row['price']?></td>
                </tr>

            <?php
                }
            ?>
        </tbody>

    </table>    


    <div>Ready to Checkout? Review Items <a href="checkout.php" class="button">Here</a></div>
    
</body>
</html>

<!-- make js thing that detects when item is scanned, sends to database, gets item that was scanned from database -->