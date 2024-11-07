<?php
session_start();

//print_r($_GET);
//echo "<br>";

if(!$_SESSION['logged_in'])
    header('location:../../index.php');

require_once "../../../data_src/db_functions.php";
// user_id event_id category_id

if($_GET['donation']=='on')
    $_GET['donation']=0;
else
    $_GET['donation']=1;

$keys=array_keys($_GET);
for($i=0;$i<sizeof($_GET);$i++){
    if($_GET[$keys[$i]]=='')
        $_GET[$keys[$i]]=NULL;
    //echo $_GET[$keys[$i]];
}
$sql='select user_id from users where user_email="'.$_SESSION['user_email'].'";';
$user_id=$functions->queryDB($sql);
$user_id=$user_id[0]['user_id'];
$sql='select event_id from events order by event_begin_date desc limit 1;';
$event_id=$functions->queryDB($sql);
$event_id=$event_id[0]['event_id'];
//echo "User id=".$user_id."event_id= ".$event_id;


//print_r($_GET);
$functions->insertInto([$user_id, $_GET['category'], $event_id, $_GET['isbn'], $_GET['title'], $_GET['author'], $_GET['price'], $_GET['year'],$_GET['qty'],$_GET['donation'] ], "items");
header('location:../../../web_src/user/displayItems.php');
?>