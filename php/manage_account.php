<?php
session_start();
include "connection.php";
if(isset($_POST['account_type']))
{
    $type=$_POST['account_type'];
    if($type=='Client')
    {
        $sql="SELECT * FROM client";
        $result=$conn->query($sql);
        if($result->num_rows >0)
        {
            echo'
            <div class="col-lg table-responsive-sm">
            <table class="table table-dark rounded table-hover table-striped rounded" id="license_table">
            <caption class="caption"><h4 class="mx-auto"> All clients </h4></caption>
            <thead> 
                <tr>
                <th>Client_ID</th>
                <th >First_name</th>
                <th >Last_name</th>        
                <th>Email</th>
                <th>City</th>
                <th>Wereda</th>
                <th>Post amount</th>
                <th>profile_pic</th>
                <th>Account_status</th>
                <th>Created date</th>
                <th>action</th>
                </tr>
            </thead>
            <tbody>';
            while( $row=$result->fetch_assoc() )
            {
                echo' <tr>
                <td>'.$row['Client_ID'].'</td>
                <td >'.$row['First_name'].'</td>
                <td>'.$row['Last_name'].'</td>
                <td>'.$row['email'].'</td>
                <td>'.$row['city'].'</td>
                <td>'.$row['wereda'].'</td>
                <td>'.$row['post_amount'].'</td>
                <td>'.$row['profile_pic'].'</td>
                <td>'.$row['Account_status'].'</td>
                <td>'.$row['create_date'].'</td>
                
                ';
                
                echo
                ' <td>
                <input type ="button"  name="activate"    value="Activate " onclick="activate('.$row['Client_ID'].',\'Client\')"    class=" btn btn-success m-2 ">
                <input type ="button"  name="activate"    value="suspend " onclick="suspend_user ('.$row['Client_ID'].',\'Client\')"    class=" btn btn-primary m-2 ">
                <input type ="button"  name="activate"    value="Remove " onclick="remove_user ('.$row['Client_ID'].',\'Client\')"    class=" btn btn-danger m-2 ">
                
                
                </td>

                
                </tr>';

            }
            echo' </tbody>
            </table>
            </div>
            ';
        }
        else
        {
            echo' <div id= "toadd"  >
            <div >
              <div class="container" id="success" >
                  <div class="alert alert-info alert-dismissible fade show">
                      <strong>!</strong> no client account !!
                      <P>
                     
                  </div>
              </div>
            </div>
          </div>';

        }

    }

 //for loading all broker info into a table
    elseif( $type=='Broker')
    {


        $sql="SELECT `broker`.`Broker_ID`, `broker`.`First_name`, `broker`.`Last_name`, `broker`.`email`, `broker`.`City`, `broker`.`Wereda`,
         `broker`.`Profile_pic`, `broker`.`Account_status`, `broker`.`Create_date`, `score`.`Score_point`
        FROM `broker` 
            LEFT JOIN `score` ON `score`.`Broker_ID` = `broker`.`Broker_ID`;";
        $result=$conn->query($sql);
        if($result->num_rows >0)
        {
            echo'
            <div class="col-lg table-responsive-sm">
            <table class="table table-dark rounded table-hover table-striped rounded" id="license_table">
            <caption class="caption"><h4 class="mx-auto"> All Brokers </h4></caption>
            <thead> 
                <tr>
                <th>Broker_ID</th>
                <th >First_name</th>
                <th >Last_name</th>        
                <th>Email</th>
                <th>City</th>
                <th>Wereda</th>
               
                <th>profile_pic</th>
                <th>Account_status</th>
                <th>Created date</th>
                <th>Score</th>
                <th>action</th>
                </tr>
            </thead>
            <tbody>';
            while( $row=$result->fetch_assoc() )
            {
                echo' <tr>
                <td>'.$row['Broker_ID'].'</td>
                <td >'.$row['First_name'].'</td>
                <td>'.$row['Last_name'].'</td>
                <td>'.$row['email'].'</td>
                <td>'.$row['City'].'</td>
                <td>'.$row['Wereda'].'</td>
                <td>'.$row['Profile_pic'].'</td>
                <td>'.$row['Account_status'].'</td>
                <td>'.$row['Create_date'].'</td>
                <td>'.$row['Score_point'].'</td>
                
                ';
                
                echo
                ' <td>
                <input type ="button"  name="activate"    value="Activate " onclick="activate_user('.$row['Broker_ID'].',\'Broker\')"    class=" btn btn-success m-2 ">
                <input type ="button"  name="activate"    value="suspend " onclick="suspend_user ('.$row['Broker_ID'].',\'Broker\')"    class=" btn btn-primary m-2 ">
                <input type ="button"  name="activate"    value="Remove " onclick="remove_user ('.$row['Broker_ID'].',\'Broker\')"    class=" btn btn-danger m-2 ">
                
                
                </td>

                
                </tr>';

            }
            echo' </tbody>
            </table>
            </div>
            ';
        }
        else
        {
            echo' <div id= "toadd"  >
            <div >
              <div class="container" id="success" >
                  <div class="alert alert-info alert-dismissible fade show">
                      <strong>!</strong> no client account !!
                      <P>
                     
                  </div>
              </div>
            </div>
          </div>';

        }


    }



    //for loading the AVC  to a table
    elseif( $type=='AVC')
    {
        $sql="SELECT * FROM avc";
        $result=$conn->query($sql);
        if($result->num_rows >0)
        {
            echo'
            <div class="col-lg table-responsive-sm">
            <table class="table table-dark rounded table-hover table-striped rounded" id="license_table">
            <caption class="caption"><h4 class="mx-auto"> All AVC accounts</h4></caption>
            <thead> 
                <tr>
                <th>AVC_ID</th>
                <th >Name</th>     
                <th>Email</th>
                <th>City</th>
                <th>Wereda</th>
                <th>Post amount</th>
                <th>profile_pic</th>
                <th>Account_status</th>
                <th>Created date</th>
                <th>action</th>
                </tr>
            </thead>
            <tbody>';
            while( $row=$result->fetch_assoc() )
            {
                echo' <tr>
                <td>'.$row['AVC_ID'].'</td>
                <td >'.$row['First_name'].'</td>
                <td>'.$row['Last_name'].'</td>
                <td>'.$row['email'].'</td>
                <td>'.$row['city'].'</td>
                <td>'.$row['wereda'].'</td>
                <td>'.$row['profile_pic'].'</td>
                <td>'.$row['Account_status'].'</td>
                <td>'.$row['create_date'].'</td>
                
                ';
                
                echo
                ' <td>
                <input type ="button"  name="activate"    value="Activate " onclick="activate('.$row['Client_ID'].',\'Client\')"    class=" btn btn-success m-2 ">
                <input type ="button"  name="activate"    value="suspend " onclick="suspend_user ('.$row['Client_ID'].',\'Client\')"    class=" btn btn-primary m-2 ">
                <input type ="button"  name="activate"    value="Remove " onclick="remove_user ('.$row['Client_ID'].',\'Client\')"    class=" btn btn-danger m-2 ">
                
                
                </td>

                
                </tr>';

            }
            echo' </tbody>
            </table>
            </div>
            ';
        }
        else
        {
            echo' <div id= "toadd"  >
            <div >
              <div class="container" id="success" >
                  <div class="alert alert-info alert-dismissible fade show">
                      <strong>!</strong> no client account !!
                      <P>
                     
                  </div>
              </div>
            </div>
          </div>';

        }


    }
    elseif( $type=='Admin')
    {
        $sql="SELECT * FROM client";
        $result=$conn->query($sql);
        if($result->num_rows >0)
        {
            echo'
            <div class="col-lg table-responsive-sm">
            <table class="table table-dark rounded table-hover table-striped rounded" id="license_table">
            <caption class="caption"><h4 class="mx-auto"> All clients </h4></caption>
            <thead> 
                <tr>
                <th>Client_ID</th>
                <th >First_name</th>
                <th >Last_name</th>        
                <th>Email</th>
                <th>City</th>
                <th>Wereda</th>
                <th>Post amount</th>
                <th>profile_pic</th>
                <th>Account_status</th>
                <th>Created date</th>
                <th>action</th>
                </tr>
            </thead>
            <tbody>';
            while( $row=$result->fetch_assoc() )
            {
                echo' <tr>
                <td>'.$row['Client_ID'].'</td>
                <td >'.$row['First_name'].'</td>
                <td>'.$row['Last_name'].'</td>
                <td>'.$row['email'].'</td>
                <td>'.$row['city'].'</td>
                <td>'.$row['wereda'].'</td>
                <td>'.$row['profile_pic'].'</td>
                <td>'.$row['Account_status'].'</td>
                <td>'.$row['create_date'].'</td>
                
                ';
                
                echo
                ' <td>
                <input type ="button"  name="activate"    value="Activate " onclick="activate('.$row['Client_ID'].',\'Client\')"    class=" btn btn-success m-2 ">
                <input type ="button"  name="activate"    value="suspend " onclick="suspend_user ('.$row['Client_ID'].',\'Client\')"    class=" btn btn-primary m-2 ">
                <input type ="button"  name="activate"    value="Remove " onclick="remove_user ('.$row['Client_ID'].',\'Client\')"    class=" btn btn-danger m-2 ">
                
                
                </td>

                
                </tr>';

            }
            echo' </tbody>
            </table>
            </div>
            ';
        }
        else
        {
            echo' <div id= "toadd"  >
            <div >
              <div class="container" id="success" >
                  <div class="alert alert-info alert-dismissible fade show">
                      <strong>!</strong> no client account !!
                      <P>
                     
                  </div>
              </div>
            </div>
          </div>';

        }


    }
}



?>