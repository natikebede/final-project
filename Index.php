<!DOCTYPE html>
<html lang="en"></html>
    <head>
        <title>AVS.com</title>
        <meta charset="utf-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/landingcss.css">
       
        <link rel="stylesheet" href="fonts/css/all.css">

        
        <!-- link to the bootstrap ,ajax,...-->
      
        <script src="js/jquery.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/registration_validation.js"> </script>
        <style>

  .account_button:hover
  {
    transform: translateX(5px);
    transition:ease-out;
    transition-delay:0.15s;
    
    
  }
  .bg-trans
  {
    background:transparent;
  }
  .hero {
    width: 100%;
    height: 100vh;
    background: url(back_images/hero-bg.png) top center no-repeat;
    background-size: cover;
    margin-top:20px;
    z-index:1;
  }
 

        </style>
       
    </head>
    <body>
 <!-- ======= Header ======= -->
 <header id="header" class="header fixed-top">
    

        <nav class="navbar navbar-expand-lg bg-white fixed-top mb-5" id="nav-top">
            <a class="navbar-brand" href="#"><img src="back_images/logo_transparent.png" class="" alt="Logo" style="width:50px;"> 
                 <span class="textcolor   font-weight-bolder">AVS</span></a>
              <button class="navbar-toggler  " type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="	fa fa-bars" ></span>
              </button>
            
              <div class="collapse navbar-collapse bg-light rounded justify-content-end" id="navbarTogglerDemo02">
                <ul class="navbar-nav  ">
                  <li class="nav-item"> 
                   <a class="nav-link buttons rounded font-weight-bolder mx-4 " href="#about">About</a>

                  </li>
                 
                  <li class="nav-item">
                    <a class="nav-link  buttons rounded font-weight-bolder mx-4 " href="#services">Services</a>

                  </li>
                  <li class="nav-item">
                    <button type="button" class="btn loginbutton mx-3 font-weight-bolder " data-toggle="modal" data-target="#login">Login</button>
                  </li>
                 
                </ul>
          
                
              </div>
           </nav>
     
  
  </header><!-- End Header -->


<!--Login display-->
    <div class ="modal login_page fade rounded mt-5  " id="login">
        <div class="modal-dialog   modal-lg modal-dialog-centered">
          <div class="modal-content">
            
            <div class="modal-body rounded bg-light">
              <div class=" container  mxy-2 fade show   p-4 mb-4 bg-light rounded">
                <button type="button bg-dark" class="close" data-dismiss="modal">&times;</button>
                <h3 class=" display-3 font-weight-bolder  primary text-center w-100 logo "style="color:#012970;"> AVS </h3>
                <form name="login"  class =" py-3 " method ="POST" action="php/to_login.php" enctype="multipart/form-data" >
                  <div class="input-group mx-auto  my-5">
                    <div class="input-group-prepend">
                      <span class=" input-group-text textcolor	fa fa-user" style="font-size:20px;"></span>
                    </div>
                    <input type="username" class=" mx-auto form-control " placeholder="Enter Username" id="username" name="username" required>
                  </div>

                  <div class="input-group mx-auto  mb-5">
                    <div class="input-group-prepend">
                      <span class=" input-group-text textcolor fa fa-key" style="font-size:20px;"></span>
                    </div>
                    <input type="password" class=" mx-auto form-control " placeholder="Enter password" id="pwd" name="password" required>
                  </div>
                
                <div class="custom-control">
                 <a class=" font-weight-bolder" data-target="#forgot_password" data-toggle="modal">forgot password ?</a>
                  
                </div>

                <div class ="row">
                    <input type ="reset" value ="reset" style="width: 100px;" width="100px"name= "rest" class="mx-auto btn btn-primary mx-0 my-4">
                    <input type ="submit" name="text" value=" Login " style="width: 100px;"  class="mx-auto btn btn-success mx-0 my-4">
                </div>
              </form>
            </div>

            </div>
              </div>

          
          
        </div>
       

    </div>
