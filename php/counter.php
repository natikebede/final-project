<?php
include 'connection.php';
$total_counter=null;
$total_client_counter=null;
$total_Broker_counter=null;
$total_company_counter=null;
$total_reqest_pending=null;

$sql="SELECT COUNT(License_ID) FROM license where License_status='pending' ";
$result=$conn->query($sql);
if($result->num_rows >0)
{
    while( $row=$result->fetch_assoc() )
    {
        $total_reqest_pending=$row['COUNT(License_ID)'];
    }
}
else
{
    
}




$sql="SELECT COUNT(Account_ID) FROM account ";
$result=$conn->query($sql);
if($result->num_rows >0)
{
    while( $row=$result->fetch_assoc() )
    {
        $total_counter=$row['COUNT(Account_ID)'];
    }
}
else
{
    
}

$sql="SELECT COUNT(Client_ID) FROM client ";
$result=$conn->query($sql);
if($result->num_rows >0)
{

    while( $row=$result->fetch_assoc() )
    {
        $total_client_counter=$row['COUNT(Client_ID)'];
    }
}
else
{
    
}

$sql="SELECT COUNT(Broker_ID) FROM broker ";
$result=$conn->query($sql);
if($result->num_rows >0)
{

    while( $row=$result->fetch_assoc() )
    {
        $total_Broker_counter=$row['COUNT(Broker_ID)'];

    }
}
else
{
    
}

$sql="SELECT COUNT(AVC_ID) FROM avc ";
$result=$conn->query($sql);
if($result->num_rows >0)
{

    while( $row=$result->fetch_assoc() )
    {
        $total_company_counter=$row['COUNT(AVC_ID)'];

    }
}
else
{
    
}

?>