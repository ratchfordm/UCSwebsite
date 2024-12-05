<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset your password</title>

    <!-- Stylesheets -->
    <link href="../css/global.css" rel="stylesheet">

    <?php
    // don't allow the user to do this if they are logged in
    session_start();
    if(array_key_exists('logged_in',$_SESSION)&& $_SESSION['logged_in'])
        header("location:displayItems.php");
    ?>
</head>
<body>
    <div class='logoContainer'>
        <img src="../images/UCSlogo.png" class="loginLogo" alt="CHAP UCS">
    </div>
    <?php
        // this is if they have input the verification code, and are ready to reset their password
        if(array_key_exists('Verification_code',$_SESSION) & array_key_exists('Verification_code',$_POST)){
            // if both of the verification codes match, allow them to access the password reset form
            if($_SESSION['Verification_code']==$_POST['Verification_code'])
                echo '
                    <script src="js/passEnforce.js"></script>
                    <h2>Input your new password</h2>
                    <form action="../../data_src/api/login/update.php" method="post">
                        <label for="user_password1">Enter Your new password</label><br>
                        <input type="password" id="user_password1" name="user_password1" required><br><br>
                        <label for="user_password2">Retype your new password</label><br>
                        <input type="password" id="user_password2" name="user_password2" required><br><br>
                        <p id="passErr" class="Err"></p>
                        <input type="submit" onclick="return passwordsMatch();" value="Next">
                    </form>
                    ';
            // else they inputted the incorrect code
            else
                echo "<p class='Err'>Incorrect Code</p><a href='forgotPassword.php'>Start over</a>";
            
        }
        // else if they entered an email, send them a verification code
        else if($_POST['user_email']){
        // don't send them an email if they aren't in the system
        require_once "../../data_src/api/login/read.php";
        $data=getUser($_POST['user_email']);
        if(sizeof($data)){
            // preparing the code
            $randCode=random_int(100000,999999);
            $_SESSION['Verification_code']=$randCode;
            $_SESSION['user_email']=$_POST['user_email'];
            $_SESSION['user_id']=$data[0]['user_id'];

            // if the email is sent, ask them for the verification code
            if(mail($_POST['user_email'],'The Code to Reset your email','This is your reset code for your Chap UCS account\n Do not Share this code with anyone'.$randCode)){
                echo '
                <h2>Input the Code Emailed to you</h2>
                <form action="resetPassword.php" method="post">
                    <label for="Verification_code">Enter your 6 Digit Code</label><br>
                    <input type="number" id="code" name="Verification_code" required><br><br>
                    <input type="submit" value="Next">
                </form>
                ';
            }
        }
        // if they aren't in the database don't send an email, and echo an error
        else
            echo "The email address submitted: ".$_POST['user_email']." is not registered.";
    }
    // if they don't put in an email, don't let them do anything
    else
        echo "No email submitted";
    ?>
    
    <p>
        Return to the
        <a href='login.php'>Login Page</a>
    </p>
</body>
<?php
    // Footer   
    require_once "../footer.php";
?>
</html>