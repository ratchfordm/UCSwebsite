<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Items</title>
    <link href="../css/user.css" rel='stylesheet'>
    <link href="../css/global.css" rel='stylesheet'>

</head>
<body>
    <?php
    //session_start();
    require_once "navbar.php";
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    if(key_exists('deleteMsg',$_SESSION)){
        echo $_SESSION['deleteMsg']."</p>";
        $_SESSION['deleteMsg']=null;
    }
    
    ?>
    <table>
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
            
            require_once "../../data_src/api/user/read.php";
            $data=readItems();
            //print_r($data);
            for($i=0;$i<sizeof($data);$i++){
                echo "<tr>";
                if(strlen($data[$i]['title'])>78){
                    $data[$i]['title']=substr($data[$i]['title'],0,78)."...";
                }
                echo "<td class='title'><a href=item.php?id=".$data[$i]['item_id'].">".$data[$i]['title']."</a></td>";
                echo "<td> $".$data[$i]['price']."</td>";
                if($data[$i]['donation'])
                    echo "<td>No</td>";
                else
                    echo "<td>Yes</td>";
                if($data[$i]['sold'])
                    echo "<td>Yes</td>";
                else
                    echo "<td>No</td>";
                echo "<td>".$data[$i]['category_description']."</td>";
                if($data[$i]['sold'])
                    echo "<td></td>";
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
    require_once "../footer.php";
    ?>
</body>
</html>