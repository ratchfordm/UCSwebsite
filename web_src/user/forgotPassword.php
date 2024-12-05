<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot your Password</title>

    <!-- Stylesheets -->
    <link href="../css/global.css" rel="stylesheet">

    <?php
    /*
    Author: Asher Wayde
    The purpose of this file is to pass the email to the reset password page, which will deal with the logic of reseting the password
    */
    // if you are logged in, kick you to the display items page, and don't let you reset your password
    // TODO: centralize this and the logo bar to a file to reduce technical debt
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
    <!-- This collects emails and sends it to the reset password page -->
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
// adding the footer page
    require_once "../footer.php";
?>
</html>