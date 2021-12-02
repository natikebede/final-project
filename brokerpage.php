<?php
session_start();
$broker_ID=$_SESSION['Broker_ID'];

if(!isset($_SESSION['Broker_ID']))
{
  
  
  echo'<script> window.location.href="index.php"; </script>';
}





include "php/connection.php";
if(isset($_POST['logout']))
{
  $sql="UPDATE broker SET Account_status='not active' WHERE Broker_ID='$broker_ID'";
  if($conn->query($sql)===true)
  {
    $_SESSION['Broker_ID']=null;
    echo'<script> window.location.href="index.php"; </script>';

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

$conn=$GLOBALS['conn'];
    $sql = "SELECT `broker`.`First_name`, `broker`.`Last_name`,`broker`.`email`, `broker`.`city`, `broker`.`wereda`, `broker`.`Profile_pic`, `broker`.`create_date`, `account`.`Username`, `account`.`Password`,`score`.`Score_point`
     FROM `broker` LEFT JOIN `account` ON `account`.`Broker_ID` = `broker`.`Broker_ID` 
     LEFT JOIN `score` ON `score`.`Broker_ID` = `broker`.`Broker_ID` WHERE `broker`.`Broker_ID`='$broker_ID'";
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
  $score=null;
  $post_amount=null;
  $phone=array();

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
      $profile_pic=$row['Profile_pic'];
      $name=$row['First_name']." ".$row['Last_name'];
      $first_name=$row['First_name'];
      $last_name=$row['Last_name'];
      $score=$row['Score_point'];
     

    }
    $sql="SELECT * FROM  broker_phonenumber where Broker_ID='$broker_ID'";
    $result=$conn->query($sql);
    if($result->num_rows >0)
    {
        $phonenumber=null; 
        $count=0;
        while( $row=$result->fetch_assoc() )  
        {  
            $phonenumber=$row['Phone_number'];
            $phone[$count]=$phonenumber;
            $count++;
        }

    }
    else
    {
      echo'
 
          ';
    }
    if($score >=5000)
    {
      $sql="UPDATE `broker` SET `account_veryfiy` = 'approved' WHERE Broker_ID='$broker_ID'";
      
      if($conn->query($sql)===true)
      {
         
      }

    }
  }
  else
  {
    echo'<div id= "toadd" class="show" >
    <div class=" w3-animate-zoom">
      <div class="container p-2" id="success" >
          <div class="alert alert-danger alert-dismissible fade show">
          <strong>!</strong> Error:'. $sql . '<br>' . $conn->error.' !!<br>
          <strong>!</strong> Error: while reteriving account info !!
              <P>
              <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
          </div>
      </div>
    </div>
  </div>';

  }



?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <title>AVS.com/Broker_page/<?php echo $user_name?></title>
        <link href="back_images/logo.png" rel="icon">
        <meta charset="utf-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        
        <link rel="stylesheet" href="css/brokerpage.css">
        <link rel="stylesheet" href="css/chat_css.css">
        <link rel="stylesheet" href="fonts/css/all.css">

        
        <!-- link to the bootstrap ,ajax,...-->
      
        <script src="js/jquery.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/registration_validation.js"> </script>
        <script src="js/brokerscript.js"> </script>
        <style>
          .social-links a {
    font-size: 30px;
    display: inline-block;
    color: gainsboro;
    line-height: 0;
    margin-right: 10px;
    transition: 0.3s;}
    .back-to-top i {
  font-size: 24px;
  color: #fff;
  line-height: 0;
}
.chat-box
{
   height: 500px;
   overflow-y: scroll;
   background-color: #f7f7f7;
   padding:10px 30px 20px 30px;
   box-shadow:inset 0 32px 32px -32px rgb(0 0 0 /5%), 
}
:is(.chat-box)::-webkit-scrollbar
  {
    width:0px;  
  }
