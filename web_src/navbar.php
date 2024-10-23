<nav>
    
<?php
//session_start();
if($_SESSION['logged_in']){
    echo "<a class='noNav' href='https://conv.chaponline.com'><img src='../images/";
    if($_SESSION['admin_level'])
        echo "AdminLogo.png' alt='Admin";
    else
        echo "UCSlogo.png' alt='";
    echo " UCS Logo' class='navLogo'></a>";
    ?>
    <ul>
    <li>
        <a>Add items</a>
    </li>
    <?php
    echo "<li><a>".$_SESSION['first_name'];
    echo " ";
    echo $_SESSION['last_name']."</a></li>";
}
else
    header('location:login.php');
?>
    
</ul>
</nav>