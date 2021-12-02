<?php
session_start();
include "connection.php";
include "php/counter.php";
$Admin_ID=$_SESSION['Admin_ID'];

if(!isset($_SESSION['Admin_ID']))
{
  
  
  echo'<script> window.location.href="index.php"; </script>';
}






if(isset($_POST['logout']))
{
  $sql="UPDATE admin SET Account_status='not active' WHERE Admin_ID='$Admin_ID'";
  if($conn->query($sql)===true)
  {
    $_SESSION['Admin_ID']=null;
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





?>
<?php


include "connection.php";

    $Admin_ID=$_SESSION['Admin_ID'];
    $conn=$GLOBALS['conn'];
    $sql = "SELECT `admin`.`First_name`, `admin`.`Last_name`,`admin`.`Email`, `admin`.`City`, `admin`.`Wereda`, `admin`.`Profile_pic`, `admin`.`Create_date`, `account`.`Username`, `account`.`Password`
     FROM `admin` LEFT JOIN `account` ON `account`.`admin_ID` = `admin`.`admin_ID`  WHERE `admin`.`Admin_ID`='$Admin_ID'";
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
  $post_amount=null;
  $phone=array();

  $result= $conn->query($sql);
  if($result!=false && $result->num_rows ==1)
  {

    while($row=$result->fetch_assoc())
    {
        $user_name=$row['Username'];
        $pwd=$row['Password'];
        $email=$row['Email'];
        $address=$row['City'].",". $row['Wereda'];
    
        $city=$row['City'];
        $wereda= $row['Wereda'];
        $create_date=$row['Create_date'];
        $profile_pic=$row['Profile_pic'];
        $name=$row['First_name']." ".$row['Last_name'];
        $first_name=$row['First_name'];
        $last_name=$row['Last_name'];
     
     

    }
    
    
    $sql="SELECT * FROM  admin_phonenumber where Admin_ID='$Admin_ID'";
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
        <title>AVS.com/Admin_page/<?php echo $user_name?></title>
        <link href="back_images/logo.png" rel="icon">
        <meta charset="utf-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        
        <link rel="stylesheet" href="css/adminpage.css">
       
        <link rel="stylesheet" href="fonts/css/all.css">

        
        <!-- link to the bootstrap ,ajax,...-->
      
        <script src="js/jquery.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/registration_validation.js"> </script>
        <script src="js/adminscript.js"> </script>
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
    <body class="bg-dark">
    <script>
      
      
      </script>

        <!-- nav bar for the page-->
        <header>
            <nav class="navbar  nav-info mb-0 bg-light">

                <button class="navbar-toggler   "type="button" data-toggle="collapse" data-target="#panel"  aria-expanded="false" aria-label="Toggle navigation">
                    <span class="	fa fa-bars text-dark" ></span>
                  </button>

                <div class= "d-lg-block collapse mx-3">  
                  <a class="navbar-brand" href="#"><img src="back_images/logo_transparent.png" class="rounded "alt="Logo" style="width:60px;"> 
                  <span id="log-AVS" class=" font-weight-bolder">AVS</span></a>
                </div>
               
                
                 
              
               
               
                
                
              
             
                     
              <div class=" container  float-right  w-100 mt-3 mr-5">
                <div class="row w-100">
                <div class="col-sm-12  w-100">
                  <form class="form-inline" action="/action_page.php">
                    <div class="input-group w-100  ">
                      <input class="form-control border border-primary "  type="search" id="search-bar"  placeholder="Search">
                      <div class="input-group-append rounded">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                      </div>
  
                    </div>
                      </form>



                </div>

                <!-- the result of the search will be displayed below-->

                <div class="col-sm-12 ">
                  <div class=" container px-0 my-2 drop-down bg-light rounded " 
                     style=" position:absolute; z-index:2; overflow-x: auto;  "  id="search-dropdown" >

                  
                   </div>
                      
                      
                    </div> 



                </div>

                </div>


                <div class="d-flex  ">
                    <form name= "logout" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <input type ="submit" name="logout"  class="btn d-xl-block   buttons mx-4 float-right font-weight-bolder  " value="Logout" > 
                </form>
                </div>
             
              </div>
                 

            </nav>
          </header>





<!--############################## here to diplay the search result when clicked on the view profile ###############################################################################################-->


<div class="container  ">
  <div class="modal fade rounded" id="profile_view">
      <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
          <button type="button" class="close  float-right" data-dismiss="modal">&times;</button>
          <div class="modal-body rounded   " >
          <div class="container-fluid" id="viewprofile">
            



          </div>
          </div>
        </div>


      </div>



  </div>
</div>




 <!--############################## end of to diplay the search result when clicked on the view profile ###############################################################################################-->








<!--##################################### home content ##################################################################################################### -->
                
<!--dashbord section-->
            <div class="conatiner-fluid m-0 p-3" id="home_content">
                <div class="row">
                    <div class="col-lg bg-light mb-5 mt-0 p-5 ">
                        <h5 class="display-4 w-100 font-weight-bold px-5"> Dashbord </h5>
                        <div class="container d-lg-block collapse">
                            <div class="container-fluid py-3">
                                <div class="row ">
                                  <div class="col-lg-3 d-flex align-items-center p-3 ">
                                   <div class=" mx-auto p-0 bg-success rounded float-left "style="width: 200px;height: 100px;box-sizing: border-box;">
                          
                                    <div class="ml-2   p-0 w-100 h-100 bg-light  rounded-right shadow" >
                                      <h5  class=" text-primary w-100 p-2 text-center font-weight-bold" id="total_user_count"><?php echo $total_counter;?>  
                                           <span class="fas fa-users text-success"></span>    
                                      </h5> 
                                      <h5  class=" textcolor w-100 p-2 text-center font-weight-bold" id="">Active users  
                                               
                                      </h5> 
                          
                                    </div>
                                   </div>
                                  </div>
                          
                                  <div class="col-lg-3 d-flex align-items-center p-3   ">
                          
                                   <div class="  mx-auto p-0 bg-info rounded float-left "style="width: 200px;height: 100px;box-sizing: border-box;">
                          
                                    <div class="ml-2   p-0 w-100 h-100 bg-light  rounded-right shadow" >
                                      <h5  class=" text-info w-100 p-2 text-center font-weight-bold" id="total_Client_count"><?php echo $total_client_counter;?>   
                                        <span class="fas fa-users text-info"></span>    
                                      </h5> 
                                      <h5  class=" textcolor w-100 p-2 text-center font-weight-bold" >Happy clients
                                               
                                      </h5> 
                          
                                    </div>
                                   </div>
                                    
                                  </div>
                                   
                                  <div class="col-lg-3 d-flex align-items-center p-3   ">
                          
                                    <div class="  mx-auto p-0 bg-warning rounded float-left "style="width: 200px;height: 100px;box-sizing: border-box;">
                           
                                     <div class="ml-2   p-0 w-100 h-100 bg-light  rounded-right shadow" >
                                       <h5  class=" text-warning w-100 p-2 text-center font-weight-bold" id="total_company_count"><?php echo $total_company_counter;?> 
                                        <span class="far fa-building text-warning"></span>     
                                       </h5> 
                                       <h5  class=" text-dark w-100 p-2 text-center font-weight-bold" id="">Companys
                                                
                                       </h5> 
                           
                                     </div>
                                    </div>
                                     
                                   </div>

                                   <div class="col-lg-3 d-flex align-items-center p-3   ">
                          
                                    <div class="  mx-auto p-0  rounded float-left "style="background-color:#4154f1;width: 200px;height: 100px;box-sizing: border-box;">
                           
                                     <div class="ml-2   p-0 w-100 h-100 bg-light  rounded-right shadow" >
                                       <h5  class=" text-colors w-100 p-2 text-center font-weight-bold" id="total_Admin_count"><?php echo $total_Broker_counter;?>
                                        <span class="fas fa-user-tie text-colors"></span>      
                                       </h5> 
                                       <h5  class=" textcolor w-100 p-2 text-center font-weight-bold" id="">Brokers
                                                
                                       </h5> 
                           
                                     </div>
                                    </div>
                                     
                                   </div>
                                </div>
                          
                              </div>
                        </div>
                    </div>
                    

                </div>
            </div>

                <!--end of dashbord section-->
             
      
           
                <!--##################################### left side section ##################################################################################################### -->
                
                
                <div class="row">

                <div id="panel" class="col-lg-3  show h-50 collapse rounded textcolor bg-light shadow-lg p-4 mb-4  mx-3 " >
                    <button class="btn btn-light  font-weight-bold w-100  text-center" data-toggle="collapse" data-target="#navigation" style="font-size: 30px;"> control panel </button>
                    
                   <div class="container-fluid collapse show" id="navigation" data-parent="#panel">
                 <hr class="text-primary">
                    <nav class="navbar bg-light">
                        <ul class="navbar-nav w-100">
                            <li class="nav-item  my-1 p-2 ">
                                <button class="buttons btn  p-2 font-weight-bold" data-toggle="collapse" data-target="#myprofile" >profile <span class=" mx-2 far fa-address-card"> </span>  </button>
                              </li>
                          <li class="nav-item my-1 p-2  ">
                           
                            <button class="buttons btn   p-2 font-weight-bold " id="register_admin_button">Register Admin <span class=" mx-2 fas fa-user-circle"> </span>  </button>
                          </li>
                          <li class="nav-item my-1 p-2  ">
                            <button class="buttons btn   p-2 font-weight-bold" id="post_button"> post's  <span class="mx-2 far fa-edit"> </span> </button>
                          </li>
                          <li class="nav-item my-1 p-2  ">
                            <button class="buttons btn  p-2 font-weight-bold" id="dep_button">depreciation rate <span class="mx-2 fas fa-chart-line"> </span>   </button>
                          </li>
                          <li class="nav-item my-1 p-2  ">
                            <button class="buttons btn  p-2 font-weight-bold" id="account_button">Account's  <span class=" mx-2 fas fa-users-cog "> </span>  </button>
                          </li>
                          <li class="nav-item  my-1 p-2 ">
                            <button class="buttons btn  p-2 font-weight-bold" id="license_button">license Request <span class=" mx-2 fas fa-thumbtack"> </span>
                               <span class="badge badge-pill badge-primary"><?php echo $total_reqest_pending;?></span> 
                              </button>
                          </li>
                        </ul>
                      </nav>
                   </div> 




                    <!-- my profile diplay section-->

                    <div class="container-fluid collapse my-3"id="myprofile" data-parent="#panel">
                        <h4 id="pro-text" class=" text-center text-secondary font-weight-bolder"> <?php echo $name?></h5>
                            <hr class="text-secondary">
          
                            <div class="row">
                              <img class="rounded-circle mx-auto "  src="<?php echo $profile_pic?>" style="height:106px;width:106px" alt="profile pic">
                             
                            </div>
                            <div class="row  my-4">
                              <button class=" mx-auto btn btn-dark text-light w-100 " id="edit" >Edit <span class="mx-2 fas fa-pen"></span></button>
                            </div>
          
                            <hr class="text-secondary">
                            <div class="container-fluid px-0">
                              <div class="row">
                                <div class="col-sm px-0">
                                <ul class=" list-unstyled">
                                  <li class="mx-auto text-dark  font-weight-bold text-center my-2">Info</li>
                                  
                                  <li class=" text-dark font-weight-bold small my-1"><span class="   fas fa-user-circle mx-2"></span> <?php echo $user_name?></li>
                                  <li class=" text-dark font-weight-bold small my-1 " ><span class="  fas fa-envelope-square text-nowrap mx-2"></span><?php echo $email?>  </li>
                                  <?php
                                  for($i=0;$i<count($phone);$i++)
                                  {
                                    echo
                                    '
                                    <li class=" text-dark   font-weight-bold  small my-1"><span class="   fas fa-phone-square-alt mx-2"></span> '.$phone[$i].'</li>
                                    
                                    ';
          
                                  }
                                  
                                
                                  
                                  ?>
                                 
                                  <li class=" text-dark  font-weight-bold small my-1"><span class="  	fas fa-home mx-2"></span> <?php echo $address?> </li>
                        
                                  
                                </ul>
                               </div>
          
            
                              </div>
                            </div>
                            
                            <hr class="text-secondary">
          
                         
          
          
                    </div>

                  <!-- end of profile diplay section-->





                </div> 

                <!-- ############################################-->


                <!--##################################### middel section ##################################################################################################### -->
                
               <div class="col-lg p-3 bg-light rounded">
                


                <!-- ##############################################################edit profile section###############################################-->
                <div class="container-fluid  " id="edit_profile" style="display:none">
                    <h5 class="display-4 w-100 font-weight-bold"> Edit profile </h5>
                    <div class="container rounded bg-light ">
                      <div class="row ">
                  
                      <div class="col-lg-8 ">
                        <form name="update_admin"  class =" py-3 " method ="POST" action="php/update_admin.php" enctype="multipart/form-data">
                  
                          <div class="form-group py-0">
                            <div class=row>
                              <div class="form-group col-lg  py-2">
                                  <label for="fullname" class="font-weight-bolder">Firstname:</label>
                                  <input type="text" class="form-control w-100"  onkeyup='fname_validation("update_Admin")' value="<?php echo $first_name?>" placeholder="Enter firstname" id="cfirstname" name="firstname" required>
                              </div>
                  
                              <div class="form-group col-lg py-2">
                                  <label for="fullname" class="font-weight-bolder">Last name:</label>
                                  <input type="text" class="form-control w-100 "  onkeyup='lname_validation("update_Admin")'  value="<?php echo $last_name?>" placeholder="Enter lastname" id="clastname" name="lastname" required>
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
                              <input type="password"  value="<?php echo $pwd?>" class="mx-auto form-control w-100 " onblur='validation_Cpassword("update_Admin",0)' placeholder="Enter password" id="cpwd" name="password" required>
                              <span id="pass_location" class= " pass_location btn bg-danger fa fa-warning py text-white my-2 font-weight-bolder" style="display :none;"></span>
                            </div>
                  
                            <div class="form-group col-lg py-2">
                              <label for="pwd" class ="font-weight-bolder">re-Password:</label>
                              <input type="password"   value="<?php echo $pwd?>" class="mx-auto form-control w-100 "  onblur='validation_Cpassword("update_Admin",0)' placeholder="re Enter your password" id="crepwd" name="repassword" required>
                              <span id="repass_location" class=" repass_location btn bg-danger fa fa-warning py text-white my-2 font-weight-bolder" style="display :none;"></span>
                            </div>
                        </div>
                       
                      </div>
                  
                      
                  
                        <div class="form-group  py-2">
                            <label for="email" class ="font-weight-bolder">Email:</label>
                            <input type="email" value="<?php echo $email?>" class=" mx-auto form-control w-100 " onblur='validation_Cemail("update_Admin",0)'  placeholder="Enter email" id="cemail" name="email" required>
                            <span id="email_location"class="email_location btn bg-danger fa fa-warning py text-white my-2 font-weight-bolder" style="display :none;"></span>
                        </div>
                  
                        <div class="form-group py-2">
                          <div class=row>
                            <div class="col-lg-8">
                              <label for="tel" class ="font-weight-bolder">Phonenumber:</label>
                            
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
                          <input type ="submit"  name="update_Admin" value=" update " style="width: 100px;"  class=" signups mx-4 btn btn-success my-4">
                            
                          </div>
                  
                  
                         
                      </div>
                  
                      <div class="col-lg-4  ">
                  
                        <div  class="container rounded-circle p-0 border mx-1 my-3"style="width:300px;height: 350px; " >
                  
                          <img id="" class=" forpic img-fluid border border-primary rounded rounded-circle" style="width:300px;
                          height: 350px; " src=" <?php echo $profile_pic?>" alt="">
                  
                          </div>
                  
                          
                           <div class="custom-file">
                             <input type="file" name="profile_pic[]" onchange="loadFile(event,0)"  multiple class="profile  custom-file-input" id="customFile">
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
                        <input type="text" class="mx-auto form-control w-100 "  hidden value="<?php echo $Admin_ID?>"  name="ID" >
                        <input type="text" class="mx-auto form-control w-100 "  hidden value="Admin"  name="Account_type" >
                      </form>
                       <!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% end of form that holds type of account and serial%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
                  
                  
                      </div>
                  
                    </div>
                  
                  
                  </div>


                  <!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% start for phone modal %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
                  
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
                              
                              
                              <input type="tel" class="mx-auto form-control w-75 "  onkeypress='validation_Cphone ("addphone_number",0)' placeholder="Enter phonenumber" id="phonenumber" name="phonenumber" required>
                              <input type="text" class="mx-auto form-control w-75 " value="Admin" name='ACCtype' hidden >
                              <span id="phone_location"class=" phone_location btn bg-danger fa fa-warning py text-white my-2 font-weight-bolder" style="display :none;"></span>
                              <input type ="submit"   name="addphone" value=" ADD " style="width: 100px;"  class=" signups float-right  mr-4 btn btn-success my-4">
                            </form>
                          </div>
                       
                        
                      </div>
                    </div>  
                    
                  
                  </div>
                   <!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% end for phone modal %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->

               
                 <!-- ##############################################################end of profile section###############################################-->
                 
                 




                 
                 <!-- ##############################################################register admin section###############################################-->
                 
                 
                 
                 
                 <div class= "conatiner-fluid p-4" id="register_Admin" style="display: none;" >

                    <form name="register_admin"  class =" py-3 " method ="POST" action="php/register.php" enctype="multipart/form-data">
                        <h4 class=" display-4 text-dark mt-3">Register  new Admin </h4>
                        <div class="form-group py-0">
                        <div class=row>
                          <div class="form-group col-lg  py-2">
                              <label for="fullname" class="font-weight-bolder">Firstname:</label>
                              <input type="text" class="form-control w-100" onkeyup='fname_validation("register_admin")' placeholder="Enter firstname" id="bfirstname" name="firstname" required>
                          </div>
              
                          <div class="form-group col-lg py-2">
                              <label for="fullname" class="font-weight-bolder">Last name:</label>
                              <input type="text" class="form-control w-100 " onkeyup='lname_validation("register_admin")' placeholder="Enter lastname" id="blastname" name="lastname" required>
                          </div>
                      </div>
                    </div>
              
                    <div class="form-group  py-2">
                        <label for="username" class ="font-weight-bolder">Username:</label>
                        <input type="username" class="mx-auto form-control w-100 " onblur='validation_username("register_admin",1)' placeholder="Enter Username" id="busername" name="username" required>
                        <span id="bpass_location"class= " username_location btn bg-danger fa fa-warning py text-white my-2 font-weight-bolder" style="display :none;"></span>
                      </div>
              
                    <div class="form-group py-0">
                      <div class=row>
                        <div class="form-group col-lg  py-2">
                          <label for="pwd" class ="font-weight-bolder">Password:</label>
                          <input type="password" class="mx-auto form-control w-100 " onblur='validation_Cpassword("register_admin",1)' placeholder="Enter password" id="bpwd" name="password" required>
                          <span id="bpass_location"class= " pass_location btn bg-danger fa fa-warning py text-white my-2 font-weight-bolder" style="display :none;"></span>
                        </div>
              
                        <div class="form-group col-lg py-2">
                          <label for="pwd" class ="font-weight-bolder">re-Password:</label>
                          <input type="password" class="mx-auto form-control w-100 "  onblur='validation_Cpassword("register_admin",1)' placeholder="re Enter your password" id="brepwd" name="repassword" required>
                          <span id="brepass_location"class=" repass_location btn bg-danger fa fa-warning py text-white my-2 font-weight-bolder" style="display :none;"></span>
                        </div>
                    </div>
                   
                  </div>
              
                  
              
                   
                    <div class="form-group  py-2">
                      <label for="email" class ="font-weight-bolder">Email:</label>
                      <input type="email" class=" mx-auto form-control w-100 " onblur='validation_Cemail("register_admin",1)'  placeholder="Enter email" id="bemail" name="email" required>
                      <span id="bemail_location"class="email_location btn bg-danger fa fa-warning py text-white my-2 font-weight-bolder" style="display :none;"></span>
                  </div>
              
                    <div class="form-group py-2">
                      <label for="tel" class ="font-weight-bolder">Phonenumber:</label>
                      <input type="tel" class="mx-auto form-control w-100 "  onblur='validation_Cphone ("register_admin",1)' placeholder="Enter phonenumber" id="bphonenumber" name="phonenumber" required>
                      <span id="bphone_location"class=" phone_location btn bg-danger fa fa-warning py text-white my-2 font-weight-bolder" style="display :none;"></span>
                  </div>
              
                    <div class="form-group py-0">
                        <label for="address" class ="font-weight-bolder">Address:</label>
                        <div class=row>
                          <div class="form-group col-lg  py-2">
                              <label for="city" class="font-weight-bolder">City:</label>
                              <input type="text" class="form-control w-100" placeholder="Enter your city" id="bcity" name="city" required>
                          </div>
              
                          <div class="form-group col-lg py-2">
                              <label for="wereda" class="font-weight-bolder">Wereda:</label>
                              <input type="text" class="form-control w-100 " placeholder="Enter your wereda" id="bwereda" name="wereda" required>
                          </div>
                      </div>
                    </div>

                    <div class="row p-3">
                        <p> <label class="font-weight-bolder">Account Type:</label></p>
                        <select name="account_type" class="custom-select w-100">
                          <option selected style=" display:none;"> select type</option>
                          <option value="super">super</option>
                          <option value="Regular">Regular</option>
                        </select>
                        
                       </div>
                    <div class=" container d-flex flex-row-reverse ">
                      <input type ="submit" name="signup_admin" value=" signup " style="width: 100px;"  class=" signups mx-4 btn btn-success  my-4">
                      <input type ="reset" value ="reset" style="width: 100px;" width="100px"name= "rest" class="mx-4 btn btn-danger  my-4">
                        
                      </div>
                  </form>


                  </div>



                <!-- ############################################################## end of register admin section###############################################-->
                 




                  <!--##################################################### manage post section ############################################################-->
                
                   
                  <div class="container-fluid " id="post_display">
                      <div class="row p-5 ">
                        <h5 class="display-4 w-100 font-weight-bold"> manage posts <span class="mx-2 mb-3 far fa-edit"> </span> </h5>
                        <div class="col-lg-12  w-100">
                            <form class="form-inline" action="">
                              <div class="input-group w-100  ">
                                <input class="form-control border border-primary "  type="search" id="post_search-bar"  placeholder="Search">
                                <div class="input-group-append rounded">
                                  <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                                </div>
            
                              </div>
                                </form>
                                <script>
                                    $(document).ready(function(){
                                      $("#post_search-bar").on("keyup", function() {
                                        var value = $(this).val().toLowerCase();
                                        $("#post_table tr").filter(function() {
                                          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                                        });
                                      });
                                    });
                                    </script> 
                              
                          </div>

                      </div>
                    <div class="row">
                        <div class="col-lg "id="post_table_display">
                            
                                




                  </div>

                  </div>
                  </div>

                  <!--################################# end of manage post section    #####################################################################-->
             
             
             
             
            <!--#################################   start of Deprate form    #####################################################################-->
             
             

             
            <div class="container-fluid text-dark" id="deprate_display" style="display: none;" >

                <div class="row">

                  
                    <h5 class="display-4 w-100 font-weight-bold"> Depreciation Rate <span class="m-4 mb-3 fas fa-chart-line"> </span> </h5>
                    
                    <div class=" container d-flex">
                        <button  name="new Dep Rate" data-toggle="collapse" data-target="#dep_rate_form" value=" new Dep rate"  class=" signups mx-4 btn btn-primary my-4">new Dep rate  <span class="mx-2 far fa-plus-square"> </span>  </button>
                        <button  name="view" value=" view "data-toggle="collapse" data-target="#dep_rate_tables"  class=" signups mx-4 btn btn-info  my-4">view </button>
                          
                        </div>
                    <div class="col-lg collapse show" id="dep_rate_form" data-parent="#deprate_display">
                        
                        <form action="php/dep_rate_manage.php" method="POST" enctype="multipart/form-data" >
                            <div class="form-group py-0">
                                <div class=row>
                                  <div class="form-group col-lg  py-">
                                      <label for="Asset" class="font-weight-bolder mt-2">Asset Name:</label>
                                      <input type="text" class="form-control w-100 mt-3"  placeholder=" example car" id="" name="Asset_name" required>
                                  </div>
                      

                                  <div class="form-group col-lg  py-2">
                                    <p> <label class="font-weight-bolder">Asset Type:</label></p>
                                    <select name="Asset_type" class="custom-select w-100">
                                      <option selected style=" display:none;"> select type</option>
                                      <option value="fixed asset">fixed asset</option>
                                      <option value="Tangible asset">Tangible asset</option>
                                      <option value="operating asset">operating asset</option>
                                      <option value="non operating asset">non operating asset</option>
                                    </select>
                                </div>
                                  
                              </div>
                            </div>

                            <div class="form-group py-2">
                                <label for="tel" class ="font-weight-bolder">Depreciation Rate:</label>
                                <input type="tel" class="mx-auto form-control w-100 "  onblur='validation_Cphone ("register_admin",2)' placeholder="Enter depreciation rate"  name="dep_rate" required>
                                <span id="bphone_location"class=" phone_location btn bg-danger fa fa-warning py text-white my-2 font-weight-bolder" style="display :none;"></span>
                            </div>


                            <div class="form-group">
                                <label for="Discription " class="font-weight-bolder">Rate Discription:</label>
                                <textarea class="form-control" rows="6" name="Dep_discription" id="comment" required></textarea>
                            </div>

                            <div class=" container d-flex flex-row-reverse ">
                                <input type ="submit" name="upload_rate" value=" Register " style="width: 100px;"  class=" signups mx-4 btn btn-success  my-4">
                                <input type ="reset" value ="reset" style="width: 100px;" width="100px"name= "rest" class="mx-4 btn btn-danger  my-4">
                                  
                                </div>

                        </form>
                    </div>

                    <div class="contaner-fluid collapse" id="dep_rate_tables" data-parent="#deprate_display">

                        <div class="row p-5 ">
                            <div class="col-lg-12  w-100">
                                <form class="form-inline" action="">
                                  <div class="input-group w-100  ">
                                    <input class="form-control border border-primary "  type="search" id="dep_search-bar"  placeholder="Search">
                                    <div class="input-group-append rounded">
                                      <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                                    </div>
                
                                  </div>
                                    </form>
                                    <script>
                                        $(document).ready(function(){
                                          $("#dep_search-bar").on("keyup", function() {
                                            var value = $(this).val().toLowerCase();
                                            $("#dep_table tr").filter(function() {
                                              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                                            });
                                          });
                                        });
                                        </script> 
                                  
                              </div>
    
                          </div>

                          <div class="row">

                            <div class="col-lg" id="dep_rate_table">



                            </div>
                          </div>

                        <!-- here the list of all dep rate will be put-->


                    </div>







                </div>




            </div>
              
              
              
               <!--################################# end of Deprate form   #####################################################################-->
             



                 <!--#################################   start of license request  #####################################################################-->
             
             

             
            <div class="container-fluid text-dark" id="license_request_display" style="display: none;" >
              <div class="row p-5 ">
                <h5 class="display-4 w-100 font-weight-bold">License request approval <span class="mx-2 mb-3 far fa-edit"> </span> </h5>
                <div class="col-lg-12  w-100">
                    <form class="form-inline" action="">
                      <div class="input-group w-100  ">
                        <input class="form-control border border-primary "  type="search" id="license_search-bar"  placeholder="Search">
                        <div class="input-group-append rounded">
                          <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                        </div>
    
                      </div>
                        </form>
                        <script>
                            $(document).ready(function(){
                              $("#license_search-bar").on("keyup", function() {
                                var value = $(this).val().toLowerCase();
                                $("#license_table tr").filter(function() {
                                  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                                });
                              });
                            });
                            </script> 
                      
                  </div>

              </div>     
              <div class="row">
                <div class="col-lg "id="license_request_display-table">
                    
                        




          </div>

          </div>          





            </div>



              <!--################################# end of license request   #####################################################################-->

             
              
              
                 <!--#################################   start of manage Accounts request  #####################################################################-->
             
             

             
            <div class="container-fluid text-dark" id="Accounts_display" style="display: none;" >
              <div class="row p-5 ">
                <h5 class="display-4 w-100 font-weight-bold">Accounts <span class="mx-2 mb-3 far fa-edit"> </span> </h5>

                <div class="col-lg-12 p-3">
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" onclick="account_display('Admin')" id="customRadio" name="Account_type_radio" value="Admin">
                    <label class="custom-control-label" for="customRadio">Admin</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="customRadio2" onclick="account_display('Client')" name="Account_type_radio" value="Client">
                    <label class="custom-control-label" for="customRadio2">Clients</label>
                  </div>

                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="customRadio3" onclick="account_display('Broker')" name="Account_type_radio" value="Broker">
                    <label class="custom-control-label" for="customRadio3">Broker</label>
                  </div>

                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="customRadio4" onclick="account_display('AVC')" name="Account_type_radio" value="AVC">
                    <label class="custom-control-label" for="customRadio4">AVC</label>
                  </div>

                </div>
                <div class="col-lg-12  w-100">
                    <form class="form-inline" action="">
                      <div class="input-group w-100  ">
                        <input class="form-control border border-primary "  type="search" id="Accounts_search-bar"  placeholder="Search">
                        <div class="input-group-append rounded">
                          <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                        </div>
    
                      </div>
                        </form>
                        <script>
                            $(document).ready(function(){
                              $("#Accounts_search-bar").on("keyup", function() {
                                var value = $(this).val().toLowerCase();
                                $("#license_table tr").filter(function() {
                                  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                                });
                              });
                            });
                            </script> 
                      
                  </div>

              </div>     
              <div class="row">
                <div class="col-lg "id="Account_display-table">
                    
                        




          </div>

          </div>          





            </div>



             <!--################################# end of manage Accounts request   #####################################################################-->

             <!-- for viewing individual license request -->
             <div class="container-fluid text-dark " id="license_view_content" style="display:none;">
              
                  
                  
                  
  
              </div>
        
  
            </div>


             <!--end of view-->
              
                </div>

                <!--end of middle section-->

              </div>
             
          
 <!--##################################### end of home content ##################################################################################################### -->
                







 



 











  
 
  <div class=" px-3 text-light mt-3 " style="bottom:0;">
   
 
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