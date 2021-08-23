<?php
session_start();
include "connection.php";
//loading all the post to brokers and AVC 

if(isset($_POST['true']))
{
  $sql= $sql1="SELECT * FROM post WHERE Post_status='active'  ORDER BY post.Upload_date DESC ";
  $result= $conn->query($sql);
  if($result && $result->num_rows >0)
  {
$name=null;
$first_name=null;
$last_name=null;
$profile_pic=null;
$client_ID=null;
$count=0;
while($row=$result->fetch_assoc())
{
  $client_ID=$row["Client_ID"];
  $post_ID=   $row['Post_ID'];
  $upload_date=$row['Upload_date'];
  $discription=$row['Post_discription'];
  $sql1=" SELECT * FROM client where Client_ID='$client_ID ' ";
  $result1= $conn->query($sql1);
  if($result1 && $result1->num_rows >0)
  {
    while($row=$result1->fetch_assoc())
    {
      $profile_pic=$row['profile_pic'];
      $name=$row['First_name']." ".$row['Last_name'];
      $first_name=$row['First_name'];
      $last_name=$row['Last_name'];
      $client_ID=$row['Client_ID'];
    }
    echo'
    <div class="container-fluid my-3 rounded  text-dark shadow-lg p-3">
          
    <div class="row  py-2 px-4">
      <img class="rounded-circle float-left mx-2 mb-2"  src="'.$profile_pic.'" style="height:60px;width:60px" alt="profile pic">
      <h4 class="mx-2 py-3 mb-2">'.$first_name.' '.$last_name.'</h4>
      <div class="container float-right ">  <span class="badge badge-secondary "><i class=" mx-2	fas fa-calendar-alt"></i>'.$upload_date.' </span></div>
     
      <br>
      

    </div>
<hr class="text-light">

<div class="row ">
<div class="container mb-4 p-2 px-4 rounded ">
<div class="row px-3">
<div class="col-12" style="word-break: break-all;>
<p class="text-dark "style="overflow:auto"">
'.$discription.'
<hr class="w-100 text-light">
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
   <div id="demo-'.$post_ID.'" class="carousel slide w-100  rounded" data-ride="carousel">

   <!-- Indicators -->
   <ul class="carousel-indicators">
     <li data-target="#demo-'.$post_ID.'" data-slide-to="0" class="active"></li>
     <li data-target="#demo-'.$post_ID.'" data-slide-to="1"></li>
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
     <img src="'.$row['Img_url'].'"class="img-fluid w-100 rounded" alt="food">
     <div class="carousel-caption">
     
   </div>
   </div>';
       $counter++;}
       else{
     echo'
     <div class="carousel-item w-100 ">
     <img src="'.$row['Img_url'].'"class="w-100 rounded" alt="food">
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

 </div>';

 
 if(isset($_POST['Account_ID'])&&isset($_POST['ACCtype']))
 {
   $acc=$_POST['ACCtype'];
   $Account_ID=$_POST['Account_ID'];
   //for AVC display valuation
   if($acc=='AVC')
   {
     $sql2="SELECT valuation.Valuation_discription, valuation.Valuation_Method, 
     valuation.Valuation_price, valuation.Valuation_date, valuation.Post_ID, avc.name, avc.License_status,
      avc.Profile_pic FROM valuation 
	    LEFT JOIN avc ON valuation.AVC_ID = avc.AVC_ID WHERE avc.AVC_ID='$Account_ID'AND valuation.Post_ID='$post_ID'";
        $result2=$conn->query($sql2);
        if($result2->num_rows>0)
       {$name=null;
        $profile_pic=null;
        $License_status=null;
        $Valuation_discription=null;
        $Valuation_Method=null;
        $Valuation_price=null;
        $Valuation_date=null;
        while( $row=$result2->fetch_assoc())
        {
          
        $name=$row['name'];
        $profile_pic=$row['Profile_pic'];
        $License_status=$row['License_status'];
        $Valuation_discription=$row['Valuation_discription'];
        $Valuation_Method=$row['Valuation_Method'];
        $Valuation_price=$row['Valuation_price'];
        $Valuation_date=$row['Valuation_date'];
          echo'
          <div class="container  rounded  w-100 text-dark  px-2 my-3">
         
            <div class="row  py-2 px-5">
               <h5 class="text-dark font-weight-bold display-4 w-100 ">valuated</h5> 
              <img class="rounded-circle float-left mx-2 mb-2"  src="'.$profile_pic.'" style="height:60px;width:60px" alt="profile pic">
              <h4 class="mx-2 py-3 mb-2">'.$name.' </h4>
              <div class="container float-right ">  
                <span class="badge badge-secondary ">
                <i class=" mx-2	fas fa-calendar-alt"></i>'. $Valuation_date.' </span>
              </div>
             
              <br>
            </div>
            <hr class="text-light">
         
               
                  <div class="container mb-1 p-2  rounded ">
                    <div class="row px-1">
                      <div class="col-lg-12" style="word-break: break-all;">
                          
                           <h5 class="text-dark font-weight-bold ">Discription</h5> 
                          '.$Valuation_discription.'
                          <hr class="w-100 text-light">
                          
                      </div>
                      <div class="col-12">
                        <p class="text-dark  "style="overflow:auto">
                         <h5 class="text-dark font-weight-bold ">Method</h5> 
                        '.$Valuation_Method.'
                        <hr class="w-100 text-light">
                        </p>
                    </div>
                     <div class="col-12">
                          <p class="text-dark  "style="overflow:auto">
                           <h5 class="text-success font-weight-bold ">Price</h5> 
                          '.$Valuation_price.' BIRR
                          <hr class="w-100 text-light">
                          </p>
                      </div>
         
                    </div>
         
                  </div>
                
            </div>';

          
          
          
          

        }





       }
       else
       {
        echo'  <!-- valuation button -->
        <div class="container  w-100 float-right my-3 mx-2" style="right:0;">
        <div class="row">
        <div class="col">
        <button class="btn valuate_buttons btn-light  float-right  w-100 font-weight-bold " onclick ="valuate_post('.$post_ID.')" style="right:0;">Valuate</button>
        
        </div>
        
        </div>
        </div>
        <!-- end valuation button -->
     
        ';
       }



   }
   //for broker view valuation 
   elseif($acc=='Broker')
   {
    $sql2="SELECT valuation.Valuation_discription, valuation.Valuation_Method, valuation.Valuation_price, valuation.Valuation_date, valuation.Post_ID,broker.First_name, broker.Last_name, broker.Profile_pic
    FROM valuation 
      LEFT JOIN broker ON valuation.Broker_ID = broker.Broker_ID WHERE broker.Broker_ID='$Account_ID' AND valuation.Post_ID='$post_ID'";
      $result2=$conn->query($sql2);
      if($result2->num_rows>0)
      {
       $profile_pic=null;
     
       $Valuation_discription=null;
       $Valuation_Method=null;
       $Valuation_price=null;
       $Valuation_date=null;
       while( $row=$result2->fetch_assoc())
       {
         
       $First_name=$row['First_name'];
       $Last_name=$row['Last_name'];
       $profile_pic=$row['Profile_pic'];
       $Valuation_discription=$row['Valuation_discription'];
       $Valuation_Method=$row['Valuation_Method'];
       $Valuation_price=$row['Valuation_price'];
       $Valuation_date=$row['Valuation_date'];
         echo'
         <div class="container  rounded  w-100 text-dark  px-2 my-3">
         
          <div class="row  py-2 px-5">
             <h5 class="text-dark font-weight-bold display-4 w-100 ">valuated</h5> 
            <img class="rounded-circle float-left mx-2 mb-2"  src="'.$profile_pic.'" style="height:60px;width:60px" alt="profile pic">
            <h4 class="mx-2 py-3 mb-2">'.$First_name.' '.$Last_name.'</h4>
            <div class="container float-right ">  
              <span class="badge badge-secondary ">
              <i class=" mx-2	fas fa-calendar-alt"></i>'. $Valuation_date.' </span>
            </div>
           
            <br>
          </div>
          <hr class="text-light">
       
             
                <div class="container mb-1 p-2  rounded ">
                  <div class="row px-1">
                    <div class="col-lg-12" style="word-break: break-all;">
                        
                         <h5 class="text-dark font-weight-bold ">Discription</h5> 
                        '.$Valuation_discription.'
                        <hr class="w-100 text-light">
                        
                    </div>
                    <div class="col-12">
                      <p class="text-dark  "style="overflow:auto">
                       <h5 class="text-dark font-weight-bold ">Method</h5> 
                      '.$Valuation_Method.'
                      <hr class="w-100 text-light">
                      </p>
                  </div>
                   <div class="col-12">
                        <p class="text-dark  "style="overflow:auto">
                         <h5 class="text-success font-weight-bold ">Price</h5> 
                        '.$Valuation_price.' BIRR
                        <hr class="w-100 text-light">
                        </p>
                    </div>
       
                  </div>
       
                </div>
              
          </div>';

         
         
         
         

       }





      }


    else
    {
     echo'  <!-- valuation button -->
     <div class="container  w-100 float-right my-3 mx-2" style="right:0;">
     <div class="row">
     <div class="col">
     <button class="btn buttons btn-light  float-right  w-100 font-weight-bold " onclick ="valuate_post('.$post_ID.')" style="right:0;">Valuate</button>
     
     </div>
     
     </div>
     </div>
     <!-- end valuation button -->
  
     ';
    }

   }


 }
 }
 elseif($result2->num_rows ==2)
 
 //make two images if the images are only two for apost
 {
   echo'
   <!-- image holder div  -->
   <div class="container">
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
   <!-- end of image holder div -->
';


if(isset($_POST['Account_ID'])&&isset($_POST['ACCtype']))
{
  $acc=$_POST['ACCtype'];
  $Account_ID=$_POST['Account_ID'];
  //for AVC display valuation
  if($acc=='AVC')
  {
    $sql2="SELECT valuation.Valuation_discription, valuation.Valuation_Method, valuation.Valuation_price,
     valuation.Valuation_date, valuation.Post_ID, avc.name, avc.License_status, avc.Profile_pic
FROM valuation 
	LEFT JOIN avc ON valuation.AVC_ID = avc.AVC_ID WHERE avc.AVC_ID='$Account_ID'AND valuation.Post_ID='$post_ID'";
       $result2=$conn->query($sql2);
       if($result2->num_rows>0)
      {$name=null;
       $profile_pic=null;
       $License_status=null;
       $Valuation_discription=null;
       $Valuation_Method=null;
       $Valuation_price=null;
       $Valuation_date=null;
       while( $row=$result2->fetch_assoc())
       {
         
       $name=$row['name'];
       $profile_pic=$row['Profile_pic'];
       $License_status=$row['License_status'];
       $Valuation_discription=$row['Valuation_discription'];
       $Valuation_Method=$row['Valuation_Method'];
       $Valuation_price=$row['Valuation_price'];
       $Valuation_date=$row['Valuation_date'];
         echo'
         <div class="container  rounded  w-100 text-dark  px-2 my-3">
         
          <div class="row  py-2 px-5">
             <h5 class="text-dark font-weight-bold display-4 w-100 ">valuated</h5> 
            <img class="rounded-circle float-left mx-2 mb-2"  src="'.$profile_pic.'" style="height:60px;width:60px" alt="profile pic">
            <h4 class="mx-2 py-3 mb-2">'.$name.' </h4>
            <div class="container float-right ">  
              <span class="badge badge-secondary ">
              <i class=" mx-2	fas fa-calendar-alt"></i>'. $Valuation_date.' </span>
            </div>
           
            <br>
          </div>
          <hr class="text-light">
       
             
                <div class="container mb-1 p-2  rounded ">
                  <div class="row px-1">
                    <div class="col-lg-12" style="word-break: break-all;">
                        
                         <h5 class="text-dark font-weight-bold ">Discription</h5> 
                        '.$Valuation_discription.'
                        <hr class="w-100 text-light">
                        
                    </div>
                    <div class="col-12">
                      <p class="text-dark  "style="overflow:auto">
                       <h5 class="text-dark font-weight-bold ">Method</h5> 
                      '.$Valuation_Method.'
                      <hr class="w-100 text-light">
                      </p>
                  </div>
                   <div class="col-12">
                        <p class="text-dark  "style="overflow:auto">
                         <h5 class="text-success font-weight-bold ">Price</h5> 
                        '.$Valuation_price.' BIRR
                        <hr class="w-100 text-light">
                        </p>
                    </div>
       
                  </div>
       
                </div>
              
          </div>';

         
         
         
         

       }





      }
      else
      {
       echo'  <!-- valuation button -->
       <div class="container  w-100 float-right my-3 mx-2" style="right:0;">
       <div class="row">
       <div class="col">
       <button class="btn valuate_buttons btn-light  float-right  w-100 font-weight-bold " onclick ="valuate_post('.$post_ID.')" style="right:0;">Valuate</button>
       
       </div>
       
       </div>
       </div>
       <!-- end valuation button -->
    
       ';
      }



  }
  //for broker view valuation 
  elseif($acc=='Broker')
  {
   $sql2="SELECT valuation.Valuation_discription, valuation.Valuation_Method, valuation.Valuation_price, valuation.Valuation_date, valuation.Post_ID,broker.First_name, broker.Last_name, broker.Profile_pic
   FROM valuation 
     LEFT JOIN broker ON valuation.Broker_ID = broker.Broker_ID WHERE broker.Broker_ID='$Account_ID' AND valuation.Post_ID='$post_ID'";
     $result2=$conn->query($sql2);
     if($result2->num_rows>0)
     {
      $profile_pic=null;
    
      $Valuation_discription=null;
      $Valuation_Method=null;
      $Valuation_price=null;
      $Valuation_date=null;
      while( $row=$result2->fetch_assoc())
      {
        
      $First_name=$row['First_name'];
      $Last_name=$row['Last_name'];
      $profile_pic=$row['Profile_pic'];
      $Valuation_discription=$row['Valuation_discription'];
      $Valuation_Method=$row['Valuation_Method'];
      $Valuation_price=$row['Valuation_price'];
      $Valuation_date=$row['Valuation_date'];
        echo'
        <div class="container  rounded  w-100 text-dark  px-2 my-3">
         
          <div class="row  py-2 px-5">
             <h5 class="text-dark font-weight-bold display-4 w-100 ">valuated</h5> 
            <img class="rounded-circle float-left mx-2 mb-2"  src="'.$profile_pic.'" style="height:60px;width:60px" alt="profile pic">
            <h4 class="mx-2 py-3 mb-2">'.$First_name.' '.$Last_name.'</h4>
            <div class="container float-right ">  
              <span class="badge badge-secondary ">
              <i class=" mx-2	fas fa-calendar-alt"></i>'. $Valuation_date.' </span>
            </div>
           
            <br>
          </div>
          <hr class="text-light">
       
             
                <div class="container mb-1 p-2  rounded ">
                  <div class="row px-1">
                    <div class="col-lg-12" style="word-break: break-all;">
                        
                         <h5 class="text-dark font-weight-bold ">Discription</h5> 
                        '.$Valuation_discription.'
                        <hr class="w-100 text-light">
                        
                    </div>
                    <div class="col-12">
                      <p class="text-dark  "style="overflow:auto">
                       <h5 class="text-dark font-weight-bold ">Method</h5> 
                      '.$Valuation_Method.'
                      <hr class="w-100 text-light">
                      </p>
                  </div>
                   <div class="col-12">
                        <p class="text-dark  "style="overflow:auto">
                         <h5 class="text-success font-weight-bold ">Price</h5> 
                        '.$Valuation_price.' BIRR
                        <hr class="w-100 text-light">
                        </p>
                    </div>
       
                  </div>
       
                </div>
              
          </div>';

        
        
        
        

      }





     }


   else
   {
    echo'  <!-- valuation button -->
    <div class="container  w-100 float-right my-3 mx-2" style="right:0;">
    <div class="row">
    <div class="col">
    <button class="btn buttons btn-light  float-right  w-100 font-weight-bold " onclick ="valuate_post('.$post_ID.')" style="right:0;">Valuate</button>
    
    </div>
    
    </div>
    </div>
    <!-- end valuation button -->
 
    ';
   }

  }


}

 }
 
 // center the image if a post hase only one image

 elseif( $result2->num_rows ==1)
 { 
   echo'
   <!-- image holder div -->
   <div class="container ">
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
   <!-- end of image holder div -->
   ';

 if(isset($_POST['Account_ID'])&&isset($_POST['ACCtype']))
 {
   $acc=$_POST['ACCtype'];
   $Account_ID=$_POST['Account_ID'];
   //for AVC display valuation
   if($acc=='AVC')
   {
     $sql2="SELECT valuation.Valuation_discription, valuation.Valuation_Method, valuation.Valuation_price, valuation.Valuation_date, valuation.Post_ID, avc.name, avc.License_status, avc.Profile_pic
FROM valuation 
	LEFT JOIN avc ON valuation.AVC_ID = avc.AVC_ID WHERE avc.AVC_ID='$Account_ID'AND valuation.Post_ID='$post_ID'";
        $result2=$conn->query($sql2);
        if($result2->num_rows>0)
       {$name=null;
        $profile_pic=null;
        $License_status=null;
        $Valuation_discription=null;
        $Valuation_Method=null;
        $Valuation_price=null;
        $Valuation_date=null;
        while( $row=$result2->fetch_assoc())
        {
          
        $name=$row['name'];
        $profile_pic=$row['Profile_pic'];
        $License_status=$row['License_status'];
        $Valuation_discription=$row['Valuation_discription'];
        $Valuation_Method=$row['Valuation_Method'];
        $Valuation_price=$row['Valuation_price'];
        $Valuation_date=$row['Valuation_date'];
          echo'
          <div class="container  rounded  w-100 text-dark  px-2 my-3">
         
            <div class="row  py-2 px-5">
               <h5 class="text-dark font-weight-bold display-4 w-100 ">valuated</h5> 
              <img class="rounded-circle float-left mx-2 mb-2"  src="'.$profile_pic.'" style="height:60px;width:60px" alt="profile pic">
              <h4 class="mx-2 py-3 mb-2">'.$name.'</h4>
              <div class="container float-right ">  
                <span class="badge badge-secondary ">
                <i class=" mx-2	fas fa-calendar-alt"></i>'. $Valuation_date.' </span>
              </div>
             
              <br>
            </div>
            <hr class="text-light">
         
               
                  <div class="container mb-1 p-2  rounded ">
                    <div class="row px-1">
                      <div class="col-lg-12" style="word-break: break-all;">
                          
                           <h5 class="text-dark font-weight-bold ">Discription</h5> 
                          '.$Valuation_discription.'
                          <hr class="w-100 text-light">
                          
                      </div>
                      <div class="col-12">
                        <p class="text-dark  "style="overflow:auto">
                         <h5 class="text-dark font-weight-bold ">Method</h5> 
                        '.$Valuation_Method.'
                        <hr class="w-100 text-light">
                        </p>
                    </div>
                     <div class="col-12">
                          <p class="text-dark  "style="overflow:auto">
                           <h5 class="text-success font-weight-bold ">Price</h5> 
                          '.$Valuation_price.' BIRR
                          <hr class="w-100 text-light">
                          </p>
                      </div>
         
                    </div>
         
                  </div>
                
            </div>';

          
          
          
          

        }





       }
       else
       {
        echo'  <!-- valuation button -->
        <div class="container  w-100 float-right my-3 mx-2" style="right:0;">
        <div class="row">
        <div class="col">
        <button class="btn valuate_buttons btn-light  float-right  w-100 font-weight-bold " onclick ="valuate_post('.$post_ID.')" style="right:0;">Valuate</button>
        
        </div>
        
        </div>
        </div>
        <!-- end valuation button -->
     
        ';
       }



   }
   //for broker view valuation 
   elseif($acc=='Broker')
   {
    $sql2="SELECT valuation.Valuation_discription, valuation.Valuation_Method, valuation.Valuation_price, valuation.Valuation_date, valuation.Post_ID,broker.First_name, broker.Last_name, broker.Profile_pic
    FROM valuation 
      LEFT JOIN broker ON valuation.Broker_ID = broker.Broker_ID WHERE broker.Broker_ID='$Account_ID' AND valuation.Post_ID='$post_ID'";
      $result2=$conn->query($sql2);
      if($result2->num_rows>0)
      {
       $profile_pic=null;
     
       $Valuation_discription=null;
       $Valuation_Method=null;
       $Valuation_price=null;
       $Valuation_date=null;
       while( $row=$result2->fetch_assoc())
       {
         
       $First_name=$row['First_name'];
       $Last_name=$row['Last_name'];
       $profile_pic=$row['Profile_pic'];
       $Valuation_discription=$row['Valuation_discription'];
       $Valuation_Method=$row['Valuation_Method'];
       $Valuation_price=$row['Valuation_price'];
       $Valuation_date=$row['Valuation_date'];
         echo'
         <div class="container  rounded  w-100 text-dark  px-2 my-3">
         
          <div class="row  py-2 px-5">
             <h5 class="text-dark font-weight-bold display-4 w-100 ">valuated</h5> 
            <img class="rounded-circle float-left mx-2 mb-2"  src="'.$profile_pic.'" style="height:60px;width:60px" alt="profile pic">
            <h4 class="mx-2 py-3 mb-2">'.$First_name.' '.$Last_name.'</h4>
            <div class="container float-right ">  
              <span class="badge badge-secondary ">
              <i class=" mx-2	fas fa-calendar-alt"></i>'. $Valuation_date.' </span>
            </div>
           
            <br>
          </div>
          <hr class="text-light">
       
             
                <div class="container mb-1 p-2  rounded ">
                  <div class="row px-1">
                    <div class="col-lg-12" style="word-break: break-all;">
                        
                         <h5 class="text-dark font-weight-bold ">Discription</h5> 
                        '.$Valuation_discription.'
                        <hr class="w-100 text-light">
                        
                    </div>
                    <div class="col-12">
                      <p class="text-dark  "style="overflow:auto">
                       <h5 class="text-dark font-weight-bold ">Method</h5> 
                      '.$Valuation_Method.'
                      <hr class="w-100 text-light">
                      </p>
                  </div>
                   <div class="col-12">
                        <p class="text-dark  "style="overflow:auto">
                         <h5 class="text-success font-weight-bold ">Price</h5> 
                        '.$Valuation_price.' BIRR
                        <hr class="w-100 text-light">
                        </p>
                    </div>
       
                  </div>
       
                </div>
              
          </div>';

         
         
         
         

       }





      }


    else
    {
     echo'  <!-- valuation button -->
     <div class="container  w-100 float-right my-3 mx-2" style="right:0;">
     <div class="row">
     <div class="col">
     <button class="btn buttons btn-light  float-right  w-100 font-weight-bold " onclick ="valuate_post('.$post_ID.')" style="right:0;">Valuate</button>
     
     </div>
     
     </div>
     </div>
     <!-- end valuation button -->
  
     ';
    }

   }


 }


 


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
  else
  {

  }

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



// to display for valuation

 if(isset($_POST['Post_ID']))
 {
    $post_ID=$_POST['Post_ID'];
    $sql2="SELECT * FROM image_url WHERE Post_ID='$post_ID'";
    $result2=$conn->query($sql2);
    //make a slide show if image is greater than two
    if($result2->num_rows >2)
    {
      echo'
      <div class="row">
      <div class="container rounded">
      <div id="demo" class="carousel slide w-100  rounded" data-ride="carousel">

      <!-- Indicators -->
      <ul class="carousel-indicators">
        <li data-target="#demo" data-slide-to="0" class="active"></li>
        <li data-target="#demo" data-slide-to="1"></li>
        <li data-target="#demo" data-slide-to="2"></li>
        <li data-target="#demo" data-slide-to="3"></li>
      </ul>
    
      <!-- The slideshow -->
      <div class="carousel-inner w-100 rounded">';
      $counter=0;
      while( $row=$result2->fetch_assoc())
      {
        if ($counter==0){
          echo'
          <div class="carousel-item active w-100  ">
        <img src="'.$row['Img_url'].'"class="img-fluid" alt="food">
        <div class="carousel-caption">
        
      </div>
      </div>';
          $counter++;}
          else{
        echo'
        <div class="carousel-item w-100 ">
        <img src="'.$row['Img_url'].'"class="w-100" alt="food">
        <div class="carousel-caption">
        
      </div>
      </div>';
          }
      }
      echo
      '
      </div>

  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
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





 }


  

?>