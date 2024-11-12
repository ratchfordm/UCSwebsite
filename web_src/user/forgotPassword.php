<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot your Password</title>
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
    <h2>Forgot Password</h2>
    <form action="resetPassword.php" method="post">
        <label for="user_email">What's your email address</label><br>
        <input type="email" id="user_email" name="user_email" required><br><br>
        <input type="submit" value="Next">
    </form>
    <p>
        Return to the
        <a href='login.php'>Login Page</a>
    </p>
</body>
<?php
    require_once "../footer.php";
?>
</html>