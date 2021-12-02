<html lang="en">
  <head>
  <title>upload</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  
  <script src="../fonts/css/all.min.css"></script>
  <script src="../js/jquery.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  
<style>
.w3-modal{
    z-index:3;
    display:block;
    padding-top:100px;
    position:fixed;
    left:0;
    top:0;
    width:100%;
    height:100%;
    overflow:auto;
    align-content:center;
    background-color:rgb(0,0,0);
    background-color:rgba(0,0,0,0.4)}
  
  .w3-animate-zoom {animation:animatezoom 0.6s}@keyframes animatezoom{from{transform:scale(0)} to{transform:scale(1)}}
  
  .w3-modal-content
  {
  
     height: auto; 
     overflow: auto;
       border-radius: 15px;
       padding: 10px;
       margin: 10px 10px 50px;
    width:  auto;
    display: block;
  padding-bottom: 40px;
  background-color: (232, 235, 235)
  
  }
 
</style>
  </head>
  <body class="bg-dark">
    <div id="display_message_pass">
    </div>
<?php
session_start();
include "connection.php";

//checkif email exist in the database
if(isset($_POST['submit_email'])&&isset( $_POST['account_type']))
{
  $type=$_POST['account_type'];
  $email=$_POST['email'];
  if($type=="Client")
  {
    $sql=" SELECT `client`.`email`, `account`.`Account_ID` FROM `client` LEFT JOIN `account` ON `account`.`Client_ID` = `client`.`Client_ID` WHERE `client`.`email`='$email' ";
    $result=$conn->query($sql);
    if($result->num_rows>0)
    {$id=null;
      while( $row=$result->fetch_assoc())
      {
        $_SESSION["reset_ID"]=$row['Account_ID'];
        $id=$row['Account_ID'];
      }
      $new_password=generate_password();

      echo'
      
   
      <div id= "toadd" class="show" >
      <div class=" w3-animate-zoom">
        <div class="container p-2" id="success" >
            <div class="alert alert-success alert-dismissible fade show">
            <p class="w-100"><strong>!</strong> we have Found your email do you want to reset the password</p>
                
                <form action="change_password_email.php" method="POST" >
                <input type="text" hidden value="'.$id.'"  name="account_id">
                <input type="text" hidden value="'.$new_password.'"  name="password">
                <input type="text" hidden value="'.$email.'"  name=" email">
                <input type ="submit" name="text" value=" ok " style="width: 100px;"  class="mx-auto btn btn-success mx-0 my-4">
                <button type="button" onclick="got_to_back()"class="btn btn-danger align-self-center my-3" data-dismiss="alert">no</button>
                <form>
            </div>
        </div>
      </div>
    </div>';
    }
    else
    {
      echo'
   
            <div id= "toadd" class="show" >
            <div class=" w3-animate-zoom">
              <div class="container p-2" id="success" >
                  <div class="alert alert-danger alert-dismissible fade show">
                  <strong>!</strong> no such Email exist!!
                      <P>
                      <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button>
                  </div>
              </div>
            </div>
          </div>';
    }
  }
  elseif($type=="Broker")
  {
    $sql=" SELECT `broker`.`email`, `account`.`Account_ID` FROM `broker` LEFT JOIN `account` ON `account`.`Broker_ID` = `broker`.`Broker_ID` WHERE `broker`.`email`='$email' ";
    $result=$conn->query($sql);
    if($result->num_rows>0)
    {$id=null;
      while( $row=$result->fetch_assoc())
      {
        $_SESSION["reset_ID"]=$row['Account_ID'];
        $id=$row['Account_ID'];
      }
      $new_password=generate_password();

      echo'
      
   
      <div id= "toadd" class="show" >
      <div class=" w3-animate-zoom">
        <div class="container p-2" id="success" >
            <div class="alert alert-success alert-dismissible fade show">
            <p class="w-100"><strong>!</strong> we have Found your email do you want to reset the password</p>
                
              <form action="change_password_email.php" method="POST" >
                <input type="text" hidden value="'.$id.'"  name="account_id">
                <input type="text" hidden value="'.$new_password.'"  name="password">
                <input type="text" hidden value="'.$email.'"  name=" email">
                <input type ="submit" name="text" value=" ok" style="width: 100px;"  class="mx-auto btn btn-success mx-0 my-4">
               
                <button type="button" onclick="got_to_back()"class="btn btn-danger align-self-center my-3" >no</button>
                <form>
            </div>
        </div>
      </div>
    </div>';
    }
    else
    {
      echo'
   
            <div id= "toadd" class="show" >
            <div class=" w3-animate-zoom">
              <div class="container p-2" id="success" >
                  <div class="alert alert-danger alert-dismissible fade show">
                  <strong>!</strong> no such Email exist!!
                      <P>
                      <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button>
                  </div>
              </div>
            </div>
          </div>';
    }

  }
  elseif($type=="AVC")
  {
    $sql=" SELECT `avc`.`Email`, `account`.`Account_ID` FROM `avc` LEFT JOIN `account` ON `account`.`AVC_ID` = `avc`.`AVC_ID` WHERE `avc`.`Email`='$email' ";
    $result=$conn->query($sql);
    if($result->num_rows>0)
    {
      $id=null;
      while( $row=$result->fetch_assoc())
      {
        $_SESSION["reset_ID"]=$row['Account_ID'];
        $id=$row['Account_ID'];
      }
      $new_password=generate_password();

        echo'
        
    
        <div id= "toadd" class="show" >
        <div class=" w3-animate-zoom">
          <div class="container p-2" id="success" >
              <div class="alert alert-success alert-dismissible fade show">
             <p class="w-100"><strong>!</strong> we have Found your email do you want to reset the password</p>
             <form action="change_password_email.php" method="POST" >
             <input type="text" hidden value="'.$id.'"  name="account_id">
             <input type="text" hidden value="'.$new_password.'"  name="password">
             <input type="text" hidden value="'.$email.'"  name="email">
             <input type ="submit" name="text" value=" ok " style="width: 100px;"  class="mx-auto btn btn-success mx-0 my-4">
               
             <button type="button" onclick="got_to_back()"class="btn btn-danger align-self-center my-3" data-dismiss="alert">no</button>
             <form>
              </div>
          </div>
        </div>
      </div>';
    }
    else
    {
      echo'
   
            <div id= "toadd" class="show" >
            <div class=" w3-animate-zoom">
              <div class="container p-2" id="success" >
                  <div class="alert alert-danger alert-dismissible fade show">
                  <strong>!</strong> no such Email exist!!
                      <P>
                      <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button>
                  </div>
              </div>
            </div>
          </div>';
    }
  }

  elseif($type=="Admin")
  {
    $sql=" SELECT `admin`.`Email`, `account`.`Account_ID` FROM `admin` LEFT JOIN `account` ON `account`.`Admin_ID` = `admin`.`Admin_ID` WHERE `admin`.`Email`='$email' ";
    $result=$conn->query($sql);
    if($result->num_rows>0)
    {
      $id=null;
      while( $row=$result->fetch_assoc())
      {
        $_SESSION["reset_ID"]=$row['Account_ID'];
        $id=$row['Account_ID'];
      }
      $new_password=generate_password();

        echo'
        
    
        <div id= "toadd" class="show" >
        <div class=" w3-animate-zoom">
          <div class="container p-2" id="success" >
              <div class="alert alert-success alert-dismissible fade show">
             <p class="w-100"><strong>!</strong> we have Found your email do you want to reset the password</p>
             <form action="change_password_email.php" method="POST" >
             <input type="text" hidden value="'.$id.'"  name="account_id">
             <input type="text" hidden value="'.$new_password.'"  name="password">
             <input type="text" hidden value="'.$email.'"  name="email">
             <input type ="submit" name="text" value=" ok " style="width: 100px;"  class="mx-auto btn btn-success mx-0 my-4">
               
             <button type="button" onclick="got_to_back()"class="btn btn-danger align-self-center my-3" data-dismiss="alert">no</button>
             <form>
              </div>
          </div>
        </div>
      </div>';
    }
    else
    {
      echo'
   
            <div id= "toadd" class="show" >
            <div class=" w3-animate-zoom">
              <div class="container p-2" id="success" >
                  <div class="alert alert-danger alert-dismissible fade show">
                  <strong>!</strong> no such Email exist!!
                      <P>
                      <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button>
                  </div>
              </div>
            </div>
          </div>';
    }
  }

}
function generate_password()
{
 $generator="0123456789abCdeFghijKlmnopqrstUVwxYz";
  $generator=str_shuffle($generator);
  $generator=substr($generator,7,8);
 
  return $generator;
}

?>
 <script>
  function got_to_back()
  {
    history.back();
  }
 
 
  </script>
  </body>
  </html>
