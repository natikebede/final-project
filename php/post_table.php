<?php
session_start();
include "connection.php";
//for pulling post all post informatin ever posted by a client into a table
if(isset($_GET['ID']))
{
    $client_ID=$_GET['ID'];
    $sql="SELECT post.Post_discription, post.Upload_date, asset.Asset_name, asset.Asset_type, post.No_views, post.Post_status,
     image_url.Img_url, post.Post_ID,post.Admin_ID
    FROM post LEFT JOIN asset ON post.Asset_ID = asset.Asset_ID LEFT JOIN image_url
     ON image_url.Post_ID = post.Post_ID LEFT JOIN client ON post.Client_ID = client.Client_ID WHERE client.Client_ID= '$client_ID' ORDER BY post.Upload_date DESC";
    $result=$conn->query($sql);
    if($result->num_rows >0)
    {
        echo'<div class="row">
        <div class="col table-responsive-sm">
        <table class="table table-dark rounded table-hover table-striped">
        <caption class="caption"><h4 class="mx-auto"> All Asset post information  </h4></caption>
        <thead> 
          <tr>
            <th>Post ID</th>
            <th style="width:200px;">Post Discription</th>
            <th>Upload Date</th>
            <th>Asset name</th>
            <th>Asset type</th>
            <th>Number views</th>
            <th>Post status</th>
            <th>Images</th>
            <th>Admin ID</th>
            <th>action</th>
          </tr>
        </thead>
        <tbody>';
        while( $row=$result->fetch_assoc() )
        {
           echo' <tr>
            <td>'.$row['Post_ID'].'</td>
            <td class="w-25" style="width:200px;">'.$row['Post_discription'].'</td>
            <td>'.$row['Upload_date'].'</td>
            <td>'.$row['Asset_name'].'</td>
            <td>'.$row['Asset_type'].'</td>
            <td>'.$row['No_views'].'</td>
            <td>'.$row['Post_status'].'</td>
            <td>'.$row['Img_url'].'</td>
            <td>'.$row['Admin_ID'].'</td>
            ';
            if (isset($row['Admin_ID']))
            {
              echo
              ' <td>
            
              <input type ="button"  name="activate" disabled value="Activate " onclick="activate_post('.$row['Post_ID'].')"    class=" btn btn-primary m-2 ">
              <input type ="button"  name="deactivate" disabled value="deactivate " onclick="deactivate_post('.$row['Post_ID'].')"     class=" btn btn-danger m-2">
                    
              </td>
  
             
            </tr>';
              
            }
            else
            {
            echo  ' <td>
            
              <input type ="button"  name="activate"  value="Activate " onclick="activate_post('.$row['Post_ID'].')"    class=" btn btn-primary m-2 ">
              <input type ="button"  name="deactivate"  value="deactivate " onclick="deactivate_post('.$row['Post_ID'].')"     class=" btn btn-danger m-2">
                    
              </td>
  
             
            </tr>';

            }
           

        }
       echo' </tbody>
        </table>
        </div>
        </div>';
    }
    else
    {

    }

}


//for activating  post 
else if(isset($_GET['post_ID']))
{ $post_ID=$_GET['post_ID'];
    $sql=" UPDATE post SET Post_status='active' WHERE Post_ID='$post_ID'";
    if ($conn->query($sql)===true)
    {

    }
    else
    {
        echo' <div id= "toadd" class="w3-modal" >
        <div class="w3-modal-content w3-animate-zoom">
          <div class="container" id="success" >
              <div class="alert alert-danger alert-dismissible fade show">
                  <strong>!</strong> error occurred activating post !!
                  <P>
                  <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
              </div>
          </div>
        </div>
      </div>';
    }
}




//for deactivating post here
else if(isset($_GET['Dpost_ID']))
{ $post_ID=$_GET['Dpost_ID'];
    $sql=" UPDATE post SET Post_status='not active' WHERE Post_ID='$post_ID'";
    if ($conn->query($sql)===true)
    {

    }
    else
    {
        echo' <div id= "toadd" class="w3-modal" >
        <div class="w3-modal-content w3-animate-zoom">
          <div class="container" id="success" >
              <div class="alert alert-danger alert-dismissible fade show">
                  <strong>!</strong> error occurred while deactivating post!!
                  <P>
                  <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
              </div>
          </div>
        </div>
      </div>';
    }
}













