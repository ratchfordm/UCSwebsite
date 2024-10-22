<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="../css/global.css" rel="stylesheet">
</head>
<body>
    <div class='logoContainer'>
        <img src="../images/UCSlogo.png" class="loginLogo" alt="CHAP UCS">
    </div>
    <h2>Login</h2>
    <form action="authenticate.php" method="post">
        <label for="user_email">Email:</label><br>
        <input type="text" id="user_email" name="user_email" required><br><br>
        <label for="user_password">Password:</label><br>
        <input type="password" id="user_password" name="user_password" required><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
<?php
    require_once "../footer.php";
?>
</html>