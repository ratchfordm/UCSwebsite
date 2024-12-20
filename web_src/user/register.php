<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>

    <!-- Stylesheets --> 
    <link href="../css/global.css" rel="stylesheet">
    <link href='../css/user.css' rel='stylesheet'>

    <!-- Javascript -->
    <script src='js/passEnforce.js'></script>
    
    <?php
    /*
    Author: Asher Wayde
    This file has the form for registering a user account in the system. It does not execute the account creation
    */

    // if you are logged in, kick you to the login page
    session_start();
    if(array_key_exists('logged_in',$_SESSION)&& $_SESSION['logged_in'])
        header("location:displayItems.php");
    ?>
</head>
<body>
    <div class='logoContainer'>
        <img src="../images/UCSlogo.png" class="loginLogo" alt="CHAP UCS">
    </div>
    <h2>Register</h2>
    <?php
    // if there is a registration error, display it here
    if(array_key_exists('ErrCode',$_SESSION)&& $_SESSION['ErrCode']){
        echo "<p class='Err'>".$_SESSION['ErrCode']."</p>";
        $_SESSION['ErrCode']=null;
    }
    ?>
    <!-- This is the registration form -->
    <form class='loginForm' action="../../data_src/api/login/add.php" method="post">
        <div>
            <label for='first_name'>Enter Your First Name</label>
            <input type='text' id='first_name' name='first_name' required>
        </div>
        <div>
            <label for='last_name'>Enter Your Last Name</label>
            <input type='text' id='last_name' name='last_name' required>
        </div>
        <div>
            <label for="user_email">Enter Your Email</label>
            <input type="email" id="user_email" name="user_email" required>
        </div>
        <div>
            <label for="user_password1">Enter your Password</label>
            <input type="password" id="user_password1" name="user_password" required>
        </div>
        <div>
            <label for="user_password2">Enter your Password</label>
            <input type="password" id="user_password2" required>
            <p id='passErr' class='Err'></p>
        </div>
        <div>
            <input type="submit" onclick='return passwordsMatch();' value="Register">
        </div>
    </form>
    <p>
        Back The
        <a href='login.php'>Login Page</a>
    </p>
</body>
<?php
    // adding the footer
    require_once "../footer.php";
?>
</html>