.back-to-top:hover {
  background: #6776f4;
  color: #fff;
}

    .back-to-top {
  position: fixed;
  right: 20px;
  bottom: 15px;
  z-index: 99999;
  background: #4154f1;
  width: 40px;
  height: 40px;
  border-radius: 4px;
  transition: all 0.4s;
}
 
.icons
{
    cursor: pointer;
}
.twitter-icons:hover
{  color:rgb(8, 148, 230);
    background-color: rgb(255, 255, 255);
    
}
.facebook-icons:hover
{ 
  color:rgb(8, 148, 230);
    background-color: rgb(255, 255, 255);
    
}
.instagram-icons:hover
{     color:rgba(230, 52, 8, 0.842);
    background-color:  rgb(255, 255, 255);
    
}
        </style>
       
    </head>
    <body class="bg-secondary"style="bg" onload='phone_upload ()'>
    <script>
      
      
      </script>
 
        <!-- nav bar for the page-->
        <header>
            <nav class="navbar navbar-expand-lg  nav-light mb-3 bg-light">
                <div class= "d-lg-block collapse">  
                  <a class="navbar-brand" href="#"><img src="back_images/logo_transparent.png" class="rounded "alt="Logo" style="width:60px;"> 
                  <span id="log-AVS" class=" font-weight-bolder">AVS</span></a>
                </div>
               
                <button class="navbar-toggler d-lg-none float-right "type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="	fa fa-bars bg-light" ></span>
                </button>
                 
              <div class="collapse navbar-collapse w-100  p-1 rounded " id="navbarTogglerDemo02">
                <ul class="navbar-nav  ">
                  <li class="nav-item"> 
                    <button type="button" class="btn buttons mx-3 font-weight-bolder " id="home_button" >Home</button>

                  </li>
                 
                  <li class="nav-item">
                  <button type="button" class="btn buttons mx-3 font-weight-bolder   " id="valuations_button">Valuations<i class="mx-2 fas fa-upload"></i></button>

                  </li>
                  
                 
                
                </ul>
                <button class="btn d-lg-none buttons mx-3 font-weight-bolder  " type="button" data-toggle="collapse" data-target="#myprofile" aria-controls="myprofile" aria-expanded="false" aria-label="Toggle navigation">my profile</button>
                
                <div class="d-flex  ">
                  <form name= "logout" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                  <input type ="submit" name="logout"  class="btn d-xl-block   buttons mx-4 float-right font-weight-bolder  " value="Logout" > 
              </form>
              </div>
                
              </div>
             
                     
              <div class=" container  float-right  w-100 mt-3 mr-5">
                <div class="row w-100">
                <div class="col-sm-12  w-100">
                  <form class="form-inline" action="/action_page.php">
                    <div class="input-group w-100  ">
                      <input class="form-control border border-success "  type="search" id="search-bar"  placeholder="Search">
                      <div class="input-group-append rounded">
                        <button class="btn btn-success" type="submit"><i class="fas fa-search"></i></button>
                      </div>
  
                    </div>
                      </form>



                </div>

                <!-- the result of the search will be displayed below-->

                <div class="col-sm-12 ">
                  <div class=" container px-0 my-2 drop-down bg-white rounded " 
                     style=" position:absolute; z-index:2; overflow-x: auto;"   id="search-dropdown" >

                  
                   </div>
                      
                      
                    </div> 



                </div>

                </div>
             
              </div>
                 

            </nav>
          </header>





<!--############################## here to diplay the search result when clicked on the view profile ###############################################################################################-->


<div class="container  ">
  <div class="modal fade rounded" id="profile_view">
      <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
          <button type="button" class="close float-right" data-dismiss="modal">&times;</button>
          <div class="modal-body rounded bglight  ">
          <div class="container-fluid" id="viewprofile">
            



          </div>
          </div>
        </div>


      </div>



  </div>
</div>




 <!--############################## end of to diplay the search result when clicked on the view profile ###############################################################################################-->