<!--end of login display-->
 <!-- The Modal -->
 <div class="modal fade rounded" id="myModal">
  <div class="modal-dialog rounded modal-lg">
    <div class="modal-content rounded">
    
      <!-- Modal Header -->
      
      
      <!-- Modal body -->
      <div class="modal-body rounded bg-white p-0">
      
<!--Register display-->
<div class ="container-fluid  bg-white p-4  " id="get_started">
  <div class="bg-white ">
    <button type="button bg-dark" class="close" data-dismiss="modal">&times;</button>
    <h5 class="  font-weight-bolder  primary text-center w-100  logo "style="color:#012970;"> create a AVS </h3>
      <h5 class="  font-weight-bolder  primary text-center w-100 logo "style="color:#012970;"> Types of account </h3>
     
<!-- account selection  for  type-->
 
  <div class="conatiner px-0 py-3 " id="selection">
    <div class="row count px-5">

      <div class="col-lg account_button btn btn-outline-success  rounded  shadow-lg p-0 mb-4 mx-4">
        <button type="button" data-toggle="collapse" data-target="#client_register" class="font-weight-bolder p-3 h-100 w-100 btn btn-outline-success">Happy clients</button>
      </div>
      <div class="col-lg account_button btn btn-outline-info rounded  shadow-lg  p-0 mb-4 mx-4">
       <button type="button"  data-toggle="collapse" data-target="#broker_register" class="font-weight-bolder h-100 w-100 btn btn-outline-info p-3">Brokers</button>
      </div>

      <div class="col-lg account_button btn btn-outline-warning rounded  shadow-lg  p-0 mb-4 mx-4">
        <button type="button"  data-toggle="collapse" data-target="#company_register" class="font-weight-bolder h-100 w-100 btn btn btn-outline-warning p-3">Asset valuating comapnies</button>
       </div>
    </div>
  


