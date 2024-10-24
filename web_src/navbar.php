<nav>
    <a class='noNav' href='https://conv.chaponline.com'>
        <img src='../images/UCSlogo.png' class='navLogo' alt='UCS Logo'>
    </a>
    <ul>
    <li>
        <a class='navButton' href="addItem.php">Add Items</a>
    </li>
    <li>
        <a class='navButton' href='displayItems.php'>View Items</a>
    </li>
    <li>
        <a class='navButton' href='printBarcodes.php'>Print Barcodes</a>
    </li>
    <!--<li>
        <div class='navButton dropdown'>
            <a class='dropBtn'>Account</a>
            <div class='dropdown-content'>
                <a href=""></a>
                <a href=""></a>
                <a href=""></a>
            </div>

        </div>
    </li>-->
<?php
session_start();
if(!$_SESSION['logged_in'])
    header('location:login.php');

?>
    
</ul>
</nav>