//for loading post on home page
elseif(isset($_GET['client_ID']))
{ 
  $client_ID=$_GET['client_ID'];
  $sql = "SELECT client.First_name, client.Last_name, client.email, client.city, client.wereda, client.profile_pic, client.create_date, account.Username, account.Password
  FROM client LEFT JOIN account ON account.Client_ID = client.Client_ID  WHERE client.Client_ID='$client_ID'";
$user_name=null;
$pwd=null;
$email=null;
$name=null;
$first_name=null;
$last_name=null;
$address=null;
$create_date=null;
$profile_pic=null;
$city=null;
$wereda=null;


$result= $conn->query($sql);
if($result!=false && $result->num_rows ==1)
{

 while($row=$result->fetch_assoc())
 {
   $user_name=$row['Username'];
   $pwd=$row['Password'];
   $email=$row['email'];
   $address=$row['city'].",". $row['wereda'];
   $city=$row['city'];
   $wereda= $row['wereda'];
   $create_date=$row['create_date'];
   $profile_pic=$row['profile_pic'];
   $name=$row['First_name']." ".$row['Last_name'];
   $first_name=$row['First_name'];
   $last_name=$row['Last_name'];

 }
 
}
else
{
 

}


 //load all post of client  from database
$sql="SELECT * FROM post WHERE Post_status='active' AND Client_ID='$client_ID'  ORDER BY post.Upload_date DESC ";
$result= $conn->query($sql);
if($result->num_rows >0)
{

  while( $row=$result->fetch_assoc())
  {
       $post_ID=   $row['Post_ID'];
            $row['No_views'];
            $row['Post_status'];

            echo'
            <div class="container-fluid my-3 rounded bg-white shadow-lg p-3">
                  
            <div class="row  py-2 px-4">
              <img class="rounded-circle float-left mx-2 mb-2"  src="'.$profile_pic.'" style="height:60px;width:60px" alt="profile pic">
              <h4 class="mx-2 py-3 mb-2">'.$first_name.' '.$last_name.'</h4>
              <div class="container float-right ">  <span class="badge badge-secondary "><i class=" mx-2	fas fa-calendar-alt"></i>'.$row['Upload_date'].' </span></div>
             
              <br>
              
     
            </div>
  <hr class="text-secondary">

  <div class="row ">
    <div class="container mb-4 p-2 px-4 rounded ">
      <div class="row px-3">
      <div class="col-12">
      <p class="text-dark "style="overflow:auto"">
        '.$row['Post_discription'].'
        <hr class="text-secondary">
      </p>
      </div>
        
      </div>

      </div>';
      //select all image for a particular post
      $sql2="SELECT * FROM image_url WHERE Post_ID='$post_ID'";
      $result2=$conn->query($sql2);
      //make a slide show if image is greater than two
      if($result2->num_rows >2)
      {
        echo'
        <div class="container">
        <div id="demo-'.$post_ID.'" class="carousel slide w-100 bg-dark" data-ride="carousel">

        <!-- Indicators -->
        <ul class="carousel-indicators">
          <li data-target="#demo-'.$post_ID.'" data-slide-to="0" class="active"></li>
          <li data-target="#demo-'.$post_ID.'"data-slide-to="1"></li>
          <li data-target="#demo-'.$post_ID.'" data-slide-to="2"></li>
          <li data-target="#demo-'.$post_ID.'" data-slide-to="3"></li>
        </ul>
      
        <!-- The slideshow -->
        <div class="carousel-inner w-100 ">';
        $counter=0;
        while( $row=$result2->fetch_assoc())
        {
          if ($counter==0){
            echo'
            <div class="carousel-item active w-100  ">
          <img src="'.$row['Img_url'].'"class="img-fluid w-100 rounded" alt="picture">
          <div class="carousel-caption">
          
        </div>
        </div>';
            $counter++;}
            else{
          echo'
          <div class="carousel-item w-100 ">
          <img src="'.$row['Img_url'].'"class="img-fluid w-100 rounded" alt="picture">
          <div class="carousel-caption">
          
        </div>
        </div>';
            }
        }
        echo
        '
        </div>
  
    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#demo-'.$post_ID.'" data-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#demo-'.$post_ID.'" data-slide="next">
      <span class="carousel-control-next-icon"></span>
    </a>
  
  </div>
    
      </div>
        ';
      }
      elseif($result2->num_rows ==2)
      
      //make two images if the images are only two for apost
      {
        echo'<div class="container">
        <div class="row ">';
         

        while( $row=$result2->fetch_assoc())
        {
          echo'
          <div class="col-sm-6 p-2 mb-2  ">
           <img class="img-fluid w-100 rounded"  src="'.$row['Img_url'].'">
           </div>
           ';

        }
        echo
        '
        </div>
        </div>
        ';

      }
      
      // center the image if a post hase only one image

      elseif( $result2->num_rows ==1)
      { 
        echo'<div class="container ">
        <div class="row ">';
         

        while( $row=$result2->fetch_assoc())
        {
          echo'
          <div class="col-sm  p-2 mb-2  ">
           <img class="img-fluid mx-auto d-block rounded"  src="'.$row['Img_url'].'">
           </div>
           ';

        }
        echo
        '
        </div>
        </div>
        ';


      }
// display  no image found if the post has no image
      else
      {
        echo' <div id= "toadd" class="" >
        <div class=" ">
          <div class="container" id="success" >
              <div class="alert alert-primary alert-dismissible fade show">
                  <strong>!</strong> no image uploaded !!
                  <P>
                  </div>
          </div>
        </div>
      </div>';

      }


    
     
   
 echo' </div>

 </div> ';

  }



}
else
{
  echo' <div id= "toadd" class="" >
        <div class=" w3-animate-zoom">
          <div class="container" id="success" >
              <div class="alert alert-primary alert-dismissible fade show">
                  <strong>!</strong> no post yet !!
                  <P>
                  
              </div>
          </div>
        </div>
      </div>';

}

  


}


?>