<!--##################################### home content ##################################################################################################### -->
                

            <div class="conatiner-fluid  p-3" id="home_content">
              <div class="row">
      
                
                <!--##################################### left side section ##################################################################################################### -->
                
                <div id="myprofile" class="col-lg-2  d-lg-block h-50 collapse rounded textcolor shadow-lg p-4 mb-4  mx-3 bg-dark">

                  <h4 id="pro-text" class=" text-center text-light font-weight-bolder"> <?php echo $name?></h5>
                  <hr class="text-secondary">

                  <div class="row">
                    <img class="rounded-circle mx-auto "  src="<?php echo $profile_pic?>" style="height:106px;width:106px" alt="profile pic">
                   
                  </div>
                  <div class="row  my-4">
                    <button class=" mx-auto btn btn-primary text-light w-100 " id="edit" >Edit <span class="mx-2 fas fa-pen"></span></button>
                  </div>

                  <hr class="text-secondary">
                  <div class="container-fluid px-0">
                    <div class="row">
                      <div class="col-sm px-0">
                      <ul class=" list-unstyled">
                        <li class="mx-auto text-light font-weight-bold text-center my-2">Info</li>
                        
                        <li class=" text-light font-weight-bold small my-1"><span class="   fas fa-user-circle mx-2"></span> <?php echo $user_name?></li>
                        <li class=" text-light font-weight-bold small my-1 " ><span class="  fas fa-envelope-square text-nowrap mx-2"></span><?php echo $email?>  </li>
                        <?php
                        for($i=0;$i<count($phone);$i++)
                        {
                          echo
                          '
                          <li class=" text-light  font-weight-bold  small my-1"><span class="   fas fa-phone-square-alt mx-2"></span> '.$phone[$i].'</li>
                          
                          ';

                        }
                        
                        
                        ?>
                       
                        <li class=" text-light  font-weight-bold small my-1"><span class="  	fas fa-home mx-2"></span> <?php echo $address?> </li>
                        
                      </ul>
                     </div>

  
                    </div>
                  </div>
                  

                </div> 
                <!-- ############################################-->


                <!--##################################### middel section ##################################################################################################### -->
                
                <div class="col-lg-9 rounded  p-2  mb-4  mx-1 " id="post_view">
          
                 
                  
                </div>

                <!--end of middle section-->


                



                 <!-- #################################### right side section #########################################################################################################-->
                        <!--
                <div class="col-lg-2 rounded shadow-lg p-4 mb-4  mx-3 bg-dark">
                 
                </div>
               end of left side section-->
  
              </div>
             
            </div>
 <!--##################################### end of home content ##################################################################################################### -->
                







 <!--##################################### upload content ##################################################################################################### -->
                
            
          <div class="container-fluid  px-5  " id="uploads_content" style="display:none;">
            <div class="row shadow-lg  rounded" style="background-color: gainsboro;">
                <div class="col-lg-6 p-2" id="valuation_image">



                </div>
                <div class="col-lg-6 " id="valuation_form">
                    <form action="php/upload_valuation.php" method="POST" enctype="multipart/form-data" name="valuation_form_broker">

                        <div class="form-group">
                            <label for="Discription " class="font-weight-bolder">Discription:</label>
                            <textarea class="form-control" rows="6" name="valuation_discription" id="comment" required></textarea>
                          </div>

                          <div class="form-group col-lg  py-2">
                            <label for="valuation_price" class="font-weight-bolder">valuation Price:</label>
                            <div class="input-group w-100  ">
                                <input class="form-control border border-success " name="valuation_price" type="text" required placeholder="200,000">
                                <div class="input-group-append rounded">
                                  <button class="btn btn-success text-light" type="submit"><i class="">Birr</i></button>
                                </div>
            
                              </div>
                        </div>

                        <div class="form-group  py-2">
                            <label for="valuation_method" class ="font-weight-bolder">Valuation method:</label>
                            <input type="text" class="mx-auto form-control w-100 "  placeholder="Market value method" id="valuation_method" name="valuation_method" required>
                            
                          </div>

                          <div class="form-group  py-2">
                            
                            <input type="text" class="mx-auto form-control w-100 " name="post_ID" hidden  id="post_ID">
                            
                          </div>

                          
                          <div class="form-group  py-2">
                           
                            <input type="text" class="mx-auto form-control w-100 " name="account_type" hidden  id="" value="Broker">
                            
                          </div>

                        <div class=" container d-flex flex-row-reverse ">
                            <input type ="submit"  name="valuation" value="post" style="width: 100px;"  class="  mx-4 btn btn-success my-4">
                            <input type ="reset" value ="reset" style="width: 100px;" width="100px"name= "rest" class="mx-4  btn btn-primary my-4">  
                        </div>

                    </form>
                </div>
                

            </div>
      

          </div>

 <!--##################################### end of upload content ##################################################################################################### -->
     
 



 
 <!--##################################### valuation content ##################################################################################################### -->
                
          
 <div class="container-fluid  px-5  " id="valuation_content" style="display:none;">
  <div class="row shadow-lg  rounded" style="background-color: white;">
    <div class="container-fluid py-5">
      <div class="row bg-white ">
        <div class="col-lg-5 d-flex align-items-center p-5  bg-white">
         <div class=" mx-auto p-0 bg-primary rounded float-left "style="width: 300px;height: 100px;box-sizing: border-box;">

          <div class="ml-2   p-0 w-100 h-100 bg-light  rounded-right shadow" >
            <h5  class=" text-primary w-100 p-2 text-center font-weight-bold" id="post_amount_count">0   
                     
            </h5> 
            <h5  class=" textcolor w-100 p-2 text-center font-weight-bold" id="post_amount_count">valuation   
                     
            </h5> 

          </div>
         </div>
        </div>

        <div class="col-lg-5 d-flex align-items-center p-5   bg-white">

         <div class="  mx-auto p-0 bg-success rounded float-left "style="width: 300px;height: 100px;box-sizing: border-box;">

          <div class="ml-2   p-0 w-100 h-100 bg-light  rounded-right shadow" >
            <h5  class=" text-success w-100 p-2 text-center font-weight-bold" id="post_amount_count"><?php echo $score?> 
                     
            </h5> 
            <h5  class=" textcolor w-100 p-2 text-center font-weight-bold" id="post_amount_count">Score 
                     
            </h5> 

          </div>
         </div>
          
        </div>
      </div>

    </div>
        <div class="col table-responsive-lg  rounded " id="valuation_table">
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

      </div>
    


