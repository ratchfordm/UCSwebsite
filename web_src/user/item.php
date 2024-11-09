<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='../css/global.css' rel='stylesheet'>
    <link href='../css/user.css' rel='stylesheet'>

    <?php
        require_once "../../data_src/api/user/read.php";
        $itemData=readSingleItem($_GET['id']);
    ?>
    <title><?php echo $itemData['title']; ?></title>
</head>
<body>
    <?php
    require_once "navbar.php";
    ?>
    <div class='itemDisplay'>
        <div class='itemBox'>
            Your Item: 
            <?php
            echo $itemData['title'];
            ?>
        </div>
        <div class='itemBox'>
            Price of the Item: 
            <?php
            echo "$".$itemData['price'];
            ?>
        </div>
        <div class='itemBox'>
            Are you donating the item after the Used Curriculum Sale? 
            <?php
            if($itemData['donation'])
                echo "Yes";
            else
                echo "No";
            ?>
        </div>
        <!-- Since These are book exlusive, maybe only show if it is a book -->
        <?php
        if(array_key_exists('author',$itemData))
            echo "<div class='itemBox'> Author: ".$itemData['author'].'</div>';
        ?>
        <div class='itemBox'>
            Year Published: 
            <?php
            echo $itemData['year_published'];
            ?>
        </div>
        <?php
        if(array_key_exists('isbn',$itemData))
            echo "<div class='itemBox'> ISBN: ".$itemData['isbn'].'</div>';
        ?>
        

        
    </div>
    <?php
    require_once '../footer.php';
    ?>
</body>
</html>