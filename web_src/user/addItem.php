<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Items</title>

<!-- Stylesheets -->
    <link href='../css/global.css' rel='stylesheet'>
    <link href='../css/user.css' rel='stylesheet'>
    
<!-- Javascript -->
    <script src='js/isbnLookup.js'></script>
</head>
<body>
    <?php
    /*
    Author: Asher Wayde
    This page includes the form to add items and then passes them to the add.php file to add the items to the database under that user
    */
    // Adding the Navbar
    require_once "navbar.php";
    ?>
    <h2>Please tell us some information about your item</h2>
    <?php
    // This is for the add completetion or failure message after the item is processed
    if(key_exists('addMsg',$_SESSION)){
        echo "<p>".$_SESSION['addMsg']."</p>";
        $_SESSION['addMsg']=null;
    }
    ?>
    <!-- This is the form for inputing an item  -->
    <form action="../../data_src/api/user/add.php" class='inputForm'>
        <div>
            <label for='isbn'>ISBN</label>
            <input name='isbn' type='number' id='isbn' min='0' value=''>
            <div class='info'>
                <img src='../images/infoBubble.png' alt='i' class='infoIcon'>
                <span class='infoText'>
                    The ISBN or International Book Seller Number, is a 10 or 13 digit code
                    on the back of your book, usually next to a barcode. It is not nessecary to input this
                    number, but putting it in, will autofill the author and the year published.
                </span>
            </div>   
        </div>
    <!-- This is for if the ISBN lookup fails -->
        <p id='apiErr' class='Err'></p>
        <div>
            <label for='title' >Title <span class='req'>*</span></label>
            <input name='title' type='text' id='title' required value=''>
            <div class='info'>
                <img src='../images/infoBubble.png' alt='i' class='infoIcon'>
                <span class='infoText'>
                    Either the author of the book, or the title of the books
                    or the title of the items.
                </span>
            </div>
        </div>
        <div>
            <label for='author'>Author</label>
            <input name='author' type='text' id='author' value=''>
            <div class='info'>
                <img src='../images/infoBubble.png' alt='i' class='infoIcon'>
                <span class='infoText'>
                    The author of the item, This is a book specific attribute, and not required for bundles or
                    other items
                </span>
            </div>
        </div>
        <div>
            <label for='price'>Price <span class='req'>*</span></label>
            <input name='price' type='number' id='price' required value='' step='.01'>
            <div class='info'>
                <img src='../images/infoBubble.png' alt='i' class='infoIcon'>
                <span class='infoText'>
                    The price of the item. only put in numbers, as the $ is not allowed
                    you can either put in dollars and sense, or just dollars.
                </span>
            </div>
        </div>
        <div>
            <label for='year'>Year Published</label>
            <input name='year' type='number' id='year' min='0' value=''>
            <div class='info'>
                <img src='../images/infoBubble.png' alt='i' class='infoIcon'>
                <span class='infoText'>
                    This is the year published for the book. 
                    This shouldn't matter for bundles or other items.
                </span>
            </div>
        </div>
        <div>
            <label for='donation'>Pick up after UCS? <span class='req'>*</span></label>
            <input name='donation' type='checkbox' id='donation'>
            <div class='info'>
                <img src='../images/infoBubble.png' alt='i' class='infoIcon'>
                <span class='infoText'>
                    If you want to donate your Items after UCS and don't wish to take them back
                    Leave this unchecked, but if you are going to donate this item, check this box
                </span>
            </div>
        </div>
        <div>
            <label for='category'>Category <span class='req'>*</span></span>
            <select name='category' id='category' required>
                <?php
                // this code dynamically reads the categories from the database, and add them to option values in the form
                require_once "../../data_src/api/user/read.php";
                $data=readCats();
                
                for($i=0;$i<sizeof($data);$i++){
                    echo "<option value='".$data[$i]['category_id']."'>";
                    echo $data[$i]['category_description'];
                    echo "</option>";
                }
                ?>
            </select>
            <div class='info'>
                <img src='../images/infoBubble.png' alt='i' class='infoIcon'>
                <span class='infoText'>
                    This is the category of the item in question. This should be selected for every item.
                </span>
            </div>
        </div>
        <p>
        <span class='req'>*</span> = Required
        </p>
        <div>
            <input type='submit' value='Add Item'>
        </div>

    </form>
    <?php
    // this adds the footer to the page
    require_once "../footer.php";
    ?>
</body>
</html>