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
        <img src="../images/AdminLogo.png" class="loginLogo" alt="CHAP UCS Admin">
    </div>
    <h2>Login</h2>
    <form action="./authenticate.php">
        
        
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br><br>
        <label for="pass">Password:</label><br>
        <input type="text" id="pass" name="pass"><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>