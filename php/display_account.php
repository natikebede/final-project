<?php
include "connection.php";
if(isset($_POST['active']))
{
    
        
        $sql2="SELECT * FROM  avc WHERE License_status='Approved' ";
        $result2=$conn->query($sql2);
        if($result2->num_rows==1)
        {
            
            
                while($row=$result2->fetch_assoc())
                {
                    echo'<div class="container-fluid bg-light rounded p-0 my-2 w-100">
                    <div class="row py-2 my-2 px-3 w-100  ">
                    <img class="rounded-circle float-left mx-2 mb-2"  src="'.$row['Profile_pic'].'" style="height:60px;width:60px" alt="profile pic">
                    <h5 class="mx-2 py-3 text-secondary mb-2">'.$row['name'].' </h5><br>';
                    if($row['Account_status']=='active')
                    {
                     echo' <h5 class="mx-2 py-3 text-secondary mb-2  ">
                     <span class=" text-success border border-success px- bg-success rounded-circle" style="font-size:10px;">hh</span></h5>';
                    }
                    else
                    {
                      echo' <h5 class="mx-2 py-3 text-secondary mb-2  ">
                     <span class=" text-secondary border border-secondary px- bg-secondary rounded-circle" style="font-size:10px;">hh</span> </h5>';
                    }

                    if($row['License_status']=='Approved')
                    {
                     echo' <h5 class="mx-2 py-3 text-secondary mb-2  ">
                     <span class="text-primary mx-1  fas fa-user-check"></span> </h5>';
                    }
                   

                    echo'
                  </div>
                  <div class="row w-100">
                     <div class="col-lg p-2">
                      <button class="btn btn-info ml-2"   onclick="view_profile('.$row['AVC_ID'].',\'AVC\')">
                        view profile
                        </button>
                       <button class="btn btn-primary mx-0" onclick="view_message('.$row['AVC_ID'].',\'AVC\')" >
                        Messages
                       </button>
                       
  
                     </div>
                  </div> </div>';

                }

            

        }
        else
        {
           /* echo' <div id= "toadd" class="w3-modal" >
            <div class="w3-modal-content w3-animate-zoom">
              <div class="container" id="success" >
                  <div class="alert alert-danger alert-dismissible fade show">
                      <strong>!</strong> error occurred retriving  !!
                      <P>
                      <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                  </div>
              </div>
            </div>
          </div>
         
          ';*/

        }

        
        $sql2="SELECT * FROM broker  where account_veryfiy='approved'";
        $result2=$conn->query($sql2);
        if($result2->num_rows==1)
        {
           
                while($row=$result2->fetch_assoc())
                {
                    echo' <hr class="text-primary mt-5">
                    
                        <div class="container-fluid bg-light rounded p-0 my-2 w-100">
                        <div class="row py-2 my-2 px-3 w-100  ">
                        <img class="rounded-circle float-left mx-2 mb-2"  src="'.$row['Profile_pic'].'" style="height:60px;width:60px" alt="profile pic">
                        <h5 class="mx-2 py-3 text-secondary mb-2">'.$row['First_name'].' '.$row['Last_name'].'</h5><br>';
                        if($row['Account_status']=='active')
                        {
                        echo' <h5 class="mx-2 py-3 text-secondary mb-2  ">
                        <span class=" text-success border border-success bg-success rounded-circle" style="font-size:10px;">hh</span> </h5>';
                        }
                        else
                        {
                        echo' <h5 class="mx-2 py-3 text-secondary mb-2  ">
                        <span class=" text-secondary border border-secondary px- bg-secondary rounded-circle" style="font-size:10px;">hh</span> </h5>';
                        }
                        if($row['account_veryfiy']=='approved')
                        {
                                echo' <h5 class="mx-2 py-3 text-secondary mb-2  ">
                                <span class="text-primary mx-1  fas fa-user-check"></span> </h5>';
                    }
                    
                        echo'</div>
                    <div class="row w-100">
                    <div class="col-lg p-2">
                        <button class="btn btn-info mx-1"  onclick="view_profile('.$row['Broker_ID'].',\'Broker\')">
                            view profile
                            </button>
                        <button class="btn btn-primary mx-1" onclick="view_message('.$row['Broker_ID'].',\'Broker\')" >
                            Messages
                        </button>
                        

                        </div>
                    </div> </div>';

                }

            

        }
        else
        {
            echo' <div id= "toadd" class="w3-modal" >
            <div class="w3-modal-content w3-animate-zoom">
              <div class="container" id="success" >
                  <div class="alert alert-danger alert-dismissible fade show">
                      <strong>!</strong> error occurred retriving  !!
                      <P>
                      <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                  </div>
              </div>
            </div>
          </div>';

        }

    

}



?>