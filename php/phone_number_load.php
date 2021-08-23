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
session_start();
include "connection.php"; 
if (isset($_POST["ACCtype"]))
{
 
  if($_POST["ACCtype"]=='Broker')
  {
   
    broker();
   
  }
  else if($_POST["ACCtype"]=='Client')
  {
    client();
  }
  else if($_POST["ACCtype"]=='AVC')
  {
    AVC();
  }
  else if($_POST["ACCtype"]=='Admin')
  {
    Admin();
  }


}
else
{
  
}
function client()
{

$conn=$GLOBALS['conn'];
if(isset($_SESSION['Client_ID']))

{   
  //to load and display the clients phone number
  if(isset($_POST['ID']))
    {
        $client_ID=$_POST['ID'];
        $sql="SELECT * FROM  client_phonenumber where Client_ID='$client_ID'";
        $result=$conn->query($sql);
        if($result->num_rows >0)
        {
            $phonenumber=null; 
            $count=0;
            while( $row=$result->fetch_assoc() )  
            {  
                $phonenumber=$row['Phone_number'];
                echo'
            
                <div class="row">
                <div class="col p-1 bg-white  border rounded mx-2 my-2">
                <button type="button" class="close  text-dark" onclick="deletenumber('.$row["Phone_ID"].')">&times;</button>
                <h5 class=" text-dark font-weight-light mr-2">'.$phonenumber.' </h5>
               
                </div>
                </div>
                
                </div>';
                $count++;
            }

        }
        else
        {
           echo"";

            
        }
    }


    // to add a clients new phone number to the database
    elseif(isset($_POST['addphone']))
    { 
        $phone=$_POST['phonenumber'];
        $client_ID=$_SESSION['Client_ID'];
        $sql="INSERT INTO client_phonenumber( Client_ID, Phone_number) VALUES ('$client_ID','$phone')";
        if($conn->query($sql)===true)
        {
            echo'
 
            <div id= "toadd" class="w3-modal" >
            <div class="w3-modal-content w3-animate-zoom">
              <div class="container" id="success" >
                  <div class="alert alert-success alert-dismissible fade show">
                      <strong>!</strong> new phone number added !!
                      <P>
                      <button type="button" onclick="go_to_home_client()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                  </div>
              </div>
            </div>
          </div>';

        }
        else
        {
            echo'
 
            <div id= "toadd" class="w3-modal" >
            <div class="w3-modal-content w3-animate-zoom">
              <div class="container" id="success" >
                  <div class="alert alert-danger alert-dismissible fade show">
                      <strong>!</strong> error occurred while adding phone number !!
                      <P>
                      <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                  </div>
              </div>
            </div>
          </div>';
            
        }

    }


    // to delete a clients phonenumber from a database
    elseif(isset($_POST['phone_ID']))
    {
        $phone_ID=$_POST['phone_ID'];
        $sql="DELETE FROM client_phonenumber WHERE Phone_ID='$phone_ID'";
        if($conn->query($sql)===true)
        {

        }
        else
        {
            echo'
 
            <div id= "toadd" class="w3-modal" >
            <div class="w3-modal-content w3-animate-zoom">
              <div class="container" id="success" >
                  <div class="alert alert-danger alert-dismissible fade show">
                      <strong>!</strong> error occurred while adding phone number !!
                      <P>
                      <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                  </div>
              </div>
            </div>
          </div>';
        }

    }
   

}
}

//###################################################################################################################################################################

