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
  <body>
<?php
include "connection.php";
$user_name=$_POST['username'];
$conn=$GLOBALS['conn'];
$pwd=md5($_POST['password']);
$sql="SELECT * FROM  account where Username='$user_name' and password ='$pwd'";
$result= $conn->query($sql);
if($result->num_rows ==1)
{
    $username=null;
    $password=null;
    $role=null;
    $Account_status=null;
    $AVC_ID=null;
    $admin_ID=null;
    $client_ID=null;
    $broker_ID=null;
    $account_ID=null;
    while( $row=$result->fetch_assoc() )  
    {   $username=$row['Username'];
        $password=$row['Password'];
        $role=$row['Role'];
        $client_ID=$row['Client_ID'];
        $admin_ID=$row['Admin_ID'];
        $broker_ID=$row['Broker_ID'];
        $AVC_ID=$row['AVC_ID'];
        $account_ID=$row['Account_ID'];
        $Account_status=$row['Account_status'];
    }


    //if the account is for client
    if($role=='Client')
    {
       session_start();
        $_SESSION['Client_ID']=$client_ID;
        $_SESSION['Account_ID']=$account_ID;
        $_SESSION['Username']=$username;
        $_SESSION['Password']=$password; 
        if($Account_status=='Suspended')
        {
          echo'
 
            <div id= "toadd" class="w3-modal" >
            <div class="w3-modal-content w3-animate-zoom">
              <div class="container" id="success" >
                  <div class="alert alert-danger alert-dismissible fade show">
                      <strong>!</strong> your Account has been suspended by the system Administator 
                      for violating  guidlines wait  acouple of days until the issue is resolved !!
                      <P>
                      <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                  </div>
              </div>
            </div>
          </div>

            ';

        }
        else
        {
          $sql="UPDATE client SET Account_status='active' WHERE Client_ID='$client_ID'";
          if($conn->query($sql)===true)
          {
  
            echo'<script> window.location.href="../clientpage.php"; </script>';
  
          }
          else
          {
            echo'
   
              <div id= "toadd" class="w3-modal" >
              <div class="w3-modal-content w3-animate-zoom">
                <div class="container" id="success" >
                    <div class="alert alert-danger alert-dismissible fade show">
                        <strong>!</strong> error occurred while changing status !!
                        <P>
                        <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                    </div>
                </div>
              </div>
            </div>
  
          ';
            
  
          }
        }
       
       

    }

    // if the account is that of ta Broker
    elseif ($role=='Broker')
    {
       session_start();
        $_SESSION['Broker_ID']=$broker_ID;
        $_SESSION['Account_ID']=$account_ID;
        $_SESSION['Username']=$username;
        $_SESSION['Password']=$password;
        if($Account_status=='Suspended')
        {
          echo'
 
            <div id= "toadd" class="w3-modal" >
            <div class="w3-modal-content w3-animate-zoom">
              <div class="container" id="success" >
                  <div class="alert alert-danger alert-dismissible fade show">
                      <strong>!</strong> your Account has been suspended by the system Administator 
                      for violating  guidlines wait  acouple of days until the issue is resolved !!
                      <P>
                      <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                  </div>
              </div>
            </div>
          </div>

            ';

        }
        else
        {

              $sql="UPDATE broker SET Account_status='active' WHERE Broker_ID='$broker_ID'";
            if($conn->query($sql)===true)
            {

              echo'<script> window.location.href="../brokerpage.php"; </script>';

            }
            else
            {
              echo'
    
                <div id= "toadd" class="w3-modal" >
                <div class="w3-modal-content w3-animate-zoom">
                  <div class="container" id="success" >
                      <div class="alert alert-danger alert-dismissible fade show">
                          <strong>!</strong> error occurred while changing status !!
                          <P>
                          <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                      </div>
                  </div>
                </div>
              </div>

        ';
              

            }


        }
    }
// if the account is that of a Company
    elseif ($role=='AVC')
    {
          session_start();
            $_SESSION['AVC_ID']=$AVC_ID;
            $_SESSION['Account_ID']=$account_ID;
            $_SESSION['Username']=$username;
            $_SESSION['Password']=$password;
            if($Account_status=='Suspended')
            {
              echo'
    
                <div id= "toadd" class="w3-modal" >
                <div class="w3-modal-content w3-animate-zoom">
                  <div class="container" id="success" >
                      <div class="alert alert-danger alert-dismissible fade show">
                          <strong>!</strong> your Account has been suspended by the system Administator 
                          for violating  guidlines wait  acouple of days until the issue is resolved !!
                          <P>
                          <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                      </div>
                  </div>
                </div>
              </div>

        ';

            }
            else
            {
              $sql="UPDATE avc SET Account_status='active' WHERE AVC_ID ='$AVC_ID'";
            if($conn->query($sql)===true)
            {

              echo'<script> window.location.href="../AVCpage.php"; </script>';

            }
            else
            {
              echo'
    
              <div id= "toadd" class="show" >
              <div class=" w3-animate-zoom">
                <div class="container p-2" id="success" >
                    <div class="alert alert-danger alert-dismissible fade show">
                    <strong>!</strong> Error:'. $sql .' <br> ' . $conn->error.' !!
                        <P>
                        <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                    </div>
                </div>
              </div>
            </div>

        ';
              

            }
            }


    }

    //if the account is  of that of  Admin
    elseif ($role=='Admin')
    {
       session_start();
        $_SESSION['Admin_ID']=$admin_ID;
        $_SESSION['Account_ID']=$account_ID;
        $_SESSION['Username']=$username;
        $_SESSION['Password']=$password;
        if($Account_status=='Suspended')
        {
          echo'
 
            <div id= "toadd" class="w3-modal" >
            <div class="w3-modal-content w3-animate-zoom">
              <div class="container" id="success" >
                  <div class="alert alert-danger alert-dismissible fade show">
                      <strong>!</strong> your Account has been suspended by the system Administator 
                      for violating  guidlines wait  acouple of days until the issue is resolved !!
                      <P>
                      <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                  </div>
              </div>
            </div>
          </div>

               ';

        }
        else
        {
         // echo'<script> window.location.href="../Adminpage.php"; </script>';
          $sql="UPDATE admin SET Account_status='active' WHERE Admin_ID ='$admin_ID'";
          if($conn->query($sql)===true)
          {
  
            echo'<script> window.location.href="../Adminpage.php"; </script>';
  
          }
          else
          {
            echo'
   
            <div id= "toadd" class="show" >
            <div class=" w3-animate-zoom">
              <div class="container p-2" id="success" >
                  <div class="alert alert-danger alert-dismissible fade show">
                  <strong>!</strong> Error:'. $sql .' <br> ' . $conn->error.' !!
                      <P>
                      <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                  </div>
              </div>
            </div>
          </div>
  
      ';
            
  
          }

        }
       

    }
}
else
{
    echo'
  
  
  
 
  <div id= "toadd" class="w3-modal" >
  <div class="w3-modal-content w3-animate-zoom">
    <div class="container" id="success" >
        <div class="alert alert-danger alert-dismissible fade show">
            <strong>!</strong> username or password incorrect !!
            <P>
            <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
        </div>
    </div>
  </div>
</div>
  
  
  
  
  
    ';
  
  }
  
  
  
    
  
  ?>
  
  
  </div>
  <script>
  function got_to_back()
  {
    history.back();
  }
  </script>
  </body>
  </html>
