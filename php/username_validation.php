<?php
include "connection.php";
$conn=$GLOBALS['conn'];
if(isset($_GET['username'])){
$user_name= $_GET['username'];
$sql="SELECT * FROM account where Username='$user_name'";

$result=$conn->query($sql);
if($result->num_rows > 0)
{
    echo'invalid';
}
else
{
    echo 'valid';
}
}
if(isset($_GET['editusername'])){
    $user_name= $_GET['username'];
    $sql="SELECT * FROM account where not Username='$user_name'";
    
    $result=$conn->query($sql);
    if($result->num_rows > 0)
    {
        echo'invalid';
    }
    else
    {
        echo 'valid';
    }
    }
?>