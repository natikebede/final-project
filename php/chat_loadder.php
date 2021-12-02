<?php
include "connection.php"; 
//for  loading  header
if(isset($_POST['pID'])&&isset($_POST['acctype']))
{
   
    $id=$_POST['pID'];
    $type=$_POST['acctype'];
    if($type=="Client")
    {
        $sql="SELECT * FROM client WHERE Client_ID='$id'";
        $result=$conn->query($sql);
        if($result->num_rows==1)
        {
            while( $row=$result->fetch_assoc() )
            {
                echo'<div class="container-fluid  px-2 w-100">
                        <div class="row py-2  px-3 w-100  ">
                        <img class="rounded-circle float-left mx-2 mb-2"  src="'.$row['profile_pic'].'" style="height:60px;width:60px" alt="profile pic">
                        <h5 class="mx-2 py-3 text-dark font-weight-bolder mb-2">'.$row['First_name'].' '.$row['Last_name'].'</h5><br>
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
                       </div>';
            } 
             echo'<a href="#" class="close mr-2" data-dismiss="modal" aria-label="close">&times;</a>';
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
    
    
    elseif($type=="Broker")
    {
        $sql="SELECT * FROM broker WHERE Broker_ID='$id'";
        $result=$conn->query($sql);
        if($result->num_rows==1)
        {
            while( $row=$result->fetch_assoc() )
            {
                echo'<div class="container-fluid px-2 my-2 w-100">
                <div class="row py-2 my-2 px-3 w-100  ">
                <img class="rounded-circle float-left mx-2 mb-2"  src="'.$row['Profile_pic'].'" style="height:60px;width:60px" alt="profile pic">
                <h5 class="mx-2 py-3 text-dark font-weight-bolder mb-2">'.$row['First_name'].' '.$row['Last_name'].'</h5><br>';
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
               </div>';
            }
            echo'<a href="#" class="close mr-2" data-dismiss="modal" aria-label="close">&times;</a>';
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
    elseif($type=="AVC")
    {
        $sql="SELECT * FROM avc WHERE AVC_ID='$id'";
        $result=$conn->query($sql);
        if($result->num_rows==1)
        {
            while( $row=$result->fetch_assoc() )
            {
                echo'<div class="container-fluid px-2 my-2 w-100">
                            <div class="row py-2 my-2 px-3 w-100  ">
                            <img class="rounded-circle float-left mx-2 mb-2"  src="'.$row['Profile_pic'].'" style="height:60px;width:60px" alt="profile pic">
                            <h5 class="mx-2 py-3 text-dark font-weight-bolder mb-2">'.$row['name'].' </h5><br>';
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
                          </div>';
            }
            echo'<a href="#" class="close mr-2" data-dismiss="modal" aria-label="close">&times;</a>';
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
// for loading button send
elseif(isset($_POST['reciverID'])&&isset($_POST['acctype']) &&isset($_POST['user_id']) )
{
 
  
  $reciver_type=$_POST['reciver_type'];
  $type=$_POST['acctype'];
  $senderID=$_POST['user_id'];
  $reciverID=$_POST['reciverID'];
  $file_name=$type."-".$senderID."-".$reciverID.".html";
  $view="chat_file/".$file_name;
  if(file_exists("chat_file/".$file_name))
  {
  
   
    echo'
    <div class="col-sm-12  w-100">
                      <form class="" action="/action_page.php">
                        <div class="input-group w-100  px-5">
                          <textarea class=" form-control " rows="4" cols ="4 " value="'.$view.'" id="usermsg" name="usermsg" required></textarea>
                          <script>
                         
                          </script>
                         
                          <div class="w-100 my-3 ">
                          <input type="text" name="filemsg" disabled class="form-control"  id="usermsgs"  value="'.$view.'">
                          <input name="reciver_type" disabled class="form-control" type="text" id="reciver_type" value="'.$reciver_type.'">
                            <input name="submitmsg" class=" float-right btn btn-success my-3 " type="button" onclick="write_message()" id="submitmsg" value="Send">
                          </div>
                        
                         
                        </div>
                          </form>
  
  
  
                    </div>';

  }

  else
  {
      if($type=="Client-Broker")
      {
      $sql="INSERT INTO chat( Start_date, Chat_file, Broker_ID, Client_ID)
      VALUES ('$date','php/chat_file/$file_name','$reciverID','$senderID')";
      if($conn->query($sql)===true)
      {

      }
      else
      {
        echo'<div id= "toadd" class="" >
        <div class="">
          <div class="container" id="success" >
              <div class="alert alert-success alert-dismissible fade show">
                  <strong>!</strong> '.$conn->error.'!!
                  <P>
                  <button type="button" onclick="got_to_back ()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
              </div>
          </div>
        </div>
      </div>';
      }
      }

      elseif($type=="Client-AVC")
      {
      $sql="INSERT INTO chat( Start_date, Chat_file,  Client_ID, AVC_ID)
      VALUES ('$date','php/chat_file/$file_name','$senderID','$reciverID')";
      if($conn->query($sql)===true)
      {

      }
      else{}
      }
      

      elseif($type=="Broker-AVC")
      {
      $sql="INSERT INTO chat( Start_date, Chat_file, Broker_ID, AVC_ID)
        VALUES ('$date','php/chat_file/$file_name','$reciverID','$senderID')";
        if($conn->query($sql)===true)
      {

      }
      else{}
      }



      $myfile = fopen("chat_file/".$file_name, "w") ;
    echo'
    <div class="col-sm-12  w-100">
                      <form class="" action="/action_page.php">
                        <div class="input-group w-100  px-5">
                          <textarea class=" form-control " rows="4" cols ="4 " id="usermsg" name="usermsg" required></textarea>
                          <script>
                        
                          </script>
                        
                          <div class="w-100 my-3 ">
                        
                          <input type="text" name="filemsg" disabled class="form-control"  id="file_name_message" value="'.$view.'">
                          <input name="reciver_type"  disabled class="form-control" type="text" id="reciver_type" value="'.$reciver_type.'">
                            <input name="submitmsg" class=" float-right btn btn-success" type="button" onclick="write_message()" id="submitmsg" value="Send">
                          </div>
                          
                          
      
                        </div>
                          </form>



                    </div>';
      }
  
  
      
  
}
//write message for client
elseif(isset($_POST['text_message_send'])&&isset($_POST['file_name']))
{
  $text_message=$_POST['text_message_send'];
  $file=$_POST['file_name'];
  $text_message='
    <div class="outgoing" >
                    <div class="details ">
                      <p class=" text-light bg-primary p-4" >
                      '.$text_message.'
                        <span class="text-light w-100  float-right"style="bottom:0;font-size:10px;">
                        '.date("g:i A").'
                        </span>
                      </p>
                    </div>
            </div>
  ';
 
  file_put_contents($file, $text_message, FILE_APPEND | LOCK_EX);
  
}


//read chat loag
else if( isset($_POST['read_file_name']))
{
  $file_name=$_POST['read_file_name'];
  $contents = file_get_contents($file_name);         
  echo $contents;
}


?>