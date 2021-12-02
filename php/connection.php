<?php
$server="localhost";
$db="avs";
$username="root";
$password="";
$GLOBALS['date']=date("Y-m-d");
$GLOBALS['date_time']=date("g:i A");
$GLOBALS['conn']= new mysqli ($server,$username,$password,$db);
if($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}
else{
//echo "Connected successfully";
}
?>