</div>
</div>
<!--##################################### end of valuation content ##################################################################################################### -->



<!--###################################### edit profile contnet here #################################################################################################################-->


<div class="container-fluid  " id="edit_profile" style="display:none">
  <div class="container rounded bg-light shadow-lg ">
    <div class="row ">

    <div class="col-lg-8 ">
      <form name="update_Broker"  class =" py-3 " method ="POST" action="php/update_account.php" enctype="multipart/form-data">

        <div class="form-group py-0">
          <div class=row>
            <div class="form-group col-lg  py-2">
                <label for="fullname" class="font-weight-bolder">Firstname:</label>
                <input type="text" class="form-control w-100"  onkeyup='fname_validation("update_Broker")' value="<?php echo $first_name?>" placeholder="Enter firstname" id="cfirstname" name="firstname" required>
            </div>

            <div class="form-group col-lg py-2">
                <label for="fullname" class="font-weight-bolder">Last name:</label>
                <input type="text" class="form-control w-100 "  onkeyup='lname_validation("update_Broker")'  value="<?php echo $last_name?>" placeholder="Enter lastname" id="clastname" name="lastname" required>
            </div>
        </div>
      </div>

      <div class="form-group  py-2">
          <label for="username" class ="font-weight-bolder">Username:</label>
          <input type="username" class="mx-auto form-control w-100 "value="<?php echo $user_name?>" disabled  placeholder="Enter Username" id="cusername" name="username" required>
          <span id="pass_location"class= " username_location btn bg-danger fa fa-warning py text-white my-2 font-weight-bolder"  style="display :none;"></span>
        </div>

      <div class="form-group py-0">
        <div class=row>
          <div class="form-group col-lg  py-2">
            <label for="pwd" class ="font-weight-bolder">Password:</label>
            <input type="password"  value="<?php echo $pwd?>" class="mx-auto form-control w-100 " onblur='validation_Cpassword("update_Broker",0)' placeholder="Enter password" id="cpwd" name="password" required>
            <span id="pass_location" class= " pass_location btn bg-danger fa fa-warning py text-white my-2 font-weight-bolder" style="display :none;"></span>
          </div>

          <div class="form-group col-lg py-2">
            <label for="pwd" class ="font-weight-bolder">re-Password:</label>
            <input type="password"   value="<?php echo $pwd?>" class="mx-auto form-control w-100 "  onblur='validation_Cpassword("update_Broker",0)' placeholder="re Enter your password" id="crepwd" name="repassword" required>
            <span id="repass_location" class=" repass_location btn bg-danger fa fa-warning py text-white my-2 font-weight-bolder" style="display :none;"></span>
          </div>
      </div>
     
    </div>

    

      <div class="form-group  py-2">
          <label for="email" class ="font-weight-bolder">Email:</label>
          <input type="email" value="<?php echo $email?>" class=" mx-auto form-control w-100 " onblur='validation_Cemail("update_Broker",0)'  placeholder="Enter email" id="cemail" name="email" required>
          <span id="email_location"class="email_location btn bg-danger fa fa-warning py text-white my-2 font-weight-bolder" style="display :none;"></span>
      </div>

      <div class="form-group py-2">
        <div class=row>
          <div class="col-lg-8">
            <label for="tel" class ="font-weight-bolder">Phonenumber:</label>
          
            <span id="phone_location"class=" phone_location btn bg-danger fa fa-warning py text-white my-2 font-weight-bolder" style="display :none;"></span>
            <div class="container" class="phonenumberdisplay" id="phonenumberdisplay" >

          </div>
            
          </div>
          <div class="col-lg-4">
            <input type ="button"  name="signup_client" value=" +ADD " data-toggle="modal" data-target="#addphone" style="width: 100px;"  class="mx-auto btn btn-primary  my-4">
                          
          </div>
          
        </div>
       
          
      </div>

      <div class="form-group py-0">
          <label for="address" class ="font-weight-bolder">Address:</label>
          <div class=row>
            <div class="form-group col-lg  py-2">
                <label for="city" class="font-weight-bolder">City:</label>
                <input type="text" value="<?php echo $city?>" class="form-control w-100" placeholder="Enter your city" id="ccity" name="city" required>
            </div>

            <div class="form-group col-lg py-2">
                <label for="wereda" class="font-weight-bolder">Wereda:</label>
                <input type="text" value="<?php echo $wereda?>"class="form-control w-100 " placeholder="Enter your wereda" id="cwereda" name="wereda" required>
            </div>
        </div>
      </div>      

       <div class=" container d-flex flex-row-reverse ">
        <input type ="submit"  name="update_Broker" value=" update " style="width: 100px;"  class=" signups mx-4 btn btn-success my-4">
          
        </div>


       
    </div>

    <div class="col-lg-4  ">

      <div  class="container rounded-circle p-0 border mx-1 my-3"style="width:300px;height: 350px; " >

        <img id="" class=" forpic img-fluid border border-primary rounded rounded-circle" style="width:300px;
        height: 350px; " src=" <?php echo $profile_pic?>" alt="">

        </div>

        
         <div class="custom-file">
           <input type="file" name="profile_pic[]" onchange="loadFile(event,1)"  multiple class="profile  custom-file-input" id="customFile">
           <label class="custom-file-label " for="customFile">upload picture</label>
           <script>
             $(".profile").on("change", function() {
                  var fileName = $(this).val().split("\\").pop();
                  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                });

               
           </script>
       </div>
    </div>

