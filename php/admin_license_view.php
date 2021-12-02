<?php
session_start();
include "connection.php";
if(isset($_POST['load_license_table']))
{
    $sql="SELECT license.License_ID, license.License_status, license.License_description, license.Upload_date,
    license.Admin_ID, avc.AVC_ID, avc.name,  avc.Account_status FROM license LEFT JOIN avc ON
     license.AVC_ID = avc.AVC_ID  WHERE license.License_status='pending' OR license.License_status='Approved'  ORDER BY license.Upload_date DESC";
   $result=$conn->query($sql);
   if($result->num_rows >0)
   {
       echo'
       <div class="col-lg table-responsive-sm">
       <table class="table table-dark rounded table-hover table-striped rounded" id="license_table">
       <caption class="caption"><h4 class="mx-auto"> All license requests </h4></caption>
       <thead> 
         <tr>
           <th>License ID</th>
           <th style="width:200px;">License_description</th>
           <th>Upload_date</th>          
           <th>AVC_ID</th>
           <th>name</th>
           <th>License_status</th>
           <th>Account_status</th>
           <th>Admin ID</th>
           <th>action</th>
         </tr>
       </thead>
       <tbody>';
       while( $row=$result->fetch_assoc() )
       {
          echo' <tr>
           <td>'.$row['License_ID'].'</td>
           <td class="w-25" style="width:200px;">'.$row['License_description'].'</td>
           <td>'.$row['Upload_date'].'</td>
           <td>'.$row['AVC_ID'].'</td>
           <td>'.$row['name'].'</td>
           <td>'.$row['License_status'].'</td>
           <td>'.$row['Account_status'].'</td>
           <td>'.$row['Admin_ID'].'</td>
           ';
           
           echo
           ' <td>
           <input type ="button"  name="activate"    value="Approve " onclick="Approve_License('.$row['License_ID'].', '.$row['AVC_ID'].')"    class=" btn btn-success m-2 ">
           <input type ="button"  name="activate"    value="Denied " onclick="Denay_License ('.$row['License_ID'].','.$row['AVC_ID'].')"    class=" btn btn-primary m-2 ">
           <input type ="button"  name="activate"    value="view " onclick="view_license ('.$row['License_ID'].','.$row['AVC_ID'].')"    class=" btn btn-info m-2 ">
          
           
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
    echo' <div id= "toadd"  >
    <div >
      <div class="container" id="success" >
          <div class="alert alert-info alert-dismissible fade show">
              <strong>!</strong> no license Requests !!
              <P>
             
          </div>
      </div>
    </div>
  </div>';

   }

}


// for approving request sent by a company
elseif(isset($_POST['License_ID'])&& isset($_POST['Admin_ID']))
{
    $license_ID=$_POST['License_ID'];
    $Admin_ID=$_POST['Admin_ID'];
    $AVC_ID=$_POST['AVC_ID'];
    $sql=" UPDATE license SET license_status='Approved', Admin_ID='$Admin_ID' WHERE License_ID='$license_ID'";
    if ($conn->query($sql)===true)
    {
      
      $sql=" UPDATE avc SET avc.License_status ='Approved' WHERE AVC_ID='$AVC_ID'";
      if ($conn->query($sql)===true)
      {
       
  
      }
      else
      {
          echo' <div id= "toadd" class="w3-modal" >
          <div class="w3-modal-content w3-animate-zoom">
            <div class="container" id="success" >
                <div class="alert alert-danger alert-dismissible fade show">
                    <strong>!</strong> error occurred Approving license !!
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
        echo' <div id= "toadd" class="w3-modal" >
        <div class="w3-modal-content w3-animate-zoom">
          <div class="container" id="success" >
              <div class="alert alert-danger alert-dismissible fade show">
                  <strong>!</strong> error occurred Approving license !!
                  <P>
                  <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
              </div>
          </div>
        </div>
      </div>';
    }


}

//for denying request for approvale 
elseif(isset($_POST['DLicense_ID']) && isset($_POST['Admin_ID']))
{
    $license_ID=$_POST['DLicense_ID'];
    $Admin_ID=$_POST['Admin_ID'];
    $AVC_ID=$_POST['AVC_ID'];
    $sql=" UPDATE license SET license_status='Denied', Admin_ID='$Admin_ID' WHERE License_ID='$license_ID'";
    if ($conn->query($sql)===true)
    {


        $sql=" UPDATE avc SET avc.License_status ='Denied' WHERE AVC_ID='$AVC_ID'";
        if ($conn->query($sql)===true)
        {
        
    
        }
        else
        {
            echo' <div id= "toadd" class="w3-modal" >
            <div class="w3-modal-content w3-animate-zoom">
              <div class="container" id="success" >
                  <div class="alert alert-danger alert-dismissible fade show">
                      <strong>!</strong> error occurred Approving license !!
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
        echo' <div id= "toadd" class="w3-modal" >
        <div class="w3-modal-content w3-animate-zoom">
          <div class="container" id="success" >
              <div class="alert alert-danger alert-dismissible fade show">
                  <strong>!</strong> error occurred Activating post !!
                  <P>
                  <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
              </div>
          </div>
        </div>
      </div>';
    }


}

//for viewing when the button view is clicked on the license
elseif(isset($_POST['view_license_id']) && isset($_POST['view_avc_id']))

{
  $license_ID=$_POST['view_license_id'];
  $AVC_ID=$_POST['view_avc_id'];
  $sql="SELECT * FROM `license_image_url` WHERE  License_ID='$license_ID' ";
  $result2=$conn->query($sql);
echo'<div class="container-fluid ">';

$pic=array();
  if($result2->num_rows >2)
  {$count=0;
    echo'
  
    <div class="container-fluid">
    <div id="demo-'.$license_ID.'" class="carousel slide w-100 bg-dark rounded" data-ride="carousel">
 
    <!-- Indicators -->
    <ul class="carousel-indicators">
      <li data-target="#demo-'.$license_ID.'" data-slide-to="0" class="active"></li>
      <li data-target="#demo-'.$license_ID.'" data-slide-to="1"></li>
      <li data-target="#demo-'.$license_ID.'" data-slide-to="2"></li>
      <li data-target="#demo-'.$license_ID.'" data-slide-to="3"></li>
    </ul>
  
    <!-- The slideshow -->
    <div class="carousel-inner w-100 ">';
    $counter=0;
    while( $row=$result2->fetch_assoc())
    {
      if ($counter==0)
      {
        echo'
        <div class="carousel-item active w-100  ">
      <img src="'.$row['Img_url'].'"class="img-fluid w-100 rounded" alt="food">
      <div class="carousel-caption">
      
    </div>
    </div>';
        $counter++;
      }
      else
      {
        $pic[$count]=$row['Img_url'];
      echo'
      <div class="carousel-item w-100 ">
      <img src="'.$row['Img_url'].'"class="w-100 rounded" alt="food">
      <div class="carousel-caption">
      
    </div>
    </div>';
        }
        $count++;
    }
    echo
    '
    </div>
 
       <!-- Left and right controls -->
       <a class="carousel-control-prev" href="#demo-'.$license_ID.'" data-slide="prev">
       <span class="carousel-control-prev-icon"></span>
       </a>
       <a class="carousel-control-next" href="#demo-'.$license_ID.'" data-slide="next">
       <span class="carousel-control-next-icon"></span>
       </a>
 
       </div>
 
       </div>
    ';
  }

  elseif($result2->num_rows ==2)
 
 //make two images if the images are only two for apost
 {
        echo'
        <!-- image holder div  -->
        
        <div class="container">
        <div class="row ">';
        $count=0;  

        while( $row=$result2->fetch_assoc())
        {
          $pic[$count]=$row['Img_url'];
          echo'
          <div class="col-sm-6 p-2 mb-2  ">
            <img class="img-fluid w-100 rounded"  src="'.$row['Img_url'].'">
            </div>
            ';
          $count++;
        }
        echo
        '
        </div>
        </div>
      
        <!-- end of image holder div -->
      ';
}



elseif( $result2->num_rows ==1)
 { 
   echo'
   <!-- image holder div -->
   
   <div class="container ">
   <div class="row ">';
  
   
    $count=0;
   while( $row=$result2->fetch_assoc())
   {
    $pic[$count]=$row['Img_url'];
     echo'
     <div class="col-lg  p-2 mb-2  ">
      <img class="img-fluid mx-auto d-block rounded"  src="'.$row['Img_url'].'">
      </div>
    </div>
      ';

   }
   echo
   '
   </div>
   </div>
   <!-- end of image holder div -->
   ';
}


  

echo'</div>
<div class="col-lg bg-dark text-light p-5 rounded my-3">';
$sql="SELECT license.License_ID, license.License_status, license.License_description, license.Upload_date,
    license.Admin_ID, avc.AVC_ID, avc.name,  avc.Account_status FROM license LEFT JOIN avc ON
     license.AVC_ID = avc.AVC_ID  WHERE license.License_ID='$license_ID' ";
   $result=$conn->query($sql);
   if($result->num_rows >0)
   {
    while( $row=$result->fetch_assoc() )
    {
      echo' 
      
      <a href="#" class="list-group-item font-weight-bolder border-0 text-decoration-none bg-dark text-light"><i class="fas fa-chevron-circle-right mx-3"></i>license request ID = '.$row['License_ID'].'</a>
      <a href="#" class="list-group-item font-weight-bolder  border-0 text-decoration-none bg-dark text-light"><i class="fas fa-chevron-circle-right mx-3"></i> license requester Name = '.$row['name'].'</a>
        <div class="container   rounded font-weight-bolder text-light">
        <h5 class="w-100"> <i class="fas fa-chevron-circle-right mx-3">license request discription</i> </h5>
            
            <textarea rows="8" class=" w-100 mx-1 my-1 text-light font-weight-bolder  " disabled >'.$row['License_description'].'</textarea>
        </div>
      <a href="#" class=" font-weight-bolder list-group-item  border-0 text-decoration-none bg-dark text-light"><i class="fas fa-chevron-circle-right mx-3"></i>  AVC_ID = '.$row['AVC_ID'].'</a>
      <a href="#" class=" font-weight-bolder list-group-item  border-0 text-decoration-none bg-dark text-light"><i class="fas fa-chevron-circle-right mx-3"></i> License_status = '.$row['License_status'].'</a>
      <a href="#" class=" font-weight-bolder list-group-item  border-0 text-decoration-none bg-dark text-light"><i class="fas fa-chevron-circle-right mx-3"></i>  Account_status = '.$row['Account_status'].'</a>
      <a href="#" class=" font-weight-bolder list-group-item  border-0 text-decoration-none bg-dark text-light"><i class="fas fa-chevron-circle-right mx-3"></i>  Upload_date = '.$row['Upload_date'].'</a>
      
      ';
       }
    for($i=0;$i<count($pic);$i++)
    {
        echo' 
        <div class="list-group w-100 bg-dark font-weight-bold mx-auto border-0 ">
                <a href="'.$pic[$i].'" target="blank" class="list-group-item  border-0 text-decoration-none bg-dark text-light"><i class="fas fa-file-image mx-1"></i>picture</a>
          </div>';
          echo' 
        <div class="list-group w-100 bg-dark font-weight-bold mx-auto border-0 ">
                <a href="'.$pic[$i].'" download class="list-group-item  border-0 text-decoration-none bg-dark text-light"><i class="fas fa-file-download mx-1"></i> download picture</a>
          </div>';
       
    }
  

   }
   else
   {


   }








echo'</div>';

}




?>