function broker()
{

// for broker  phone number


$conn=$GLOBALS['conn'];


  
  //to select all the phonenumber of broker and load them
    if(isset($_POST['ID']))
    {
        $broker_ID=$_POST['ID'];
        
        $sql="SELECT * FROM  broker_phonenumber where Broker_ID='$broker_ID'";
        $result=$conn->query($sql);
        if($result->num_rows >0)
        {
            $phonenumber=null; 
            $count=0;
            while( $row=$result->fetch_assoc() )  
            {  
                $phonenumber=$row['Phone_number'];
                echo'
            
                <div class="row">
                <div class="col p-1 bg-white  border rounded mx-2 my-2">
                <button type="button" class="close  text-dark" onclick="deletenumber('.$row["Phone_ID"].')">&times;</button>
                <h5 class=" text-dark font-weight-light mr-2">'.$phonenumber.' </h5>
                
               
                </div>
                </div>
                
                </div>';
                $count++;
            }

        }
        else
        {
          echo'
 
          <div id= "toadd" class="w3-modal" >
          <div class="w3-modal-content w3-animate-zoom">
            <div class="container" id="success" >
                <div class="alert alert-danger alert-dismissible fade show">
                    <strong>!</strong> error occurred while loading phone number !!
                    <P>
                    </div>
            </div>
          </div>
        </div>';
            
        }
    }



    //to add a new phonenumber of broker to database
    elseif(isset($_POST['addphone']))
    { 
        $phone=$_POST['phonenumber'];
        $broker_ID=$_SESSION['Broker_ID'];
        $sql="INSERT INTO broker_phonenumber( Broker_ID, Phone_number) VALUES ('$broker_ID','$phone')";
        if($conn->query($sql)===true)
        {
            echo'
 
            <div id= "toadd" class="w3-modal" >
            <div class="w3-modal-content w3-animate-zoom">
              <div class="container" id="success" >
                  <div class="alert alert-success alert-dismissible fade show">
                      <strong>!</strong> new phone number added !!
                      <P>
                      <button type="button" onclick="go_to_home_broker ()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                  </div>
              </div>
            </div>
          </div>';

        }
        else
        {
            echo'
 
            <div id= "toadd" class="w3-modal" >
            <div class="w3-modal-content w3-animate-zoom">
              <div class="container" id="success" >
                  <div class="alert alert-danger alert-dismissible fade show">
                      <strong>!</strong> error occurred while adding phone number !!
                      <P>
                      <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                  </div>
              </div>
            </div>
          </div>';
            
        }

    }


    //to delete a AVC phonenumber form the database
    elseif(isset($_POST['phone_ID']))
    {
        $phone_ID=$_POST['phone_ID'];
        $sql="DELETE FROM broker_phonenumber WHERE Phone_ID='$phone_ID'";
        if($conn->query($sql)===true)
        {

        }
        else
        {
            echo'
 
            <div id= "toadd" class="w3-modal" >
            <div class="w3-modal-content w3-animate-zoom">
              <div class="container" id="success" >
                  <div class="alert alert-danger alert-dismissible fade show">
                      <strong>!</strong> error occurred while adding phone number !!
                      <P>
                      <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                  </div>
              </div>
            </div>
          </div>';
        }

    }


}
//###################################################################################################################################################################
// avc phone

function AVC ()
{
  $conn=$GLOBALS['conn'];
if(isset($_SESSION['AVC_ID']))
{
    $AVC_ID=$_SESSION['AVC_ID'];
    //to select all the phonenumber of AVC and load them
    if(isset($_POST['ID']))
    {
        $AVC_ID=$_POST['ID'];
        $sql="SELECT * FROM  avc_phonenumber where AVC_ID='$AVC_ID'";
        $result=$conn->query($sql);
        if($result->num_rows >0)
        {
            $phonenumber=null; 
            $count=0;
            while( $row=$result->fetch_assoc() )  
            {  
                $phonenumber=$row['Phone_number'];
                echo'
            
                <div class="row">
                <div class="col p-1 bg-white  border rounded mx-2 my-2">
                <button type="button" class="close  text-dark" onclick="deletenumber('.$row["Phone_ID"].')">&times;</button>
                <h5 class=" text-dark font-weight-light mr-2">'.$phonenumber.' </h5>
                
               
                </div>
                </div>
                
                </div>';
                $count++;
            }

        }
        else
        {
           echo"";

            
        }
    }



    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%to add a new phonenumber  and address of AVC to database %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    elseif(isset($_POST['addphone']))
    { 
        $phone=$_POST['phonenumber'];
        $city=$_POST['city'];
        $wereda=$_POST['wereda'];
        $AVC_ID=$_SESSION['AVC_ID']; 

        $sql="INSERT INTO avc_address( AVC_ID, City, Wereda) VALUES ('$AVC_ID','$city','$wereda')";
        if($conn->query($sql)===true)
        {
          $sql="INSERT INTO avc_phonenumber (AVC_ID, Phone_number) VALUES ('$AVC_ID','$phone')";
          if($conn->query($sql)===true)
          {
              echo'
   
              <div id= "toadd" class="w3-modal" >
              <div class="w3-modal-content w3-animate-zoom">
                <div class="container" id="success" >
                    <div class="alert alert-success alert-dismissible fade show">
                        <strong>!</strong> new phone number and address added !!
                        <P>
                        <button type="button" onclick="go_to_home_AVC ()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                    </div>
                </div>
              </div>
            </div>';
  
          }
          else
          {
              echo'
   
              <div id= "toadd" class="w3-modal" >
              <div class="w3-modal-content w3-animate-zoom">
                <div class="container" id="success" >
                    <div class="alert alert-danger alert-dismissible fade show">
                        <strong>!</strong> error occurred while adding phone number !!
                        <P>
                        <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                    </div>
                </div>
              </div>
            </div>';
              
          }

        }
        else
        {
          echo'
   
              <div id= "toadd" class="w3-modal" >
              <div class="w3-modal-content w3-animate-zoom">
                <div class="container" id="success" >
                    <div class="alert alert-danger alert-dismissible fade show">
                        <strong>!</strong> error occurred while adding address!!
                        <P>
                        <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                    </div>
                </div>
              </div>
            </div>';

        }
        

    }


    //to delete a avc phonenumber form the database
    elseif(isset($_POST['phone_ID']))
    {
        $phone_ID=$_POST['phone_ID'];
        $sql="DELETE FROM avc_phonenumber WHERE Phone_ID='$phone_ID'";
        if($conn->query($sql)===true)
        {

        }
        else
        {
            echo'
 
            <div id= "toadd" class="w3-modal" >
            <div class="w3-modal-content w3-animate-zoom">
              <div class="container" id="success" >
                  <div class="alert alert-danger alert-dismissible fade show">
                      <strong>!</strong> error occurred while adding phone number !!
                      <P>
                      <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                  </div>
              </div>
            </div>
          </div>';
        }

    }

}
}