<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% holds type of account and serial%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
  </form>
      <form name="serial" method ="POST" action="" enctype="multipart/form-data">
      <input type="text" class="mx-auto form-control w-100 "  hidden value="<?php echo $broker_ID?>"  name="ID" >
      <input type="text" class="mx-auto form-control w-100 "  hidden value="Broker"  name="Account_type" >
    </form>
     <!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% end of form that holds type of account and serial%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->


    </div>

  </div>


</div>
<div class="modal fade   mt-5  " id="addphone" >
  <div class="modal-dialog bg-dark border-0 rounded modal-lg modal-dialog-centered">
    <div class="modal-content  border-0 bg-dark text-light">
     <div class="modal-header border-0 ">
     <button type="button" class="close my-2 text-white" data-dismiss="modal">&times;</button>
     </div>
        <div class="container">
        
          <div class="row">
            <h4 class="w-100 mx-auto text-center font-weight-bold my-3">Add new phonenumber</h4>
            <hr class="text-secondary">
            

            
          </div>
          <form name="addphone_number" method="POST" action="php/phone_number_load.php" enctype="multipart/form-data" >
            
            
            <input type="tel" class="mx-auto form-control w-75 "  onkeypress='validation_Cphone ("addphone_number",1)' placeholder="Enter phonenumber" id="phonenumber" name="phonenumber" required>
            <input type="text" class="mx-auto form-control w-75 " value="Broker" name='ACCtype' hidden >
            <span id="phone_location"class=" phone_location btn bg-danger fa fa-warning py text-white my-2 font-weight-bolder" style="display :none;"></span>
            <input type ="submit"   name="addphone" value=" ADD " style="width: 100px;"  class=" signups float-right  mr-4 btn btn-success my-4">
          </form>
        </div>
     
      
    </div>
  </div>  
  