<!-- for client regstration-->

    <div class="container-fluid-lg collapse rounded my-2 mx-0 show py-5 px-3 bg-success text-light" data-parent ="#selection" id="client_register">
      <button type="button" class="close text-light my-3" data-toggle="collapse" data-target="#client_register">&times;</button>
      <form name="register_client"  class =" py-3 " method ="POST" action="php/register.php" enctype="multipart/form-data">
          <h4 class=" display-4 text-start mt-3">Register here for your new client account </h4>
          <div class="form-group py-0">
          <div class=row>
            <div class="form-group col-lg  py-2">
                <label for="fullname" class="font-weight-bolder">Firstname:</label>
                <input type="text" class="form-control w-100" onkeyup='fname_validation("register_client")' placeholder="Enter firstname" id="cfirstname" name="firstname" required>
            </div>

            <div class="form-group col-lg py-2">
                <label for="fullname" class="font-weight-bolder">Last name:</label>
                <input type="text" class="form-control w-100 " onkeyup='lname_validation("register_client")' placeholder="Enter lastname" id="clastname" name="lastname" required>
            </div>
        </div>
      </div>

      <div class="form-group  py-2">
          <label for="username" class ="font-weight-bolder">Username:</label>
          <input type="username" class="mx-auto form-control w-100 " onblur='validation_username("register_client",0)' placeholder="Enter Username" id="cusername" name="username" required>
          <span id="pass_location"class= " username_location btn bg-danger fa fa-warning py text-white my-2 font-weight-bolder" style="display :none;"></span>
        </div>

      <div class="form-group py-0">
        <div class=row>
          <div class="form-group col-lg  py-2">
            <label for="pwd" class ="font-weight-bolder">Password:</label>
            <input type="password" class="mx-auto form-control w-100 " onblur='validation_Cpassword("register_client",0)' placeholder="Enter password" id="cpwd" name="password" required>
            <span id="pass_location"class= " pass_location btn bg-danger fa fa-warning py text-white my-2 font-weight-bolder" style="display :none;"></span>
          </div>

          <div class="form-group col-lg py-2">
            <label for="pwd" class ="font-weight-bolder">re-Password:</label>
            <input type="password" class="mx-auto form-control w-100 "  onblur='validation_Cpassword("register_client",0)' placeholder="re Enter your password" id="crepwd" name="repassword" required>
            <span id="repass_location"class=" repass_location btn bg-danger fa fa-warning py text-white my-2 font-weight-bolder" style="display :none;"></span>
          </div>
      </div>
     
    </div>

    

      <div class="form-group  py-2">
          <label for="email" class ="font-weight-bolder">Email:</label>
          <input type="email" class=" mx-auto form-control w-100 " onblur='validation_Cemail("register_client",0)'  placeholder="Enter email" id="cemail" name="email" required>
          <span id="email_location"class="email_location btn bg-danger fa fa-warning py text-white my-2 font-weight-bolder" style="display :none;"></span>
      </div>

      <div class="form-group py-2">
          <label for="tel" class ="font-weight-bolder">Phonenumber:</label>
          <input type="tel" class="mx-auto form-control w-100 "  onblur='validation_Cphone ("register_client",0)' placeholder="Enter phonenumber" id="phonenumber" name="phonenumber" required>
          <span id="phone_location"class=" phone_location btn bg-danger fa fa-warning py text-white my-2 font-weight-bolder" style="display :none;"></span>
      </div>

      <div class="form-group py-0">
          <label for="address" class ="font-weight-bolder">Address:</label>
          <div class=row>
            <div class="form-group col-lg  py-2">
                <label for="city" class="font-weight-bolder">City:</label>
                <input type="text" class="form-control w-100" placeholder="Enter your city" id="ccity" name="city" required>
            </div>

            <div class="form-group col-lg py-2">
                <label for="wereda" class="font-weight-bolder">Wereda:</label>
                <input type="text" class="form-control w-100 " placeholder="Enter your wereda" id="cwereda" name="wereda" required>
            </div>
        </div>
      </div>
      <div class=" container d-flex flex-row-reverse ">
        <input type ="submit"  name="signup_client" value=" signup " style="width: 100px;"  class=" signups mx-4 btn btn-primary  my-4">
        <input type ="reset" value ="reset" style="width: 100px;" width="100px"name= "rest" class="mx-4  btn btn-danger  my-4">
          
        </div>
    </form>

    </div>
    <!-- end of client registration -->


    <!--broker regstration -->

   
    <div class="container-fluid-lg collapse rounded my-2 mx-0  py-5 px-3 bg-info text-light" data-parent ="#selection" id="broker_register">
      <button type="button" class="close text-light my-3" data-toggle="collapse" data-target="#broker_register">&times;</button>
      <form name="register_broker"  class =" py-3 " method ="POST" action="php/register.php" enctype="multipart/form-data">
          <h4 class=" display-4 text-start mt-3">Register here for your new Broker account </h4>
          <div class="form-group py-0">
          <div class=row>
            <div class="form-group col-lg  py-2">
                <label for="fullname" class="font-weight-bolder">Firstname:</label>
                <input type="text" class="form-control w-100" onkeyup='fname_validation("register_broker")' placeholder="Enter firstname" id="bfirstname" name="firstname" required>
            </div>

            <div class="form-group col-lg py-2">
                <label for="fullname" class="font-weight-bolder">Last name:</label>
                <input type="text" class="form-control w-100 " onkeyup='lname_validation("register_broker")' placeholder="Enter lastname" id="blastname" name="lastname" required>
            </div>
        </div>
      </div>

      <div class="form-group  py-2">
          <label for="username" class ="font-weight-bolder">Username:</label>
          <input type="username" class="mx-auto form-control w-100 " onblur='validation_username("register_broker",1)' placeholder="Enter Username" id="busername" name="username" required>
          <span id="bpass_location"class= " username_location btn bg-danger fa fa-warning py text-white my-2 font-weight-bolder" style="display :none;"></span>
        </div>

      <div class="form-group py-0">
        <div class=row>
          <div class="form-group col-lg  py-2">
            <label for="pwd" class ="font-weight-bolder">Password:</label>
            <input type="password" class="mx-auto form-control w-100 " onblur='validation_Cpassword("register_broker",1)' placeholder="Enter password" id="bpwd" name="password" required>
            <span id="bpass_location"class= " pass_location btn bg-danger fa fa-warning py text-white my-2 font-weight-bolder" style="display :none;"></span>
          </div>

          <div class="form-group col-lg py-2">
            <label for="pwd" class ="font-weight-bolder">re-Password:</label>
            <input type="password" class="mx-auto form-control w-100 "  onblur='validation_Cpassword("register_broker",1)' placeholder="re Enter your password" id="brepwd" name="repassword" required>
            <span id="brepass_location"class=" repass_location btn bg-danger fa fa-warning py text-white my-2 font-weight-bolder" style="display :none;"></span>
          </div>
      </div>
     
    </div>

    

     
      <div class="form-group  py-2">
        <label for="email" class ="font-weight-bolder">Email:</label>
        <input type="email" class=" mx-auto form-control w-100 " onblur='validation_Cemail("register_broker",1)'  placeholder="Enter email" id="bemail" name="email" required>
        <span id="bemail_location"class="email_location btn bg-danger fa fa-warning py text-white my-2 font-weight-bolder" style="display :none;"></span>
    </div>

      <div class="form-group py-2">
        <label for="tel" class ="font-weight-bolder">Phonenumber:</label>
        <input type="tel" class="mx-auto form-control w-100 "  onblur='validation_Cphone ("register_broker",1)' placeholder="Enter phonenumber" id="bphonenumber" name="phonenumber" required>
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
      <div class=" container d-flex flex-row-reverse ">
        <input type ="submit" name="signup_Broker" value=" signup " style="width: 100px;"  class=" signups mx-4 btn btn-success  my-4">
        <input type ="reset" value ="reset" style="width: 100px;" width="100px"name= "rest" class="mx-4 btn btn-danger  my-4">
          
        </div>
    </form>

    </div>


    <!--end of Broker regstration  -->


    
    <!--company  regstration -->

   
    <div class="container-fluid-lg collapse rounded my-2 mx-0  py-5 px-3 bg-warning text-light" data-parent ="#selection" id="company_register">
      <button type="button" class="close text-light my-3" data-toggle="collapse" data-target="#company_register">&times;</button>
      <form name="register_company"  class =" py-3 " method ="POST" action="php/register.php" enctype="multipart/form-data">
          <h4 class=" display-4 text-start mt-3">Register here for your new Asset valuating company account </h4>

          <div class="form-group  py-2">
            <label for="name" class ="font-weight-bolder">Company name:</label>
            <input type="text" class="mx-auto form-control w-100 " onkeyup='fname_validation("register_company")' placeholder="Enter company name" id="cocompanyname" name="name" required>
        </div>

      <div class="form-group  py-2">
          <label for="username" class ="font-weight-bolder">Username:</label>
          <input type="username" class="mx-auto form-control w-100 "  onblur='validation_username("register_company",2)' placeholder="Enter Username" id="cousername" name="username" required>
          <span id="couser_location"class= " username_location btn bg-danger fa fa-warning py text-white my-2 font-weight-bolder" style="display :none;"></span>
        </div>
      
      <div class="form-group py-0">
        <div class=row>
          <div class="form-group col-lg  py-2">
            <label for="pwd" class ="font-weight-bolder">Password:</label>
            <input type="password" class="mx-auto form-control w-100 " onblur='validation_Cpassword("register_company",2)' placeholder="Enter password" id="copwd" name="password" required>
            <span id="copass_location"class= " pass_location btn bg-danger fa fa-warning py text-white my-2 font-weight-bolder" style="display :none;"></span>
          </div>

          <div class="form-group col-lg py-2">
            <label for="pwd" class ="font-weight-bolder">re-Password:</label>
            <input type="password" class="mx-auto form-control w-100 "  onblur='validation_Cpassword("register_company",2)' placeholder="re Enter your password" id="corepwd" name="repassword" required>
            <span id="corepass_location"class=" repass_location btn bg-danger fa fa-warning py text-white my-2 font-weight-bolder" style="display :none;"></span>
          </div>
      </div>
     
    </div>

    

    <div class="form-group  py-2">
      <label for="email" class ="font-weight-bolder">Email:</label>
      <input type="email" class=" mx-auto form-control w-100 " onblur='validation_Cemail("register_company",2)'  placeholder="Enter email" id="coemail" name="email" required>
      <span id="coemail_location"class="email_location btn bg-danger fa fa-warning py text-white my-2 font-weight-bolder" style="display :none;"></span>
  </div>

    <div class="form-group py-2">
      <label for="tel" class ="font-weight-bolder">Phonenumber:</label>
      <input type="tel" class="mx-auto form-control w-100 "  onblur='validation_Cphone ("register_company",2)' placeholder="Enter phonenumber" id="cophonenumber" name="phonenumber" required>
      <span id="cophone_location"class=" phone_location btn bg-danger fa fa-warning py text-white my-2 font-weight-bolder" style="display :none;"></span>
  </div>

      <div class="form-group py-0">
          <label for="address" class ="font-weight-bolder">Address:</label>
          <div class=row>
            <div class="form-group col-lg  py-2">
                <label for="city" class="font-weight-bolder">City:</label>
                <input type="text" class="form-control w-100" placeholder="Enter your city" id="cocity" name="city" required>
            </div>

            <div class="form-group col-lg py-2">
                <label for="wereda" class="font-weight-bolder">Wereda:</label>
                <input type="text" class="form-control w-100 " placeholder="Enter your wereda" id="cowereda" name="wereda" required>
            </div>
        </div>
      </div>
      <div class=" container d-flex flex-row-reverse ">
        <input type ="submit" name="signup_company" value=" signup " style="width: 100px;"  class="signups mx-4 btn btn-success  my-4">
        <input type ="reset" value ="reset" style="width: 100px;" width="100px"name= "rest" class="mx-4 btn btn-danger  my-4">
          
        </div>
    </form>

    </div>


    <!--end of company regstration  -->



  </div>
     
