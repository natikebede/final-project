

<?php
session_start();
include "connection.php";



//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% for cheking on license request %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

if(isset($_POST['Account_ID']))
{
    $AVC_ID=$_POST['Account_ID'];
$sql="SELECT * FROM license WHERE AVC_ID='$AVC_ID' ";
$result=$conn->query($sql);


if($result->num_rows ==1 )
{

    while( $row=$result->fetch_assoc())
    {
        if($row['License_status']=='pending')
        {
            $request_ID=$row['License_ID'];
            echo' 
            <div class="alert p-5 alert-light alert-dismissible fade show">
       
            <strong>License status :</strong>  your license is pendding for approval.
          
            <button type="button" class=" my-3 float-right btn btn-danger"   onclick ="remove_request('. $request_ID.')" >cancel request</button>
          </div>';
        }
        elseif($row['License_status']=='Approved')
        {
            
            echo' 
            <div class="alert p-5 alert-light alert-dismissible fade show">
            <strong class="text-success font-weight-bold"> congratulation </strong> your license has been Approved.<br>
            <strong> your Account is now verified .<span class="text-primary mx-1  fas fa-user-check"></span></strong> 
          </div>';
        }

        elseif($row['License_status']=='Denied')
        {
            
            echo' 
            <div class="alert p-5 alert-light alert-dismissible fade show">
            <strong class="text-danger font-weight-bold"> Sorry </strong> your license request has been denied.<br>
         
          </div>';
        }

    }
}
else
{
   echo' <div class="alert p-5 alert-light alert-dismissible fade show">
            <strong class="text-danger font-weight-bold"> Sorry </strong> no license  request uploaded<br>
         
          </div>';

}
 

}

//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  end  of for cheking on license request %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%








//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^For removing a license request ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ 
elseif(isset($_POST['License_ID']))
{
    $request_ID=$_POST['License_ID'];
    $sql="DELETE FROM license WHERE License_ID='$request_ID'";
    if($conn->query($sql)===true)
    {
    echo
        '
        
        ';
    }
    else
    {

        echo'<div id= "toadd" class="show" >
      <div class=" w3-animate-zoom">
        <div class="container p-2" id="success" >
            <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>!</strong> Error:'. $sql .' <br> ' . $conn->error.' !!
                <P>
               
            </div>
        </div>
      </div>
    </div>';
    }

    
}

//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% For removing a license request  %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%



?>