</div>
  


</div>






<!--##################################### end of update content ##################################################################################################### -->




<!--##################################### Chat model ##################################################################################################### -->



<div class="container  ">
  <div class="modal fade rounded" id="chat_view">
      <div class="modal-dialog  modal-xl modal-dialog-centered">
        <div class="modal-content">
       
          <div class="modal-header bg-light p-0" id="chat_header">
         
            </div>
          <div class="modal-body rounded p-2  ">
            <div class="container shadow-lg rounded p-0" id="chat-modal">
              <div class="row">
             
               <div class="col-lg-12 p-2  " style=" word-break: break-all;">
                <div class="chat-box" id="chat-log-display">
                  <div class="outgoing" >
                      <div class="details w-100 ">
                        <p class=" text-light bg-primary p-4" >
                          hey there man hey there manhey there manhey there man there manhey there 
                          man hey there manhey there manhey there man there man hey there man hey there manhey there manhey there man there 
                        </p>
                      </div>
      
                  </div>
      
                  <div class="outgoing" >
                    <div class="details ">
                      <p class=" text-light bg-primary p-4" >
                        hey there man hey there manhey there manhey there man there manhey there 
                       
                      </p>
                    </div>
      
                </div>
                  <div class="incoming">
                    <div class="details " >
                      <p class="text-light bg-info p-4 "  >
                        hey there man hey there manhey there manhey there man there manhey there 
                        man hey there manhey there manhey there man there man hey there man hey there manhey there manhey there man there 
                      </p>
                    </div>
      
                </div>
      
                </div>
      
               </div>
              </div>
             
      
      
            </div>
          </div>
          <div class="modal-footer" id="send_button">
            <div class="col-sm-12  w-100">
                  <form class="form-inline" action="/action_page.php">
                    <div class="input-group w-100  ">
                      <textarea class="form-control" rows="4" cols ="4 " id="usermsg" name="usermsg" required></textarea>
                      
                      <div class="input-group-append rounded">
                        <input name="submitmsg" class=" btn btn-primary"type="submit" id="submitmsg" value="Send">
                      </div>
  
                    </div>
                      </form>



                </div>
         
           </div>
        </div>


      </div>



  </div>
