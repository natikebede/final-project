<?php
session_start();
include "connection.php";
if(isset($_POST['load_license_table']))
{
    $sql="SELECT license.License_ID, license.License_status, license.License_description, license.Upload_date,
    license.Admin_ID, avc.AVC_ID, avc.name,  avc.Account_status FROM license LEFT JOIN avc ON
     license.AVC_ID = avc.AVC_ID  WHERE license.License_status='pending' OR license.License_status='Approved'  ORDER BY license.Upload_date DESC";
   $result=$conn->query($sql);
   if($result->num_rows >0)
   {
       echo'
       <div class="col-lg table-responsive-sm">
       <table class="table table-dark rounded table-hover table-striped rounded" id="license_table">
       <caption class="caption"><h4 class="mx-auto"> All license requests </h4></caption>
       <thead> 
         <tr>
           <th>License ID</th>
           <th style="width:200px;">License_description</th>
           <th>Upload_date</th>          
           <th>AVC_ID</th>
           <th>name</th>
           <th>License_status</th>
           <th>Account_status</th>
           <th>Admin ID</th>
           <th>action</th>
         </tr>
       </thead>
       <tbody>';
       while( $row=$result->fetch_assoc() )
       {
          echo' <tr>
           <td>'.$row['License_ID'].'</td>
           <td class="w-25" style="width:200px;">'.$row['License_description'].'</td>
           <td>'.$row['Upload_date'].'</td>
           <td>'.$row['AVC_ID'].'</td>
           <td>'.$row['name'].'</td>
           <td>'.$row['License_status'].'</td>
           <td>'.$row['Account_status'].'</td>
           <td>'.$row['Admin_ID'].'</td>
           ';
           
           echo
           ' <td>
           <input type ="button"  name="activate"    value="Approve " onclick="Approve_License('.$row['License_ID'].', '.$row['AVC_ID'].')"    class=" btn btn-success m-2 ">
           <input type ="button"  name="activate"    value="Denied " onclick="Denay_License ('.$row['License_ID'].','.$row['AVC_ID'].')"    class=" btn btn-primary m-2 ">
           <input type ="button"  name="activate"    value="view " onclick="view_license ('.$row['License_ID'].','.$row['AVC_ID'].')"    class=" btn btn-primary m-2 ">
          
           
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
              <strong>!</strong> no license Requests !!
              <P>
             
          </div>
      </div>
    </div>
  </div>';

   }

}


// for approving request sent by a company
elseif(isset($_POST['License_ID'])&& isset($_POST['Admin_ID']))
{
    $license_ID=$_POST['License_ID'];
    $Admin_ID=$_POST['Admin_ID'];
    $AVC_ID=$_POST['AVC_ID'];
    $sql=" UPDATE license SET license_status='Approved', Admin_ID='$Admin_ID' WHERE License_ID='$license_ID'";
    if ($conn->query($sql)===true)
    {
      
      $sql=" UPDATE avc SET avc.License_status ='Approved' WHERE AVC_ID='$AVC_ID'";
      if ($conn->query($sql)===true)
      {
       
  
      }
      else
      {
          echo' <div id= "toadd" class="w3-modal" >
          <div class="w3-modal-content w3-animate-zoom">
            <div class="container" id="success" >
                <div class="alert alert-danger alert-dismissible fade show">
                    <strong>!</strong> error occurred Approving license !!
                    <P>
                    <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                </div>
            </div>
          </div>
        </div>';
      }
  

    }
    else
    {
        echo' <div id= "toadd" class="w3-modal" >
        <div class="w3-modal-content w3-animate-zoom">
          <div class="container" id="success" >
              <div class="alert alert-danger alert-dismissible fade show">
                  <strong>!</strong> error occurred Approving license !!
                  <P>
                  <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
              </div>
          </div>
        </div>
      </div>';
    }


}

//for denying request for approvale 
elseif(isset($_POST['DLicense_ID']) && isset($_POST['Admin_ID']))
{
    $license_ID=$_POST['DLicense_ID'];
    $Admin_ID=$_POST['Admin_ID'];
    $AVC_ID=$_POST['AVC_ID'];
    $sql=" UPDATE license SET license_status='Denied', Admin_ID='$Admin_ID' WHERE License_ID='$license_ID'";
    if ($conn->query($sql)===true)
    {


        $sql=" UPDATE avc SET avc.License_status ='Denied' WHERE AVC_ID='$AVC_ID'";
        if ($conn->query($sql)===true)
        {
        
    
        }
        else
        {
            echo' <div id= "toadd" class="w3-modal" >
            <div class="w3-modal-content w3-animate-zoom">
              <div class="container" id="success" >
                  <div class="alert alert-danger alert-dismissible fade show">
                      <strong>!</strong> error occurred Approving license !!
                      <P>
                      <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                  </div>
              </div>
            </div>
          </div>';
        }
    }
    else
    {
        echo' <div id= "toadd" class="w3-modal" >
        <div class="w3-modal-content w3-animate-zoom">
          <div class="container" id="success" >
              <div class="alert alert-danger alert-dismissible fade show">
                  <strong>!</strong> error occurred Activating post !!
                  <P>
                  <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
              </div>
          </div>
        </div>
      </div>';
    }


}




?>