<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='../css/global.css' rel='stylesheet'>
    <title>Add Items</title>
</head>
<body>
    <?php
    require_once "navbar.php";
    ?>
    <h2>Please tell us some information about your item</h2>
    <form method="post">
        <div>
            <label for='Author'>Author</label>
            <input type='text' id='Author'>
        </div>
        <div>
            <label for='title'>Title</label>
            <input type='text' id='title'>
        </div>
        <div>
            <label for='author'>Author</label>
            <input type='text' id='author'>
        </div>
        <div>
            <label for='price'>Price</label>
            <input type='number' id='price'>
        </div>
        <div>
            <label for='year'>Year Published</label>
            <input type='number' id='year'>
        </div>
        <div>
            <label for='qty'>quantity</label>
            <input type='number' id='qty'>
        </div>
        <div>
            <label for='donation'>Pick up after UCS?</label>
            <input type='checkbox' id='donation'>
        </div>
        <div>
            <span>Category Drop down</span>
        </div>
        <div>
            <input type='submit' value='Submit'>
        </div>

    </form>
    <?php
    require_once "../footer.php";
    ?>
</body>
</html>