</div>

<!--##################################### Chat end of model ##################################################################################################### -->











<!--##################################### start of footer of  content ##################################################################################################### -->



  

  <div class=" px-3 text-light mt-3 " style="bottom:0;">
    <div class="container-fluid rounded bg-dark">
      <div class="row gy-4">
        <div class="col-lg-5 p-3  ">
          <a href="" class="logo d-flex align-items-center">
            <img src="back_images/logo_transparent.png" style="width:100px;">
            <span class="display-4  text-light  font-weight-bold"> AVS</span>
          </a>
          <p class=" px-3 font-weight-bold text-light">AVS offer modern solutions for growing your business.</p>
          <p class="px-3 font-weight-bold text-light">a digital and more  efficents way of  Asset valuation.</p>

          <div class="social-links px-4 mt-3">
            <a href="#" class="twitter icons p-1 rounded-circle twitter-icons"><i class="fab fa-twitter"></i></a>
            <a href="#" class="facebook icons  p-1 rounded-circle facebook-icons "><i class="fab fa-facebook"></i></a>
            <a href="#" class="instagram icons p-1  rounded-circle instagram-icons "><i class="fab fa-instagram fx fxl-instagram"></i></a>
            <a href="#" class="linkedin icons p-1 rounded-circle facebook-icons" ><i class=" 	fab fa-linkedin fx fxl-linkedin"></i></a>
          </div>
        </div>


        <div class="col-lg-3  p-3 ">
          <h4 class=" font-weight-bold w-100 text-center">Our Services</h4>
          <div class="list-group w-100 bg-dark font-weight-bold mx-auto border-0 ">
            <a href="#" class="list-group-item  border-0 text-decoration-none bg-dark text-light"><i class="fas fa-chevron-circle-right mx-1"></i>Web Design</a>
            <a href="#" class="list-group-item border-0 text-decoration-none bg-dark text-light"><i class="fas fa-chevron-circle-right mx-1"></i> Web Development</a>
            <a href="#" class="list-group-item border-0 text-decoration-none  bg-dark text-light"><i class="fas fa-chevron-circle-right mx-1"></i> Product Management</a>
            <a href="#" class="list-group-item border-0 text-decoration-none bg-dark text-light"><i class="fas fa-chevron-circle-right mx-1"></i> Marketing</a>
            <a href="#" class="list-group-item border-0 text-decoration-none bg-dark text-light"><i class="fas fa-chevron-circle-right mx-1"></i> Graphic Design</a>
          </div>
        </div>

        <div class="col-lg-3 p-3 footer-contact text-center text-md-start">
          <h4 class="font-weight-bold w-100 text-center">Contact Us</h4>
          <p class="font-weight-bold">
            <i class="fas fa-map-marked-alt text-info mx-2"style="font-size:25px;"></i> Ethiopia <br>
           Hawass University <br>
            Addis Ababa <br>
            <a href="#" class="list-group-item  border-0 text-decoration-none bg-dark text-light"><i class="   b fas fa-phone-square-alt mx-2" style="font-size:25px;"></i> <strong>Phone:</strong> +251910789943</a>
            <a href="#" class="list-group-item border-0 text-decoration-none bg-dark text-light "><i class="   	fas fa-envelope-square mx-2" style="font-size:25px;"></i><strong>Email:</strong> AVSdigital@gmail.com</a>
            
            
          </p>

        </div>

      </div>


      <div class="row bg-white text-dark">
        <div class="container mx-auto">
          <div class="font-weight-bolder">
            &copy; Copyright <strong><span>AVS</span></strong>. All Rights Reserved
          </div>
          
        </div>
      </div>
    </div>
 
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="fas fa-chevron-up"></i></a>
  
</div>










<!--##################################### end of footer of  content ##################################################################################################### -->


<script>
  function got_to_back()
  {
    history.back();
  }
</script>
 
    </body>
    </html>