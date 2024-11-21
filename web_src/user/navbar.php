<nav>
    <a class='noNav' href='https://conv.chaponline.com'>
        <img src='../images/UCSlogo.png' class='navLogo' alt='UCS Logo'>
    </a>
    <ul>
        <!-- Update this to not die when squished probably just use divs-->
    <li>
        <div class='navButtonContainer'>
            <a class='navButton' href="addItem.php">Add Items</a>
        </div>
    </li>
    <li>
        <div class='navButtonContainer'>
            <a class='navButton' href='displayItems.php'>View Items</a>
        </div>
    </li>
    <li>
        <div class='navButtonContainer'>
            <a class='navButton' href='printBarcodes.php' target="_blank">Print Barcodes</a>
        </div>
    </li>
    <li>
        <div class='navButtonContainer'>
            <a class='navButton' href='instructions.php'>FAQ</a>
        </div>
    </li>
    <li >
        <div class='navButtonContainer'>
            <div class='navButton dropdown'>
                <a class='dropBtn'>Account</a>
                <div class='dropdown-content'>
                    <a href="settings.php">settings</a>
                    <a href="logout.php">logout</a>
                </div>

            </div>
        </div>
    </li>
    
<?php
session_start();
if(!$_SESSION['logged_in'])
    header('location:login.php');

    if($_SESSION['admin_level'])
        echo "<li>
    <div class='navButtonContainer'>
            <a class='navButton' href='../admin/console.php'>Admin Console</a>
        </div>
    </li>";
?>
    
</ul>
</nav>