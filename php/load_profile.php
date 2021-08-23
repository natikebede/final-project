<?php


include "connection.php";

    $AVC_ID=$_SESSION['AVC_ID'];
    $conn=$GLOBALS['conn'];
    $sql = "SELECT `avc`.`name`,`avc`.`email`, `avc`.`Profile_pic`, `avc`.`create_date`, `avc`.`License_status`, `account`.`Username`, `account`.`Password`
     FROM `avc` LEFT JOIN `account` ON `account`.`AVC_ID` = `avc`.`AVC_ID`  WHERE `avc`.`AVC_ID`='$AVC_ID'";
 
 $user_name=null;
 $pwd=null;
 $email=null;
 $name=null;
 $address=array();
 $create_date=null;
 $profile_pic=null;
 $License_status=null;
 $post_amount=null;
 $phone=array();
  $result= $conn->query($sql);
  if($result!=false && $result->num_rows ==1)
  {

    while($row=$result->fetch_assoc())
    {
        echo $row['Username'];
      $user_name=$row['Username'];
      $pwd=$row['Password'];
      $email=$row['email'];
      $create_date=$row['create_date'];
      $profile_pic=$row['Profile_pic'];
      
      $name=$row['name'];
      echo $name;
      $License_status=$row['License_status'];
     
     

    }
    
    
    $sql="SELECT * FROM  avc_phonenumber where AVC_ID='$AVC_ID'";
    $result=$conn->query($sql);
    if($result->num_rows >0)
    {
        $phonenumber=null; 
        $count=0;
        while( $row=$result->fetch_assoc() )  
        {  
            $phonenumber=$row['Phone_number'];
            $phone[$count]=$phonenumber;
            $count++;
        }

    }
    else
    {
      echo'
 
          ';
    }
    $sql="SELECT * FROM `avc_address`  where AVC_ID='$AVC_ID'";
   
    $result=$conn->query($sql);
    if($result->num_rows >0)
    {
        $avc_address=null; 
        $count=0;
        while( $row=$result->fetch_assoc() )  
        {  
            $avc_address=$row['City'].",". $row['Wereda'];
            $address[$count]=$avc_address;
            $count++;
        }
        

    }
    else
    {
      echo'
 
          ';
    }
  }
  else
  {
    echo'<div id= "toadd" class="show" >
    <div class=" w3-animate-zoom">
      <div class="container p-2" id="success" >
          <div class="alert alert-danger alert-dismissible fade show">
          <strong>!</strong> Error:'. $sql . '<br>' . $conn->error.' !!<br>
          <strong>!</strong> Error: while reteriving account info !!
              <P>
              <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
          </div>
      </div>
    </div>
  </div>';

  }

?>