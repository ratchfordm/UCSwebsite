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
    ?>
    <table>
        <thead>
            <tr>
                <td>
                    Your Items
                </td>
                <td>
                    Quantity
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
                    Delete item
</td>
            </tr>
        </thead>
        <?php
            
            require_once "../../data_src/api/user/read.php";
            //print_r($data);
            for($i=0;$i<sizeof($data);$i++){
                echo "<tr>";
                
                echo "<td><a href=item.php?id=".$data[$i]['item_id'].">".$data[$i]['title']."</a></td>";
                echo "<td> ".$data[$i]['qty']."</td>";
                echo "<td> $".$data[$i]['price']."</td>";
                if($data[$i]['donation'])
                    echo "<td>No</td>";
                else
                    echo "<td>Yes</td>";
                if($data[$i]['sold'])
                    echo "<td>Yes</td>";
                else
                    echo "<td>No</td>";

                echo "<td><button value='".$data[$i]['item_id']."'>-</button></td>";
                echo "</tr>";
            }
        ?>
    </table>
    <?php
    require_once "../footer.php";
    ?>
</body>
</html>