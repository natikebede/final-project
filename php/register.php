<!DOCTYPE html>
<html lang="en">
    <head>
        <title>AVS.com</title>
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
session_start();
if (isset($_POST["signup_client"]))
{
   
    client();
    
}
elseif (isset($_POST["signup_Broker"])) 
{
   
    broker();
}
elseif (isset($_POST["signup_company"])) 
{
    company();
}

elseif (isset($_POST["signup_admin"])) 
{
  Admin();
}
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%for resjistering client%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
function client()
{
    $f_name=$_POST['firstname'];
    $l_name=$_POST['lastname'];
    $user_name=$_POST['username'];
    $pwd=md5($_POST['password']);
    $email=$_POST['email'];
    $phone=$_POST['phonenumber'];
    $city=$_POST['city'];
    $wereda=$_POST['wereda'];
    $conn=$GLOBALS['conn'];
    $date=$GLOBALS['date'];
    
    $sql="INSERT INTO client( First_name, Last_name, email, city, wereda, create_date) 
     VALUES ('$f_name','$l_name','$email','$city','$wereda','$date')";
     if($conn->query($sql)===true)
     {
      $Client_ID= $conn->insert_id;
        $sql="INSERT INTO client_phonenumber( Client_ID, Phone_number) VALUES ('$Client_ID','$phone')";
        if($conn->query($sql)===true)
        {
            $sql=" INSERT INTO account( Username, Password, Role,  Client_ID )
             VALUES ('$user_name','$pwd','Client','$Client_ID')";
             if($conn->query($sql)===true)
             {
              
              $_SESSION['Client_ID']=$Client_ID;

              echo'<div id= "toadd" class="" >
              <div class=" w3-animate-zoom">
                <div class="container" id="success" >
                    <div class="alert alert-success alert-dismissible fade show">
                        <strong>!</strong> account Created  !!
                        <P>
                        <button type="button" onclick="go_to_home_client()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                    </div>
                </div>
              </div>
            </div>';
             }
             else
             {
                $sql=" DELETE FROM Client WHERE Client_ID='$Client_ID'";
                if ($conn->query($sql) === TRUE)
                 {
                    echo "Record deleted successfully";
                  } 
                  else
                  {
                    echo'
 
      <div id= "toadd" class="" >
      <div class="">
        <div class="container" id="success" >
            <div class="alert alert-success alert-dismissible fade show">
                <strong>!</strong> there was '.$sql.' error '.$conn->error.'!!
                <P>
                <button type="button" onclick="got_to_back() "class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
            </div>
        </div>
      </div>
    </div>';
                  }
                  echo'
 
                  <div id= "toadd" class="" >
                  <div class="">
                    <div class="container" id="success" >
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong>!</strong> there was '.$sql.' error '.$conn->error.'!!
                            <P>
                            <button type="button" onclick="got_to_back() "class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                        </div>
                    </div>
                  </div>
                </div>';
               
             }

        }
        else
        {
            $sql=" DELETE FROM Client WHERE Client_ID='$Client_ID'";
            if ($conn->query($sql) === TRUE)
             {
              echo'<div id= "toadd" class="" >
              <div class="">
                <div class="container" id="success" >
                    <div class="alert alert-success alert-dismissible fade show">
                        <strong>!</strong> record Broker deleted !!
                        <P>
                        <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                    </div>
                </div>
              </div>
            </div>';
              } 
              else
              {
                echo'
 
      <div id= "toadd" class="" >
      <div class="">
        <div class="container" id="success" >
            <div class="alert alert-success alert-dismissible fade show">
                <strong>!</strong> there was '.$sql.' error '.$conn->error.'!!
                <P>
                <button type="button" onclick="got_to_back() "class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
            </div>
        </div>
      </div>
    </div>';
              }
              echo'
 
              <div id= "toadd" class="" >
              <div class="">
                <div class="container" id="success" >
                    <div class="alert alert-success alert-dismissible fade show">
                        <strong>!</strong> there was '.$sql.' error '.$conn->error.'!!
                        <P>
                        <button type="button" onclick="got_to_back() "class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                    </div>
                </div>
              </div>
            </div>';
        }

     }
     else
     {
      echo'
 
      <div id= "toadd" class="" >
      <div class="">
        <div class="container" id="success" >
            <div class="alert alert-success alert-dismissible fade show">
                <strong>!</strong> there was '.$sql.' error '.$conn->error.'!!
                <P>
                <button type="button" onclick="got_to_back() "class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
            </div>
        </div>
      </div>
    </div>';
     }
}

// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%for registering Broker %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
function broker()
{
    $conn=$GLOBALS['conn'];
    $date=$GLOBALS['date'];
    $f_name=$_POST['firstname'];
    $l_name=$_POST['lastname'];
    $user_name=$_POST['username'];
    $pwd=md5($_POST['password']);
    $email=$_POST['email'];
    $phone=$_POST['phonenumber'];
    $city=$_POST['city'];
    $wereda=$_POST['wereda'];
    $sql=" INSERT INTO broker( First_name, Last_name, email, City, Wereda, Create_date) 
    VALUES('$f_name','$l_name','$email','$city','$wereda','$date')";
    if($conn->query($sql)===true)
    {
      $Broker_ID= $conn->insert_id;

        $sql="INSERT INTO broker_phonenumber( Broker_ID, Phone_number)  VALUES ('$Broker_ID','$phone')";
        if($conn->query($sql)===true)
        {
            $sql=" INSERT INTO account( Username, Password, Role,  Broker_ID )
            VALUES ('$user_name','$pwd','Broker','$Broker_ID')";
            if($conn->query($sql)===true)
            {
              $sql="INSERT INTO score (Score_point,Broker_ID) VALUES (0,'$Broker_ID')";
              if($conn->query($sql)===true)
              {

                $_SESSION['Broker_ID']=$Broker_ID;

              echo'<div id= "toadd" class="" >
              <div class=" w3-animate-zoom">
                <div class="container" id="success" >
                    <div class="alert alert-success alert-dismissible fade show">
                        <strong>!</strong> account Created  !!
                        <P>
                        <button type="button" onclick="go_to_home_broker()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                    </div>
                </div>
              </div>
            </div>';
              }
              else
              {
                

              }
              
            }
            else
            {
                $sql=" DELETE FROM broker WHERE Broker_ID='$Broker_ID'";
            if ($conn->query($sql) === TRUE)
             {
              echo'<div id= "toadd" class="" >
                  <div class="">
                    <div class="container" id="success" >
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong>!</strong> record Broker deleted !!
                            <P>
                            <button type="button" onclick="got_to_back ()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                        </div>
                    </div>
                  </div>
                </div>';
              } 
              else
              {
                echo'
 
                <div id= "toadd" class="" >
                <div class="">
                  <div class="container" id="success" >
                      <div class="alert alert-success alert-dismissible fade show">
                          <strong>!</strong> there was '.$sql.' error '.$conn->error.'!!
                          <P>
                          <button type="button" onclick="got_to_back() "class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                      </div>
                  </div>
                </div>
              </div>';
              }
            
              echo'
 
              <div id= "toadd" class="" >
              <div class="">
                <div class="container" id="success" >
                    <div class="alert alert-success alert-dismissible fade show">
                        <strong>!</strong> there was '.$sql.' error '.$conn->error.'!!
                        <P>
                        <button type="button" onclick="got_to_back() "class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                    </div>
                </div>
              </div>
            </div>';
            }

        }
        else
        {   
            $sql=" DELETE FROM broker WHERE Broker_ID='$Broker_ID'";
            if ($conn->query($sql) === TRUE)
             {
              echo'<div id= "toadd" class="" >
              <div class="">
                <div class="container" id="success" >
                    <div class="alert alert-success alert-dismissible fade show">
                        <strong>!</strong> record Broker deleted !!
                        <P>
                        <button type="button" onclick="got_to_back ()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                    </div>
                </div>
              </div>
            </div>';
              } 
              else
              {
                echo'
 
                <div id= "toadd" class="" >
                <div class="">
                  <div class="container" id="success" >
                      <div class="alert alert-success alert-dismissible fade show">
                          <strong>!</strong> there was '.$sql.' error '.$conn->error.'!!
                          <P>
                          <button type="button" onclick="got_to_back() "class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                      </div>
                  </div>
                </div>
              </div>';
              }

              echo'
 
              <div id= "toadd" class="" >
              <div class="">
                <div class="container" id="success" >
                    <div class="alert alert-success alert-dismissible fade show">
                        <strong>!</strong> there was '.$sql.' error '.$conn->error.'!!
                        <P>
                        <button type="button" onclick="got_to_back() "class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                    </div>
                </div>
              </div>
            </div>';
           
        }
    }
    else
    {
      echo'
 
      <div id= "toadd" class="" >
      <div class="">
        <div class="container" id="success" >
            <div class="alert alert-success alert-dismissible fade show">
                <strong>!</strong> there was '.$sql.' error '.$conn->error.'!!
                <P>
                <button type="button" onclick="got_to_back() "class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
            </div>
        </div>
      </div>
    </div>';
    }

}

// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%for resjistering company %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
function company()
{

    $name=$_POST['name'];
    $user_name=$_POST['username'];
    $pwd=md5($_POST['password']);
    $email=$_POST['email'];
    $phone=$_POST['phonenumber'];
    $city=$_POST['city'];
    $wereda=$_POST['wereda'];
    $conn=$GLOBALS['conn'];
    $date=$GLOBALS['date'];
    $sql="INSERT INTO avc( name, Email , Create_date) VALUES ('$name','$email','$date')";
    if($conn->query($sql)===true)
    {
      $AVC_ID= $conn->insert_id;
        $sql="INSERT INTO   avc_phonenumber( AVC_ID, Phone_number)  VALUES ('$AVC_ID','$phone')";
        if($conn->query($sql)===true)
        {
            $sql="INSERT INTO avc_address( AVC_ID, City, Wereda) VALUES ('$AVC_ID','$city','$wereda')";
            if($conn->query($sql)===true)
            {
                $sql=" INSERT INTO account( Username, Password, Role,  AVC_ID )
                VALUES ('$user_name','$pwd','AVC','$AVC_ID')";
                if($conn->query($sql)===true)
                {
                  
                  $_SESSION['AVC_ID']=$AVC_ID;

                  echo'<div id= "toadd" class="" >
                  <div class=" w3-animate-zoom">
                    <div class="container" id="success" >
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong>!</strong> account Created  !!
                            <P>
                            <button type="button" onclick="go_to_home_AVC()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                        </div>
                    </div>
                  </div>
                </div>';
          
                }
                else
                {
                    $sql=" DELETE FROM avc WHERE AVC_ID='$AVC_ID'";
                if ($conn->query($sql) === TRUE)
                 {
                  echo'
 
                  <div id= "toadd" class="" >
                  <div class="">
                    <div class="container" id="success" >
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong>!</strong> record AVC deleted !!
                            <P>
                            <button type="button" onclick="got_to_back ()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                        </div>
                    </div>
                  </div>
                </div>';
                  } 
                  else
                  {
                    echo'
 
                <div id= "toadd" class="" >
                <div class="">
                  <div class="container" id="success" >
                      <div class="alert alert-success alert-dismissible fade show">
                          <strong>!</strong> there was '.$sql.' error '.$conn->error.'!!
                          <P>
                          <button type="button" onclick="got_to_back() "class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                      </div>
                  </div>
                </div>
              </div>';
                  }
                
                  echo'
 
                  <div id= "toadd" class="" >
                  <div class="">
                    <div class="container" id="success" >
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong>!</strong> there was '.$sql.' error '.$conn->error.'!!
                            <P>
                            <button type="button" onclick="got_to_back() "class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                        </div>
                    </div>
                  </div>
                </div>';
                }
    

            }
            else
            {
                $sql=" DELETE FROM avc WHERE AVC_ID='$AVC_ID'";
                if ($conn->query($sql) === TRUE)
                 {
                  echo'
 
                  <div id= "toadd" class="" >
                  <div class="">
                    <div class="container" id="success" >
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong>!</strong> record AVC deleted !!
                            <P>
                            <button type="button" onclick="got_to_back ()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                        </div>
                    </div>
                  </div>
                </div>';
                  } 
                  else
                  {
                    echo "Error deleting record: " . $conn->error;
                  }
                  echo "Error:  " .$sql."<br>".$conn->error;

            }

        }
        else
        {
            $sql=" DELETE FROM avc WHERE AVC_ID='$AVC_ID'";
            if ($conn->query($sql) === TRUE)
             {
              echo'
 
              <div id= "toadd" class="" >
              <div class="">
                <div class="container" id="success" >
                    <div class="alert alert-success alert-dismissible fade show">
                        <strong>!</strong> record deleted !!
                        <P>
                        <button type="button" onclick="got_to_back() "class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                    </div>
                </div>
              </div>
            </div>';
              } 
              else
              {
                echo'
 
                <div id= "toadd" class="" >
                <div class="">
                  <div class="container" id="success" >
                      <div class="alert alert-success alert-dismissible fade show">
                          <strong>!</strong> there was '.$sql.' error '.$conn->error.'!!
                          <P>
                          <button type="button" onclick="got_to_back() "class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                      </div>
                  </div>
                </div>
              </div>';
              }
              echo'
 
              <div id= "toadd" class="" >
              <div class="">
                <div class="container" id="success" >
                    <div class="alert alert-success alert-dismissible fade show">
                        <strong>!</strong> there was '.$sql.' error '.$conn->error.'!!
                        <P>
                        <button type="button" onclick="got_to_back() "class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                    </div>
                </div>
              </div>
            </div>';
        }

    }
    else
    {
      echo'
 
      <div id= "toadd" class="" >
      <div class="">
        <div class="container" id="success" >
            <div class="alert alert-success alert-dismissible fade show">
                <strong>!</strong> there was '.$sql.' error '.$conn->error.'!!
                <P>
                <button type="button" onclick="got_to_back() "class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
            </div>
        </div>
      </div>
    </div>';

    }


}

