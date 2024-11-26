<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset your password</title>
    <link href="../css/global.css" rel="stylesheet">
    <?php
    session_start();
    if(array_key_exists('logged_in',$_SESSION)&& $_SESSION['logged_in'])
        header("location:displayItems.php");
    
    if($_POST['user_email']){
        $data=getUser($_POST['user_email']);
        if(sizeof($data)){
            $randCode=random_int(100000,999999);
            $_SESSION['Verification_code']=$randCode;
            mail($_POST['user_email'],'The Code to Reset your email','This is your reset code for your Chap UCS account.'.$randCode);
        }
        else
            echo "The email address submitted: ".$_POST['user_email']." is not registered.";
    }
    else
        echo "No email submitted";
    ?>
</head>
<body>
    <div class='logoContainer'>
        <img src="../images/UCSlogo.png" class="loginLogo" alt="CHAP UCS">
    </div>
    <h2>Input the Code Emailed to you</h2>
    <form action="resetPassword.php" method="post">
        <label for="user_email">Enter your 6 Digit Code</label><br>
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