<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Stylesheets -->
    <link href="../css/global.css" rel="stylesheet">
    <?php
    /*
    Author: Asher Wayde
    This is the main page for the login to a user account 
    */
    session_start();
    // This will kick you to the logged in page if you are logged in
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
    // if there is a message about registration or password reset, show it here
    if(array_key_exists("msg",$_SESSION)){
        echo "<p>".$_SESSION['msg']."</p>";
        $_SESSION['msg']='';
    }
    ?>
    <!-- Login Form -->
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