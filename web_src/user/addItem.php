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
        <label for='title'>Title</label>
        <input type='text' id='title'>
    </form>
    <?php
    require_once "../footer.php";
    ?>
</body>
</html>