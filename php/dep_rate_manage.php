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
session_start();
include "connection.php";
if(isset($_POST['upload_rate']))
{
    $Admin_ID=$_SESSION['Admin_ID'];
    $asset_name=$_POST['Asset_name'];
    $asset_type=$_POST['Asset_type'];
    $dep_rate=$_POST['dep_rate'];
    $Dep_discription=$_POST['Dep_discription'];
    $sql="INSERT INTO asset( Asset_name, Asset_type) VALUES ('$asset_name','$asset_type')";
    if($conn->query($sql)===true)
    {
        $asset_ID= $conn->insert_id;
        $sql="INSERT INTO dep_rate
        ( Dep_rate, Dep_discription, Admin_ID, Asset_ID, recored_Date) 
        VALUES ('$dep_rate','$Dep_discription','$Admin_ID','$asset_ID','$date')";

        if($conn->query($sql)===true)
        {
            echo'<div ID= "toadd" class="" >
                    <div class=" w3-animate-zoom">
                      <div class="container" ID="success" >
                          <div class="alert alert-success alert-dismissible fade show">
                              <strong>!</strong> Deperciation Rate registerd !!
                              <P>
                              <button type="button" onclick="go_to_home_admin ()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                          </div>
                      </div>
                    </div>
                  </div>';

        }
        else
        {
            echo'<div ID= "toadd" class="" >
                    <div class=" w3-animate-zoom">
                      <div class="container" ID="success" >
                          <div class="alert alert-danger alert-dismissible fade show">
                              <strong>!</strong> Error while uploading Dep Rate !!
                              <P>
                              <button type="button" onclick="go_to_home_admin ()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                          </div>
                      </div>
                    </div>
                  </div>';


        }
    }

    else
        {
            echo'<div ID= "toadd" class="" >
                    <div class=" w3-animate-zoom">
                      <div class="container" ID="success" >
                          <div class="alert alert-danger alert-dismissible fade show">
                              <strong>!</strong> error while uploading Asset !!
                              <P>
                              <button type="button" onclick="go_to_home_admin ()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                          </div>
                      </div>
                    </div>
                  </div>';

            
        }




}
/// for loading all dep rate into a table
elseif( isset($_POST['load']))
{

    $sql="SELECT `asset`.`Asset_name`, `asset`.`Asset_type`,`asset`.`Asset_ID`, `dep_rate`.`Dep_ID`, `dep_rate`.`Dep_rate`,
     `dep_rate`.`Dep_discription`, `dep_rate`.`Admin_ID`, `dep_rate`.`recored_Date`
    FROM `asset` 
        LEFT JOIN `dep_rate` ON `dep_rate`.`Asset_ID` = `asset`.`Asset_ID` ORDER BY dep_rate.recored_Date DESC";
   $result=$conn->query($sql);
   if($result->num_rows >0)
   {
       echo'
       <div class="col table-responsive-sm">
       <table class="table table-dark rounded table-hover table-striped rounded" id="dep_table">
       <caption class="caption"><h4 class="mx-auto"> All  Deperciation rate information </h4></caption>
       <thead> 
         <tr>
           <th>dep ID</th>
           <th style="width:200px;">Dep Discription</th>
           <th>dep Rate</th>
           <th>Asset name</th>
           <th>Asset type</th>
           <th>record date</th>
           <th>Admin ID</th>
           <th>action</th>
         </tr>
       </thead>
       <tbody>';
       while( $row=$result->fetch_assoc() )
       {
          echo' <tr>
           <td>'.$row['Dep_ID'].'</td>
           <td class="w-25" style="width:200px;">'.$row['Dep_discription'].'</td>
           <td>'.$row['Dep_rate'].'</td>
           <td>'.$row['Asset_name'].'</td>
           <td>'.$row['Asset_type'].'</td>
           <td>'.$row['recored_Date'].'</td>
           <td>'.$row['Admin_ID'].'</td>
           ';
           
           echo
           ' <td>
           <input type ="button"  name="Remove"  value="remove " onclick="Remove_Dep('.$row['Asset_ID'].')"     class=" btn btn-danger m-2">
             
           
           </td>

          
         </tr>';

       }
      echo' </tbody>
       </table>
       </div>
       ';
   }
   else
   {
    echo' <div id= "toadd" class="" >
        <div class=" ">
          <div class="container" id="success" >
              <div class="alert alert-danger alert-dismissible fade show">
                  <strong>!</strong> no depreciation Rate  !!
                  <P>
                  </div>
          </div>
        </div>
      </div>';
   }


}

// for removing dep rate
elseif(isset($_POST['Asset_ID']))
{
    $asset_ID=$_POST['Asset_ID'];
  
    $sql=" DELETE FROM asset WHERE Asset_ID='$asset_ID'";
    if ($conn->query($sql)===true)
    {

    }
    else
    {
        echo' <div id= "toadd" class="w3-modal" >
        <div class="w3-modal-content w3-animate-zoom">
          <div class="container" id="success" >
              <div class="alert alert-danger alert-dismissible fade show">
                  <strong>!</strong> error occurred Removing Asset !!
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
  history.back();
}
function go_to_home_admin ()
  {
    window.location.href="../Adminpage.php";
  }
</script>
</body>
</html>