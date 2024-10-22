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
    require_once "../navbar.php";
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
            </tr>
        </thead>
        <?php
            require_once "../../data_src/api/user/read.php";
            //print_r($data);
            for($i=0;$i<sizeof($data);$i++){
                echo "<tr>";
                
                echo "<td> ".$data[$i]['title']."</td>";
                echo "<td> ".$data[$i]['qty']."</td>";
                echo "<td> ".$data[$i]['price']."</td>";
                if($data[$i]['donation'])
                    echo "<td>No</td>";
                else
                    echo "<td>Yes</td>";
                
                echo "</tr>";
            }
        ?>
    </table>
    <?php
    require_once "../footer.php";
    ?>
</body>
</html>