</div>

</div>

      </div>
      
      
     
      
    </div>
  </div>
</div>



<!--end of regstiration-->

<!--forgot password displaymodal-->
<div class ="modal login_page fade rounded mt-5  " id="forgot_password">
  <div class="modal-dialog   modal-xl modal-dialog-centered">
    <div class="modal-content">
      
      <div class="modal-body rounded bg-light">
        <div class=" container  mxy-2 fade show   p-4 mb-4 bg-light rounded">
          <button type="button bg-dark" class="close" data-dismiss="modal">&times;</button>
          <h3 class=" display-3 font-weight-bolder  primary text-center w-100 logo "style="color:#012970;"> forgot password </h3>
          <form name="reset_password"  class =" py-3 " method ="POST" action="php/reset_password.php" enctype="multipart/form-data" >
            <div class="input-group mx-auto  my-5">
              <label for="city" class="font-weight-bolder">Enter the email  you registered with:</label>
              <input type="email" class=" mx-auto form-control w-100 " onblur='validation_Cemail("reset_password",3)'  placeholder="Enter email" id="coemail" name="email" required>
              <span id="coemail_location"class="email_location btn bg-danger fa fa-warning py text-white my-2 font-weight-bolder" style="display :none;"></span>
          
            </div>
            <div class="row p-3">
              <p> <label class="font-weight-bolder">Your Type:</label></p>
              <select name="account_type" class="custom-select w-100">
                <option selected style=" display:none;"> select type</option>
                <option value="Client">Client</option>
                <option value="Broker">Broker</option>
                <option value="AVC">AVC</option>
                <option value="Admin">Admin</option>
                
              </select>
              
             </div>
                    
          <div class ="row">
              <input type ="reset" value ="reset" style="width: 100px;" width="100px"name= "rest" class="mx-auto btn btn-primary mx-0 my-4">
              <input type ="submit" name="submit_email" value=" Send confirmation"   class="singups mx-auto btn btn-success mx-0 my-4">
          </div>
        </form>
      </div>

      </div>
        </div>

    
    
  </div>
 

