<?php
/*
Author: Asher Wayde
This file adds items to the database from the user console
*/

session_start();

// don't let this function be accessed by people who are not logged in
if(!$_SESSION['logged_in'])
    header('location:../../index.php');

require_once "../../../data_src/db_functions.php";

// this interperts the donation checkbox as a boolean value to insert into the database
$donation=1;
if($_GET['donation']=='on')
    $donation=0;

// iterate through the array of parameters for an item
$keys=array_keys($_GET);
for($i=0;$i<sizeof($_GET);$i++){
    // if you find any that are empty, and change them to be null values which will be accepted by the database
    if($_GET[$keys[$i]]=='')
        $_GET[$keys[$i]]=NULL;
}
// find the user id from the user logged in and report it as an int
$sql='select user_id from users where user_email="'.$_SESSION['user_email'].'";';
$user_id=$functions->queryDB($sql);
$user_id=$user_id[0]['user_id'];
// find the event id that is soonest to take place
// TODO: Change this so maybe it can be selected/changed in a different way
$sql='select event_id from events order by event_begin_date desc limit 1;';
$event_id=$functions->queryDB($sql);
$event_id=$event_id[0]['event_id'];


// once all of the values are gotten, add them to the database correctly
$result=$functions->insertInto([$user_id, $_GET['category'], $event_id, strval($_GET['isbn']), $_GET['title'], $_GET['author'], $_GET['price'], $_GET['year'],$donation ], "items");
// if it succeeds to add it, send a message back to the client
if($result){
    $_SESSION['addMsg']='Item Sucessfully Added';
}
// if it fails, let the client know
else{
    $_SESSION['addMsg']='Network Error, Please try again later';
}
// send the client back to the add item page
header('location:../../../web_src/user/addItem.php');
?>