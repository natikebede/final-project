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

<?php
include "connection.php";
if(isset($_POST['account_id'])&&isset($_POST['password'])&&isset($_POST['email']))
{
    $email=$_POST['email'];
    $account_id=$_POST['account_id'];
    $password=$_POST['password'];
    //email($email,$password);
    change_password($account_id,$password,$email);

     
}
function email($email,$password)
{
    //echo '<script> alert("Service Request of  ' . $email . '  Has Been accepted"); </script> >';
    $to=$email;
    $subject="password reset";
    $message="your AVS account password has been reseted\n your new password is given \n
                    password: ".$password. " 
                    \n change your password after you login";
    $headers="From: natikebede119@gmail.com";
    $mail_sent=mail($to,$subject,$message,$headers);
    if($mail_sent==true)
    {
        echo'
      
   
        <div id= "toadd" class="show" >
        <div class=" w3-animate-zoom">
          <div class="container p-2" id="success" >
              <div class="alert alert-success alert-dismissible fade show">
              <strong>!</strong> your password has been changed check your Email for the new password
                  
                   <button type="button" onclick="got_to_back()"class="btn btn-danger align-self-center my-3" data-dismiss="alert">ok</button></P>
              
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
              <strong>!</strong> failed to send email check your connection
                  
                   <button type="button" onclick="got_to_back()"class="btn btn-danger align-self-center my-3" data-dismiss="alert">ok</button></P>
              
              </div>
          </div>
        </div>
      </div>';
        

    }
    

}
function change_password($account_id,$password,$email)
{
    $conn=$GLOBALS['conn'];
    $passwords=$password;
    $password=md5($password);
    
 $sql="UPDATE `account` SET `Password` = '$password' WHERE `account`.`Account_ID` ='$account_id'";
 if($conn->query($sql)===true)
 {
    email($email,$passwords);

 }
 else
 {
    echo'
   
            <div id= "toadd" class="show" >
            <div class=" w3-animate-zoom">
              <div class="container p-2" id="success" >
                  <div class="alert alert-danger alert-dismissible fade show">
                  <strong>!</strong> failed to reset password!!
                      <P>
                      <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                  </div>
              </div>
            </div>
          </div>';

 }


}
?>
<script>
  function got_to_back()
  {
    window.location.href="../index.php";
  }
 
 
  </script>
  </body>
  </html>
