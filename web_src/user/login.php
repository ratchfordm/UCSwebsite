<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="../css/global.css" rel="stylesheet">
    <?php
    session_start();
    if(array_key_exists('logged_in',$_SESSION)&& $_SESSION['logged_in'])
        header("location:displayItems.php");
    ?>
</head>
<body>
    <div class='logoContainer'>
        <img src="../images/UCSlogo.png" class="loginLogo" alt="CHAP UCS">
    </div>
    <h2>Login</h2>
    <?php
    if(array_key_exists("msg",$_SESSION)){
        echo "<p>".$_SESSION['msg']."</p>";
        $_SESSION['msg']='';
    }
    ?>
    <form action="authenticate.php" method="post">
        <label for="user_email">Email:</label><br>
        <input type="email" id="user_email" name="user_email" required><br><br>
        <label for="user_password">Password:</label><br>
        <input type="password" id="user_password" name="user_password" required><br><br>
        <p>
            <a href='forgotPassword.php'>Forgot Your Password?</a>
        </p>
        <br>
        <input type="submit" value="Login">
    </form>
    
    <p>
        don't have an account?
        <a href='register.php'>Register Here</a>
    </p>
</body>
<?php
    require_once "../footer.php";
?>
</html>