//###################################################################################################################################################################
// admin

function Admin ()
{
  $conn=$GLOBALS['conn'];
if(isset($_SESSION['Admin_ID']))
{
    $Admin_ID=$_SESSION['Admin_ID'];
    //to select all the phonenumber of AVC and load them
    if(isset($_POST['ID']))
    {
        $AVC_ID=$_POST['ID'];
        $sql="SELECT * FROM  admin_phonenumber where Admin_ID='$Admin_ID'";
        $result=$conn->query($sql);
        if($result->num_rows >0)
        {
            $phonenumber=null; 
            $count=0;
            while( $row=$result->fetch_assoc() )  
            {  
                $phonenumber=$row['Phone_number'];
                echo'
            
                <div class="row">
                <div class="col p-1 bg-white  border rounded mx-2 my-2">
                <button type="button" class="close  text-dark" onclick="deletenumber('.$row["Phone_ID"].')">&times;</button>
                <h5 class=" text-dark font-weight-light mr-2">'.$phonenumber.' </h5>
                
               
                </div>
                </div>
                
                </div>';
                $count++;
            }

        }
        else
        {
           echo"";

            
        }
    }



    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%to add a new phonenumber  of admin to database %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    elseif(isset($_POST['addphone']))
    { 
        $phone=$_POST['phonenumber'];
        $Admin_ID=$_SESSION['Admin_ID']; 

       
          $sql="INSERT INTO admin_phonenumber (Admin_ID, Phone_number) VALUES ('$Admin_ID','$phone')";
          if($conn->query($sql)===true)
          {
              echo'
   
              <div id= "toadd" class="w3-modal" >
              <div class="w3-modal-content w3-animate-zoom">
                <div class="container" id="success" >
                    <div class="alert alert-success alert-dismissible fade show">
                        <strong>!</strong> new phone number  added !!
                        <P>
                        <button type="button" onclick="go_to_home_admin ()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                    </div>
                </div>
              </div>
            </div>';
  
          }
          else
          {
              echo'
   
              <div id= "toadd" class="w3-modal" >
              <div class="w3-modal-content w3-animate-zoom">
                <div class="container" id="success" >
                    <div class="alert alert-danger alert-dismissible fade show">
                        <strong>!</strong> error occurred while adding phone number !!
                        <P>
                        <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                    </div>
                </div>
              </div>
            </div>';
              
          }

        
       
        

    }


    //to delete a admin phonenumber form the database
    elseif(isset($_POST['phone_ID']))
    {
        $phone_ID=$_POST['phone_ID'];
        $sql="DELETE FROM admin_phonenumber WHERE Phone_ID='$phone_ID'";
        if($conn->query($sql)===true)
        {

        }
        else
        {
            echo'
 
            <div id= "toadd" class="w3-modal" >
            <div class="w3-modal-content w3-animate-zoom">
              <div class="container" id="success" >
                  <div class="alert alert-danger alert-dismissible fade show">
                      <strong>!</strong> error occurred while adding phone number !!
                      <P>
                      <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                  </div>
              </div>
            </div>
          </div>';
        }

    }

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