function Admin()
{
    $conn=$GLOBALS['conn'];
    $date=$GLOBALS['date'];
    $f_name=$_POST['firstname'];
    $l_name=$_POST['lastname'];
    $user_name=$_POST['username'];
    $pwd=md5($_POST['password']);
    $email=$_POST['email'];
    $phone=$_POST['phonenumber'];
    $city=$_POST['city'];
    $wereda=$_POST['wereda'];
    $account_type=$_POST['account_type'];
    $sql=" INSERT INTO admin( First_name, Last_name, Email, City, Wereda, Create_date,Account_type) 
    VALUES('$f_name','$l_name','$email','$city','$wereda','$date','$account_type')";
    if($conn->query($sql)===true)
    {
      $Admin_ID= $conn->insert_id;

        $sql="INSERT INTO Admin_phonenumber( Admin_ID, Phone_number)  VALUES ('$Admin_ID','$phone')";
        if($conn->query($sql)===true)
        {
            $sql=" INSERT INTO account( Username, Password, Role,  Admin_ID )
            VALUES ('$user_name','$pwd','Admin','$Admin_ID')";
            if($conn->query($sql)===true)
            {
              
              

              echo'<div id= "toadd" class="" >
              <div class=" w3-animate-zoom">
                <div class="container" id="success" >
                    <div class="alert alert-success alert-dismissible fade show">
                        <strong>!</strong> account Created  !!
                        <P>
                        <button type="button" onclick="go_to_home_admin()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                    </div>
                </div>
              </div>
            </div>';
            }
            else
            {
                $sql=" DELETE FROM admin WHERE Admin_ID='$Admin_ID'";
            if ($conn->query($sql) === TRUE)
             {
              echo'<div id= "toadd" class="" >
                  <div class="">
                    <div class="container" id="success" >
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong>!</strong> record Admin deleted !!
                            <P>
                            <button type="button" onclick="got_to_back ()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                        </div>
                    </div>
                  </div>
                </div>';
              } 
              else
              {
                echo'
 
                <div id= "toadd" class="" >
                <div class="">
                  <div class="container" id="success" >
                      <div class="alert alert-success alert-dismissible fade show">
                          <strong>!</strong> there was '.$sql.' error '.$conn->error.'!!
                          <P>
                          <button type="button" onclick="got_to_back() "class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                      </div>
                  </div>
                </div>
              </div>';
              }
            
              echo'
 
              <div id= "toadd" class="" >
              <div class="">
                <div class="container" id="success" >
                    <div class="alert alert-success alert-dismissible fade show">
                        <strong>!</strong> there was '.$sql.' error '.$conn->error.'!!
                        <P>
                        <button type="button" onclick="got_to_back() "class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                    </div>
                </div>
              </div>
            </div>';
            }

        }
        else
        {   
            $sql=" DELETE FROM admin WHERE Admin_ID='$Admin_ID'";
            if ($conn->query($sql) === TRUE)
             {
              echo'<div id= "toadd" class="" >
              <div class="">
                <div class="container" id="success" >
                    <div class="alert alert-success alert-dismissible fade show">
                        <strong>!</strong> record Admin deleted !!
                        <P>
                        <button type="button" onclick="got_to_back ()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                    </div>
                </div>
              </div>
            </div>';
              } 
              else
              {
                echo'
 
                <div id= "toadd" class="" >
                <div class="">
                  <div class="container" id="success" >
                      <div class="alert alert-success alert-dismissible fade show">
                          <strong>!</strong> there was '.$sql.' error '.$conn->error.'!!
                          <P>
                          <button type="button" onclick="got_to_back() "class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                      </div>
                  </div>
                </div>
              </div>';
              }

              echo'
 
              <div id= "toadd" class="" >
              <div class="">
                <div class="container" id="success" >
                    <div class="alert alert-success alert-dismissible fade show">
                        <strong>!</strong> there was '.$sql.' error '.$conn->error.'!!
                        <P>
                        <button type="button" onclick="got_to_back() "class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                    </div>
                </div>
              </div>
            </div>';
           
        }
    }
    else
    {
      echo'
 
      <div id= "toadd" class="" >
      <div class="">
        <div class="container" id="success" >
            <div class="alert alert-success alert-dismissible fade show">
                <strong>!</strong> there was '.$sql.' error '.$conn->error.'!!
                <P>
                <button type="button" onclick="got_to_back() "class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
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
    history.back();
  }
  function go_to_home_client ()
  {
    window.location.href="../clientpage.php";
  }
  function go_to_home_broker()
  {
    window.location.href="../brokerpage.php";
  }
  function go_to_home_AVC ()
  {
    window.location.href="../AVCpage.php";
  }
  function go_to_home_admin ()
  {
    window.location.href="../Adminpage.php";
  }
</script>
</body>
</html>