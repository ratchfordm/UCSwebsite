<nav>
    <a class='noNav' href='https://conv.chaponline.com'>
        <img src='../images/UCSlogo.png' class='navLogo' alt='UCS Logo'>
    </a>
    <ul>
    <li>
        <a>Add items</a>
    </li>
<?php
//session_start();
if($_SESSION['logged_in']){
    echo "<li><a>".$_SESSION['first_name'];
    echo " ";
    echo $_SESSION['last_name']."</a></li>";
}
else
    header('location:login.php');
?>
    
</ul>
</nav>