<?php
include "connection.php";
if(isset($_POST['query']) &&isset($_POST['type']))
{
  $type=$_POST['type'];
  $search=$_POST['query'];
  $search= $search.'%';
  $Sql=null;
  if($type=="Broker")
  {
    $sql="SELECT `account`.`Account_ID`, `account`.`Role`, `avc`.`AVC_ID`,  `client`.`Client_ID` 
    FROM `account` LEFT JOIN `avc` ON `account`.`AVC_ID` = `avc`.`AVC_ID`  
    LEFT JOIN `client` ON `account`.`Client_ID` = `client`.`Client_ID`
     WHERE `client`.`First_name` LIKE '$search' OR `client`.`Last_name` LIKE '$search' OR `avc`.`name` LIKE '$search'  ";
  }
  elseif($type=="AVC")
  {
    $sql="SELECT `account`.`Account_ID`, `account`.`Role`, `broker`.`Broker_ID`, `client`.`Client_ID` 
    FROM `account`  LEFT JOIN `broker` ON `account`.`Broker_ID` = `broker`.`Broker_ID` 
    LEFT JOIN `client` ON `account`.`Client_ID` = `client`.`Client_ID`
     WHERE `client`.`First_name` LIKE '$search' OR `client`.`Last_name` LIKE '$search' OR 
     `broker`.`First_name` LIKE '$search' OR `broker`.`Last_name` LIKE '$search'  ";
  }
  elseif($type=="Client")
  {
    $sql="SELECT `account`.`Account_ID`, `account`.`Role`, `avc`.`AVC_ID`, `broker`.`Broker_ID`
    FROM `account` LEFT JOIN `avc` ON `account`.`AVC_ID` = `avc`.`AVC_ID` LEFT JOIN `broker` ON `account`.`Broker_ID` = `broker`.`Broker_ID` 
     WHERE  
     `broker`.`First_name` LIKE '$search' OR `broker`.`Last_name` LIKE '$search' OR `avc`.`name` LIKE '$search'  ";

  }
  
    
   
    $result=$conn->query($sql);
   if( $result!=false && $result->num_rows>0)
    { while($row=$result->fetch_assoc())
        {
            $role=$row['Role'];
            if($row['Role']=='Client')
            {
                
                $client_ID=$row['Client_ID'];
                $sql2="SELECT * FROM client WHERE Client_ID='$client_ID'";
                $result2=$conn->query($sql2);
                if($result2->num_rows==1)
                {
                    while($row=$result2->fetch_assoc())
                    {
                        
                        echo'<div class="container-fluid px-2 my-2 w-100">
                        <div class="row py-2 my-2 px-3 w-100  ">
                        <img class="rounded-circle float-left mx-2 mb-2"  src="'.$row['profile_pic'].'" style="height:60px;width:60px" alt="profile pic">
                        <h5 class="mx-2 py-3 text-secondary mb-2">'.$row['First_name'].' '.$row['Last_name'].'</h5><br>
                        ';
                        if($row['Account_status']=='active')
                        {
                         echo' <h5 class="mx-2 py-3 text-secondary mb-2  ">
                         <span class=" text-success border border-success px- bg-success rounded-circle" style="font-size:10px;">hh</span> online</h5>';
                        }
                        else
                        {
                          echo' <h5 class="mx-2 py-3 text-secondary mb-2  ">
                         <span class=" text-secondary border border-secondary px- bg-secondary rounded-circle" style="font-size:10px;">hh</span> offline</h5>';
                        }
                        echo'
                      </div>
                      <div class="row w-100">
                         <div class="col-sm">
                          <button class="btn btn-info mx-1"  onclick="view_profile('.$row['Client_ID'].',\'Client\')">
                            view profile
                            </button>
                           <button class="btn btn-primary mx-1" onclick="view_message('.$row['Client_ID'].',\'Client\')" >
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
                  </div> ';

                }



            }
            elseif($row['Role']=='Broker')
            {
                $Broker_ID=$row['Broker_ID'];
                $sql2="SELECT * FROM  broker  WHERE Broker_ID='$Broker_ID'";
                $result2=$conn->query($sql2);
                if($result2->num_rows==1)
                {
                   
                        while($row=$result2->fetch_assoc())
                        {
                            echo'<div class="container-fluid px-2 my-2 w-100">
                        <div class="row py-2 my-2 px-3 w-100  ">
                        <img class="rounded-circle float-left mx-2 mb-2"  src="'.$row['Profile_pic'].'" style="height:60px;width:60px" alt="profile pic">
                        <h5 class="mx-2 py-3 text-secondary mb-2">'.$row['First_name'].' '.$row['Last_name'].'</h5><br>';
                        if($row['Account_status']=='active')
                        {
                         echo' <h5 class="mx-2 py-3 text-secondary mb-2  ">
                         <span class=" text-success border border-success px- bg-success rounded-circle" style="font-size:10px;">hh</span> online</h5>';
                        }
                        else
                        {
                          echo' <h5 class="mx-2 py-3 text-secondary mb-2  ">
                         <span class=" text-secondary border border-secondary px- bg-secondary rounded-circle" style="font-size:10px;">hh</span> offline</h5>';
                        }
                        if($row['account_veryfiy']=='approved')
                        {
                         echo' <h5 class="mx-2 py-3 text-secondary mb-2  ">
                         <span class="text-primary mx-1  fas fa-user-check"></span> </h5>';
                        }
                      
                        echo'</div>
                      <div class="row w-100">
                         <div class="col-sm">
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
            elseif($row['Role']=='AVC')
            {
                $AVC_ID=$row['AVC_ID'];
                $sql2="SELECT * FROM  avc  WHERE AVC_ID='$AVC_ID'";
                $result2=$conn->query($sql2);
                if($result2->num_rows==1)
                {
                    
                    
                        while($row=$result2->fetch_assoc())
                        {
                            echo'<div class="container-fluid px-2 my-2 w-100">
                            <div class="row py-2 my-2 px-3 w-100  ">
                            <img class="rounded-circle float-left mx-2 mb-2"  src="'.$row['Profile_pic'].'" style="height:60px;width:60px" alt="profile pic">
                            <h5 class="mx-2 py-3 text-secondary mb-2">'.$row['name'].' </h5><br>';
                            if($row['Account_status']=='active')
                            {
                             echo' <h5 class="mx-2 py-3 text-secondary mb-2  ">
                             <span class=" text-success border border-success px- bg-success rounded-circle" style="font-size:10px;">hh</span> online</h5>';
                            }
                            else
                            {
                              echo' <h5 class="mx-2 py-3 text-secondary mb-2  ">
                             <span class=" text-secondary border border-secondary px- bg-secondary rounded-circle" style="font-size:10px;">hh</span> offline</h5>';
                            }

                            if($row['License_status']=='Approved')
                            {
                             echo' <h5 class="mx-2 py-3 text-secondary mb-2  ">
                             <span class="text-primary mx-1  fas fa-user-check"></span> </h5>';
                            }
                           

                            echo'
                          </div>
                          <div class="row w-100">
                             <div class="col-sm">
                              <button class="btn btn-info mx-1"   onclick="view_profile('.$row['AVC_ID'].',\'AVC\')">
                                view profile
                                </button>
                               <button class="btn btn-primary mx-1" onclick="view_message('.$row['AVC_ID'].',\'AVC\')" >
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
        }

    }
    elseif($result!=false && $result->num_rows==0)
    {
        echo' 
        <div class="container-fluid" id="success" >
            <div class="alert w-100 alert-info alert-dismissible fade show">
                <strong>!</strong> no results found!!
                <P>
                
            </div>
       
            </div>';
    
    }
    else
{
    echo' 
          <div class="container-fluid" id="success" >
              <div class="alert w-100 alert-info alert-dismissible fade show">
                  <strong>!</strong> '.$conn->error.'!!
                  <P>
                  
              </div>
         
      </div>';

}

}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// to display profile on the page
elseif(isset($_POST['pID'])&&isset($_POST['acctype']))
{
    $id=$_POST['pID'];
    $type=$_POST['acctype'];
    if($type=="Client")
    {$sql="SELECT * FROM client WHERE Client_ID='$id'";
        $result=$conn->query($sql);
        if($result->num_rows==1)
        {
            while( $row=$result->fetch_assoc() )
            {
                echo'

                <div class="card w-100  border-0 bg-dark" style="">
              <img class="card-img-top img-fluid rounded-circle mx-auto p-3" style="width:400px; height:450px" src="'.$row['profile_pic'].'"  alt="Card image">
              <div class="card-body p-0 ">
                <h4 class="card-title w-100 text-center text-light font-weight-bold">'.$row['First_name'].' '.$row['Last_name'].'</h4>
                <div class="list-group w-100 font-weight-bold text-dark  border-0 ">
                  <a href="#" class="list-group-item  text-decoration-none text-dark  "><i class="fas fa-envelope-square mx-2"></i>'.$row['email'].'</a>
                  <a href="#" class="list-group-item  text-decoration-none text-dark "><i class="fas fa-home mx-2"></i> '.$row['city'].' '.$row['wereda'].'</a>
                  ';
                  $sql1="SELECT * FROM  client_phonenumber where Client_ID='$id'";
                    $result1=$conn->query($sql1);
                    if($result->num_rows >0)
                    {
                      
                        while( $row=$result1->fetch_assoc() )  
                        {  
                            echo'<a href="#" class="list-group-item  text-decoration-none text-dark  "><i class="fas fa-phone-square-alt mx-2"></i> '.$row['Phone_number'].'</a>';
                        }

                    }
                    else
                    {
                    echo'
                
                        ';
                    }
               
        echo'
                </div>
                
               
              </div>
            </div>
                
                
                ';
            }  

        }
        else
        {


        }




    }

    elseif($type=="Broker")
    {
        $sql="SELECT * FROM broker WHERE Broker_ID='$id'";
        $result=$conn->query($sql);
        if($result->num_rows==1)
        {
            while( $row=$result->fetch_assoc() )
            {
                echo'

                <div class="card w-100  border-0 bg-dark" style="">
              <img class="card-img-top img-fluid rounded-circle mx-auto p-3" style="width:400px; height:450px"  src="'.$row['Profile_pic'].'"  alt="Card image">
              <div class="card-body p-0 ">
                <h4 class="card-title w-100 text-center text-light font-weight-bold">'.$row['First_name'].' '.$row['Last_name'].'</h4>
                <div class="list-group w-100 font-weight-bold text-dark  border-0 ">
                  <a href="#" class="list-group-item  text-decoration-none text-dark  "><i class="fas fa-envelope-square mx-2"></i>'.$row['email'].'</a>
                  <a href="#" class="list-group-item  text-decoration-none text-dark "><i class="fas fa-home mx-2"></i> '.$row['City'].' '.$row['Wereda'].'</a>
                  ';
                  $sql1="SELECT * FROM  broker_phonenumber where Broker_ID='$id'";
                    $result1=$conn->query($sql1);
                    if($result->num_rows >0)
                    {
                      
                        while( $row=$result1->fetch_assoc() )  
                        {  
                            echo'<a href="#" class="list-group-item  text-decoration-none text-dark  "><i class="fas fa-phone-square-alt mx-2"></i> '.$row['Phone_number'].'</a>';
                        }

                    }
                    else
                    {
                    echo'
                
                        ';
                    }
               
            echo'
                </div>
                
               
              </div>
            </div>
                
                
                ';
            }  
        }
        else
        {
            

        }

    }


    elseif($type=="AVC")
    {
        $sql="SELECT * FROM avc WHERE AVC_ID='$id'";
        $result=$conn->query($sql);
        if($result->num_rows==1)
        {
            while( $row=$result->fetch_assoc() )
            {
                echo'

                <div class="card w-100  border-0 bg-dark" style="">
              <img class="card-img-top img-fluid rounded-circle mx-auto p-3" style="width:400px; height:450px"  src="'.$row['Profile_pic'].'"  alt="Card image">
              <div class="card-body p-0 ">
                <h4 class="card-title w-100 text-center text-light font-weight-bold">'.$row['name'].' </h4>
                <div class="list-group w-100 font-weight-bold text-dark  border-0 ">
                  <a href="#" class="list-group-item  text-decoration-none text-dark  "><i class="fas fa-envelope-square mx-2"></i>'.$row['Email'].'</a>
                  ';
                  $sql1="SELECT * FROM  avc_address where AVC_ID='$id'";
                  $result1=$conn->query($sql1);
                  if($result->num_rows >0)
                  {
                    
                      while( $row=$result1->fetch_assoc() )  
                      {  
                      echo' 
                       <a href="#" class="list-group-item  text-decoration-none text-dark "><i class="fas fa-home mx-2"></i> '.$row['City'].' '.$row['Wereda'].'</a>
                        ';
                     }
                  }
                  else
                  {
                  echo'
              
                      ';
                  }

                  $sql1="SELECT * FROM  avc_phonenumber where AVC_ID='$id'";
                    $result1=$conn->query($sql1);
                    if($result->num_rows >0)
                    {
                      
                        while( $row=$result1->fetch_assoc() )  
                        {  
                            echo'<a href="#" class="list-group-item  text-decoration-none text-dark  "><i class="fas fa-phone-square-alt mx-2"></i> '.$row['Phone_number'].'</a>';
                        }

                    }
                    else
                    {
                    echo'
                
                        ';
                    }
               
            echo'
                </div>
                
               
              </div>
            </div>
                
                
                ';
             
                
        }
    }
        else
        {
            

        }

   
    

}
}
?>