

<?php
session_start();
include "connection.php";



//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% for cheking on license request %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

if(isset($_POST['id']))
{
    $id=$_POST['id'];
    if($_SESSION['Client_ID'])
    {
        $sql="SELECT * FROM chat where Client_ID=$id";
        $result=$conn->query($sql);
        if($result->num_rows>0)
        {$count=0;
            while($row=$result->fetch_assoc())
            {   $sender=$row['sendermsg'];
                if($row['sender']==1)
                {
                    $count++;
                }
                if($row['AVC_ID']!=null)
                {
                    $id=$row['AVC_ID'];
                    $sql1="SELECT * from avc where AVC_ID='$id'";
                    $result1=$conn->query($sql1);
                    if($result1->num_rows>0)
                    {   
                        while($row2=$result1->fetch_assoc())
                        {$profile_pic_avc=$row2['Profile_pic'];
                            $name=$row2['name'];
                            echo'
                            <div class="row  bg-light py-2 px-5" style="word-break: break-all;">
                              
                              <img class="rounded-circle float-left mx-2 mb-2"  src="'.$profile_pic_avc.'" style="height:60px;width:60px" alt="profile pic">
                              <h4 class="mx-2 py-3 mb-2">'.$name.'</h4>
                              <p>'.$sender.'</p>
                              </div>';

                        }
                    }
                    else
                    {
                        echo'while there is no file';
                    }
                }

                elseif($row['AVC_ID']==null)
                {
                    $id=$row['Broker_ID'];
                    $sql1="SELECT * from broker where Broker_ID='$id'";
                    $result1=$conn->query($sql1);
                    if($result1->num_rows>0)
                    {   
                        while($row2=$result1->fetch_assoc())
                        {$profile_pic_avc=$row2['Profile_pic'];
                            $First_name=$row2['First_name'];
                            $Last_name=$row2['Last_name'];
                            echo'
                            <div class="row bg-light py-2 px-5" style="word-break: break-all;">
                              
                              <img class="rounded-circle float-left mx-2 mb-2"  src="'.$profile_pic_avc.'" style="height:60px;width:60px" alt="profile pic">
                              <h4 class="mx-2 py-3 mb-2">'.$First_name.' '.$Last_name.'</h4>
                              <p>'.$sender.'</p>
                              </div>';


                        }
                    }
                    else
                    {
                        echo'while there is no file';
                    }
                }
            }
        }
        else
        {

        }
    }
    elseif($_SESSION['Broker_ID'])
    {
        $sql="SELECT * FROM chat where Broker_ID=$id";
        $result=$conn->query($sql);
        if($result->num_rows>0)
        {
            while($row=$result->fetch_assoc())
            {
                
            }

        }
        else
        {

        }
        
    }
    elseif($_SESSION['AVC_ID'])
    {
        $sql="SELECT * FROM chat where AVC_ID=$id";
        $result=$conn->query($sql);
        if($result->num_rows>0)
        {
            while($row=$result->fetch_assoc())
            { 
            }

        }
        else
        {

        }
        
    }
  
 

}


?>
