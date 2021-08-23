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
 AVC ();
function AVC ()
{
    
    $server="localhost";
    $db="avs";
    $username="root";
    $password="";
    $GLOBALS['date']=date("Y-m-d");
    $conn= new mysqli ($server,$username,$password,$db);
    if($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    else{
    //echo "Connected successfully";
    }
if(isset($_SESSION['AVC_ID']))
{
    $AVC_ID=$_SESSION['AVC_ID'];
    //to select all the phonenumber of AVC and load them
    if(isset($_POST['ID']))
    {
        $AVC_ID=$_POST['ID'];
        $sql="SELECT * FROM  avc_address where AVC_ID='$AVC_ID'";
        $result=$conn->query($sql);
        if($result->num_rows >0)
        {
            $phonenumber=null; 
            $count=0;
            while( $row=$result->fetch_assoc() )  
            {  
                $address=$row['City'].",". $row['Wereda'];
                echo'
            
                <div class="row">
                <div class="col p-1 bg-white  border rounded mx-2 my-2">
                <button type="button" class="close  text-dark" onclick="delete_address('.$row["Address_ID"].')">&times;</button>
                <h5 class=" text-dark font-weight-light mr-2">'.$address.' </h5>
                
               
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


    //to delete a avc address form the database
    elseif(isset($_POST['address_ID']))
    {
        $address_ID=$_POST['address_ID'];
        $sql="DELETE FROM avc_address WHERE Address_ID='$address_ID'";
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
                      <strong>!</strong> error occurred while deleting address  !!
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