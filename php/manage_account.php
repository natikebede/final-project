<?php
session_start();
include "connection.php";
if(isset($_POST['account_type']))
{
    $type=$_POST['account_type'];
    if($type=='Client')
    {
        $sql="SELECT client.Client_ID, client.First_name, client.Last_name, client.email, client.city, client.wereda, 
        client.post_amount, client.create_date, account.Account_status
        FROM client 
            LEFT JOIN account ON account.Client_ID = client.Client_ID;";
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
                <td>'.$row['Account_status'].'</td>
                <td>'.$row['create_date'].'</td>
                
                ';
                
                echo
                ' <td>
                <input type ="button"  name="activate"    value="Activate " onclick="activate_user('.$row['Client_ID'].',\'Client\')"    class=" btn btn-success m-2 ">
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


        $sql="SELECT broker.Broker_ID, broker.First_name, broker.Last_name, broker.email, broker.City, broker.Wereda,
         broker.Profile_pic, broker.Account_status, broker.Create_date, score.Score_point ,account.Account_status
        FROM broker 
            LEFT JOIN score ON score.Broker_ID = broker.Broker_ID
            LEFT JOIN account ON account.Broker_ID = broker.Broker_ID;";
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
                      <strong>!</strong> no Broker account !!
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
        $sql="SELECT avc.AVC_ID, avc.name, avc.Email, avc.License_status, avc.Create_date, account.Account_status
        FROM avc 
            LEFT JOIN account ON account.AVC_ID = avc.AVC_ID;";
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
                <th>Name</th>     
                <th>Email</th>
                <th>License_status</th>
                <th>Account_status</th>
                <th>Created date</th>
                <th>action</th>
                </tr>
            </thead>
            <tbody>';
            while( $row=$result->fetch_assoc() )
            {
                $AVC_ID=$row['AVC_ID'];
                echo' <tr>
                <td>'.$row['AVC_ID'].'</td>
                <td>'.$row['name'].'</td>
                <td>'.$row['Email'].'</td>
                 <td>'.$row['License_status'].'</td>
                <td>'.$row['Account_status'].'</td>
                <td>'.$row['Create_date'].'</td>
                
                ';
                
                echo
                ' <td>
                <input type ="button"  name="activate"    value="Activate " onclick="activate_user('.$row['AVC_ID'].',\'AVC\')"    class=" btn btn-success m-2 ">
                <input type ="button"  name="activate"    value="suspend " onclick="suspend_user ('.$row['AVC_ID'].',\'AVC\')"    class=" btn btn-primary m-2 ">
                <input type ="button"  name="activate"    value="Remove " onclick="remove_user ('.$row['AVC_ID'].',\'AVC\')"    class=" btn btn-danger m-2 ">
                
                
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
                      <strong>!</strong> no company account !!
                      <P>
                     
                  </div>
              </div>
            </div>
          </div>';

        }


    }
    

    //for selecting  admin to display on the table 
    elseif( $type=='Admin')
    {
        $id=$_SESSION['Admin_ID'];
        $sql="SELECT admin.Admin_ID, admin.First_name, admin.Last_name, admin.Email, admin.City, admin.Wereda,
         admin.Account_type, admin.Create_date, account.Account_status
        FROM admin 
            LEFT JOIN account ON account.Admin_ID = admin.Admin_ID WHERE NOT admin.Account_type='super' And NOT admin.Admin_ID='$id' ";
        $result=$conn->query($sql);
        if($result->num_rows >0)
        {
            echo'
            <div class="col-lg table-responsive-sm">
            <table class="table table-dark rounded table-hover table-striped rounded" id="license_table">
            <caption class="caption"><h4 class="mx-auto"> All Admin </h4></caption>
            <thead> 
                <tr>
                <th>Admin_ID</th>
                <th>First_name</th>
                <th>Last_name</th>        
                <th>Email</th>
                <th>City</th>
                <th>Wereda</th>
                <th>Account_status</th>
                <th>Account_type</th>
                <th>Created date</th>
                <th>action</th>
                </tr>
            </thead>
            <tbody>';
            while( $row=$result->fetch_assoc() )
            {
                echo' <tr>
                <td>'.$row['Admin_ID'].'</td>
                <td >'.$row['First_name'].'</td>
                <td>'.$row['Last_name'].'</td>
                <td>'.$row['Email'].'</td>
                <td>'.$row['City'].'</td>
                <td>'.$row['Wereda'].'</td>
                <td>'.$row['Account_status'].'</td>
                <td>'.$row['Account_type'].'</td>
                <td>'.$row['Create_date'].'</td>
                
                ';
                
                echo
                ' <td>
                <input type ="button"  name="activate"    value="Activate " onclick="activate_user('.$row['Admin_ID'].',\'Admin\')"    class=" btn btn-success m-2 ">
                <input type ="button"  name="activate"    value="suspend " onclick="suspend_user ('.$row['Admin_ID'].',\'Admin\')"    class=" btn btn-primary m-2 ">
                <input type ="button"  name="activate"    value="Remove " onclick="remove_user ('.$row['Admin_ID'].',\'Admin\')"    class=" btn btn-danger m-2 ">
                
                
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
                      <strong>!</strong> no Admin account !!
                      <P>
                     
                  </div>
              </div>
            </div>
          </div>';

        }


    }
}



?>