<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operator Login Page</title>
    <link href="../css/global.css" rel="stylesheet">
</head>
<body>
    <div class='logoContainer'>
        <img src="../images/UCSlogo.png" class="loginLogo" alt="CHAP UCS">
    </div>
    <h2>Operator Login</h2>
    <form action="authenticate.php" method="post">
        <label for="operator_code">Operator Code:</label><br>
        <input type="text" id="operator_code" name="operator_code" required><br><br> 
        <input type="submit" value="Submit">
    </form>
</body>
<?php
    require_once "../footer.php";
?>
</html>