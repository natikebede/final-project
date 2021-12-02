<?php
include "connection.php";
if(isset($_POST['set']))
{
    $sql="SELECT * FROM `asset` ";
    $result=$conn->query($sql);
    if ($result->num_rows>0)
    {
        while( $row=$result->fetch_assoc() )  
        {
          $Asset_ID=$row['Asset_ID'];
          $Asset_name=$row['Asset_name'];
           echo' <option value="'.$Asset_ID.'">'.$Asset_name.'</option>';

            
        }
        
    }
    else
    {

    }
}

?>