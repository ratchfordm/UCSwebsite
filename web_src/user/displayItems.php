<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Items</title>

<!-- StyleSheets -->
    <link href="../css/user.css" rel='stylesheet'>
    <link href="../css/global.css" rel='stylesheet'>

</head>
<body>
    <?php
    /*
     Author: Asher Wayde
     This displays the items that are related to the user in logged in to a table for the user to see what items they have
    */
    // adding the navbar and setting up error reporting
    require_once "navbar.php";
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    // if an item delete was requested display the results here
    if(key_exists('deleteMsg',$_SESSION)){
        echo $_SESSION['deleteMsg']."</p>";
        $_SESSION['deleteMsg']=null;
    }
    
    ?>
    
    <table>
        <!-- This sets up the column labels for the items table -->
        <thead>
            <tr>
                <td class='title'>
                    Your Items
                </td>
                <td>
                    Price
                </td>
                <td>
                    Pick up afterwards?
                </td>
                <td>
                    is it sold?
                </td>
                <td>
                    Category
                </td>
                <td>
                    Delete item
                </td>
            </tr>
        </thead>
        <?php
            // This grabs the items related to the user logged in
            require_once "../../data_src/api/user/read.php";
            $data=readItems();
            
            // This echos the table out for each of the columns with the related data.
            for($i=0;$i<sizeof($data);$i++){
                echo "<tr>";
                // This caps the title size in the table at 77 characters so the text in the cells doesn't overflow the cells
                if(strlen($data[$i]['title'])>78){
                    $data[$i]['title']=substr($data[$i]['title'],0,78)."...";
                }
                // This sets up the refrence to the items page
                echo "<td class='title'><a href=item.php?id=".$data[$i]['item_id'].">".$data[$i]['title']."</a></td>";
                // Echoing price
                echo "<td> $".$data[$i]['price']."</td>";
                // This will echo the donation status in a more readable format
                if($data[$i]['donation'])
                    echo "<td>No</td>";
                else
                    echo "<td>Yes</td>";
                // This will echo the sold status in a more readable format
                if($data[$i]['sold'])
                    echo "<td>Yes</td>";
                else
                    echo "<td>No</td>";
                // echoing the category
                echo "<td>".$data[$i]['category_description']."</td>";
                // if the item is sold do not reveal the delete button
                if($data[$i]['sold'])
                    echo "<td></td>";
                // If the item is not sold, show the delete item refrence
                else
                    echo "
                    <td>
                        <div class='delButton'> 
                            <a href='#".$data[$i]['item_id']."'>-</a>
                        </div>
                        <div id='".$data[$i]['item_id']."' class='modal'>
                            <div class='content'>
                                <h4>Are you sure?</h4>
                                <a href='../../data_src/api/user/delete.php?item_id=".$data[$i]['item_id']."'>yes</a>
                                <a href='#'>no</a>
                            </div>
                        </div>
                    </td>
                    ";
                echo "</tr>";
            }
        ?>
    </table>
    <?php
    // add the footer
    require_once "../footer.php";
    ?>
</body>
</html>