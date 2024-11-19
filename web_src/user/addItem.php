<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='../css/global.css' rel='stylesheet'>
    <link href='../css/user.css' rel='stylesheet'>
    <title>Add Items</title>
    <!--
    <script src='js/isbnLookup.js'></script>
    -->
</head>
<body>
    <?php
    require_once "navbar.php";
    ?>
    <h2>Please tell us some information about your item</h2>
    <?php
    if(key_exists('addMsg',$_SESSION)){
        echo "<p>".$_SESSION['addMsg']."</p>";
        $_SESSION['addMsg']=null;
    }
    ?>
    <form action="../../data_src/api/user/add.php" class='inputForm'>
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
            <label for='donation'>Pick up after UCS?</label>
            <input name='donation' type='checkbox' id='donation'>
        </div>
        <div>
            <label for='category'>Category</span>
            <select name='category' id='category'>
                <?php
                require_once "../../data_src/api/user/read.php";
                $data=readCats();
                for($i=0;$i<sizeof($data);$i++){
                    echo "<option value='".$data[$i]['category_id']."'>";
                    echo $data[$i]['category_description'];
                    echo "</option>";
                }
                ?>
            </select>
        </div>
        <div>
            <input type='submit' value='Add Item'>
        </div>

    </form>
    <?php
    require_once "../footer.php";
    ?>
</body>
</html>