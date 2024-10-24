<nav>
    <a class='noNav' href='https://conv.chaponline.com'>
        <img src='../images/UCSlogo.png' class='navLogo' alt='UCS Logo'>
    </a>
    <ul>
    <li>
        <a href="addItem.php">Add Items</a>
    </li>
    <li>
        <a href='displayItems.php'>View Items</a>
    </li>
    <li>
        <a href='printBarcodes.php'>Print Barcodes</a>
    </li>
    <li>
        <a>Account</a>
    </li>
<?php
//session_start();
if(!$_SESSION['logged_in'])
    header('location:login.php');
?>
    
</ul>
</nav>