</div>

<!-- end forgot password displaymodal-->


<!--middel section-->
    <div class ="container-fluid hero align-items-center py-5 ">
        <div class="row px-5  justify-content-center  ">
            <div class="col-lg-6   py-4">
                <h1 class="textcolor display-4" data-aos="fade-up">AVS offer modern solutions for growing your business</h1>
                <h2 class="textcolor" data-aos="fade-up" data-aos-delay="400"> a digital and more  efficents way of  Asset valuation</h2>
                <div data-aos="fade-up" data-aos-delay="600">
                    <div class="text-center text-lg-start">
                      <a href="#nav-top"> <a href="#myModal" data-toggle="modal" class="btn-get-started d-inline-flex align-items-center justify-content-center align-self-center">
                       <span>Get started </span></a> 
                        <i class="bi bi-arrow-right"></i>
                    </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 hero-img " data-aos="zoom-out" data-aos-delay="200">
                <img src="back_images/hero-img.png" class="img-fluid" alt="">

            </div>

        </div>

    </div>

    <div class="container-fluid my-3 p-5">
      <div class="row my-4">
        <div class="col-lg-12">
          <h6 class=" display-4 textcolor w-100 text-center font-weight-bolder "id="services">services AVS will provide to you  </h6>
        </div>
       
      </div>
      <div class="row p-3 mx-3 my-2">
        
        <div class=" card-deck mx-auto p-3">
          <div class="card bg-white shadow-lg " style="width:400px">
            <a class="card-img-top mx-auto w-100 p-4"><span class="  text-center w-100 fas fa-sticky-note"style="font-size:45px"></span> </a>
            <div class="card-body">
              <h4 class="card-title display-4 text-center textcolor font-weight-bolder"> Post Assets</h4>
              <p class="card-text p-2 font-weight-bolder textcolor">
                user with client accounts can upload their information about their assets to 
                be viewed and valuated by Brokers and Asset valuating compnays.
              </p>
             
            </div>
          </div>


         
          <div class="card bg-white shadow-lg" style="width:400px">
            <a class="card-img-top mx-auto w-100 p-4"><span class="  text-center w-100 fas fa-chalkboard-teacher"style="font-size:45px"></span> </a>
            <div class="card-body">
              <h4 class="card-title display-4 text-center textcolor font-weight-bolder"> Make Valuations</h4>
              <p class="card-text p-2 font-weight-bolder textcolor">
              Using AVS Brokers can register to view  and make valuations of assets posted by clients this also
              could includes Asset valuating companies 
              </p>
             
            </div>
          </div>


      
          <div class="card bg-white shadow-lg " style="width:400px">
            <a class="card-img-top mx-auto w-100 p-4"><span class="  text-center w-100 fab fa-rocketchat"style="font-size:45px"></span> </a>
            <div class="card-body">
              <h4 class="card-title display-4 text-center textcolor font-weight-bolder"> Message</h4>
              <p class="card-text font-weight-bolder textcolor">
               users can communicate with each other through messages 
              </p>
             
            </div>
          </div>


        </div>
      </div>

    </div>


    <div class="container-fluid my-3 p-5">
      <div class="row my-4">
       
       
      </div>

      <div class="row mx-4 p-5">
        <div class="col-lg-12 shadow-lg">
          <h6 class=" display-4 textcolor w-100 text-center font-weight-bolder "id="about">About us </h6>
          <p class="textcolor">

          </p>
        </div>
       
      </div>
    

    </div>

</body>
</html>