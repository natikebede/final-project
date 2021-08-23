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
.{
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
  
  .-content
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
//#################################################for uploading valution #######################################################################################
if(isset($_POST['valuation']))
{
$acc=$_POST['account_type'];
if($acc=="Broker")
{
$Broker_ID=$_SESSION['Broker_ID'];
$val_dis=$_POST['valuation_discription'];
$val_method= $_POST['valuation_method'];
$val_price=$_POST['valuation_price'];
$val_post_ID= $_POST['post_ID'];
$date=date("Y-m-d h:i:s");
$sql="INSERT INTO valuation( Valuation_discription, Valuation_Method, Valuation_price, Valuation_date, Post_ID, Broker_ID )VALUES 
('$val_dis','$val_method','$val_price','$date','$val_post_ID','$Broker_ID')";
if($conn->query($sql)===true)
{
    echo'
 
    <div id= "toadd" class="" >
    <div class="">
      <div class="container" id="success" >
          <div class="alert alert-success alert-dismissible fade show">
              <strong>!</strong> your valuation has been uploaded succesfully !!
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
 
            <div id= "toadd" class="" >
            <div class="">
              <div class="container" id="success" >
                  <div class="alert alert-success alert-dismissible fade show">
                      <strong>!</strong> there was '.$sql.' error '.$conn->error.'!!
                      <P>
                      <button type="button" onclick="go_to_home_broker ()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                  </div>
              </div>
            </div>
          </div>';
}

}
elseif($acc=="AVC")
{
  $AVC_ID=$_SESSION['AVC_ID'];
  $val_dis=$_POST['valuation_discription'];
  $val_method= $_POST['valuation_method'];
  $val_price=$_POST['valuation_price'];
  $val_post_ID= $_POST['post_ID'];
  
  $sql="INSERT INTO valuation( Valuation_discription, Valuation_Method, Valuation_price, Valuation_date, Post_ID, AVC_ID )VALUES 
  ('$val_dis','$val_method','$val_price','$date','$val_post_ID','$AVC_ID')";
  if($conn->query($sql)===true)
  {
      echo'
   
      <div id= "toadd" class="" >
      <div class="">
        <div class="container" id="success" >
            <div class="alert alert-success alert-dismissible fade show">
                <strong>!</strong> your valuation has been uploaded succesfully !!
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
   
              <div id= "toadd" class="" >
              <div class="">
                <div class="container" id="success" >
                    <div class="alert alert-success alert-dismissible fade show">
                        <strong>!</strong> there was '.$sql.' error '.$conn->error.'!!
                        <P>
                        <button type="button" onclick="go_to_home_AVC ()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                    </div>
                </div>
              </div>
            </div>';
  }

}
}

//#################################################for loading all valuation to a table #######################################################################################

elseif(isset($_POST['Account_ID']))
{ 
  
  $acc=$_POST['Account_type'];
  if($acc=="Broker")
  {

    $Broker_ID=$_POST['Account_ID'];
    $sql="SELECT * FROM valuation where Broker_ID='$Broker_ID'";
    $result=$conn->query($sql);
    if($result->num_rows >0)
    { 
      echo'
        <table class="table table-white rounded table-hover table-striped">
          <caption class="caption"><h4 class="mx-auto"> All valuation post information  </h4></caption>
          <thead> 
            <tr>
              <th>valuation ID</th>
              <th style="width:200px;">Valuation Discription</th>
              <th>Valuation_Method</th>
              <th>Valuation_price</th>
              <th>Valuation_date</th>
              <th>Post_ID</th>
              <th>action</th>
            </tr>
          </thead>
          <tbody>
        ';
        while($row=$result->fetch_assoc())
        {
            echo' <tr>
            <td>'.$row['Valuation_ID'].'</td>
            <td class="w-25" style="width:200px;">'.$row['Valuation_discription'].'</td>
            <td>'.$row['Valuation_Method'].'</td>
            <td>'.$row['Valuation_price'].'</td>
            <td>'.$row['Valuation_date'].'</td>
            <td>'.$row['Post_ID'].'</td>
            <td>
                <input type ="button"  name="deactivate" value="remove " onclick="remove_valuation('.$row['Valuation_ID'].')"     class="font-weight-bold btn btn-danger m-2">
                    
             </td>
            ';
        }

    }
    else
    {
      echo
      '
      <table class="table table-white rounded table-hover table-striped">
      <caption class="caption"><h4 class="mx-auto"> All valuation post information  </h4></caption>
      <thead> 
        <tr>
          <th>valuation ID</th>
          <th style="width:200px;">Valuation Discription</th>
          <th>Valuation_Method</th>
          <th>Valuation_price</th>
          <th>Valuation_date</th>
          <th>Post_ID</th>
          <th>action</th>
        </tr>
      </thead>
      <tbody>
        </table>
      ';

        
    }

  }
  //##########################################################################for loding the table for AVC ##########################################################################
  
  
  elseif($acc=="AVC")
  {
    $AVC_ID=$_POST['Account_ID'];
    $sql="SELECT * FROM valuation where AVC_ID='$AVC_ID'";
    $result=$conn->query($sql);
    if($result->num_rows >0)
    { 
      echo'
        <table class="table table-white rounded table-hover table-striped">
          <caption class="caption"><h4 class="mx-auto"> All valuation post information  </h4></caption>
          <thead> 
            <tr>
              <th>valuation ID</th>
              <th style="width:200px;">Valuation Discription</th>
              <th>Valuation_Method</th>
              <th>Valuation_price</th>
              <th>Valuation_date</th>
              <th>Post_ID</th>
              <th>action</th>
            </tr>
          </thead>
          <tbody>
        ';
        while($row=$result->fetch_assoc())
        {
            echo' <tr>
            <td>'.$row['Valuation_ID'].'</td>
            <td class="w-25" style="width:200px;">'.$row['Valuation_discription'].'</td>
            <td>'.$row['Valuation_Method'].'</td>
            <td>'.$row['Valuation_price'].'</td>
            <td>'.$row['Valuation_date'].'</td>
            <td>'.$row['Post_ID'].'</td>
            <td>
                <input type ="button"  name="deactivate" value="remove " onclick="remove_valuation('.$row['Valuation_ID'].')"     class="font-weight-bold btn btn-danger m-2">
                    
             </td>
            ';
        }

    }
    else
    {
      echo'
      <table class="table table-white rounded table-hover table-striped">
      <caption class="caption"><h4 class="mx-auto"> All valuation post information  </h4></caption>
      <thead> 
        <tr>
          <th>valuation ID</th>
          <th style="width:200px;">Valuation Discription</th>
          <th>Valuation_Method</th>
          <th>Valuation_price</th>
          <th>Valuation_date</th>
          <th>Post_ID</th>
          <th>action</th>
        </tr>
      </thead>
      <tbody>
        </table>
      ';
    }

  }
 
}


//#################################################for removing  valuation #######################################################################################




elseif (isset($_POST['valuation_ID']))
{
    $val_ID=$_POST['valuation_ID'];
    $sql="DELETE FROM valuation WHERE Valuation_ID='$val_ID' ";
    if($conn->query($sql)===true)
    {
        echo'
 
        <div id= "toadd" class="" >
        <div class="">
          <div class="container" id="success" >
              <div class="alert alert-danger alert-dismissible fade show">
                  <strong>!</strong> your valuation has been removed !!
                  <P>
                  <button type="button"  data-dismiss="alert" class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
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
              <div class="alert alert-danger alert-dismissible fade show">
                  <strong>!</strong> there was '.$sql.' error '.$conn->error.'!!
                  <P>
                  <button type="button"  data-dismiss="alert" class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
              </div>
          </div>
        </div>
      </div>';

    }

}
//################################################# end of for removing  valuation #######################################################################################










//################################################# start for loading  valuation amount #######################################################################################

if(isset($_POST['count_ID']))
{

  $acc=$_POST['ACCtype'];
  
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%for Broker %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
if($acc=="Broker")
{
  $Broker_ID=$_POST['count_ID'];
    $sql="SELECT COUNT(Valuation_ID) FROM  valuation WHERE Broker_ID='$Broker_ID'";
    $result=$conn->query($sql);
    if($result->num_rows>0)
    {
      while($row=$result->fetch_assoc())
      {
        $count=$row['COUNT(Valuation_ID)'];
        echo $count;

      }
    }
    else
    {
      echo'
 
        <div id= "toadd" class="" >
        <div class="">
          <div class="container" id="success" >
              <div class="alert alert-danger alert-dismissible fade show">
                  <strong>!</strong> there was '.$sql.' error '.$conn->error.'!!
                  <P>
                  <button type="button"  data-dismiss="alert" class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
              </div>
          </div>
        </div>
      </div>';

    }

}
//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%




// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%for AVC %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

elseif ($acc=="AVC")
{
  $AVC_ID=$_POST['count_ID'];
    $sql="SELECT COUNT(Valuation_ID) FROM  valuation WHERE AVC_ID='$AVC_ID'";
    $result=$conn->query($sql);
    if($result->num_rows>0)
    {
      while($row=$result->fetch_assoc())
      {
        $count=$row['COUNT(Valuation_ID)'];
        echo $count;

      }
    }
    else
    {
      echo'
 
        <div id= "toadd" class="" >
        <div class="">
          <div class="container" id="success" >
              <div class="alert alert-danger alert-dismissible fade show">
                  <strong>!</strong> there was '.$sql.' error '.$conn->error.'!!
                  <P>
                  <button type="button"  data-dismiss="alert" class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
              </div>
          </div>
        </div>
      </div>';

    }

  
}
//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

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
</script>
</body>
</html>