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
    <form action="../../data_src/api/user/add.php">
        <div>
            <label for='isbn'>ISBN</label>
            <input name='isbn' type='number' id='isbn' min='0' value=''>
        </div>
        <div>
            <label for='title'>Title</label>
            <input name='title' type='text' id='title' required value=''>
        </div>
        <div>
            <label for='author'>Author</label>
            <input name='author' type='text' id='author' value=''>
        </div>
        <div>
            <label for='price'>Price</label>
            <input name='price' type='number' id='price' required value='' step='.01'>
        </div>
        <div>
            <label for='year'>Year Published</label>
            <input name='year' type='number' id='year' min='0' value=''>
        </div>
        <div>
            <label for='qty'>quantity</label>
            <input name='qty' type='number' id='qty' min='1' required value='1'>
        </div>
        <div>
            <label for='donation'>Pick up after UCS?</label>
            <input name='donation' type='checkbox' id='donation'>
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