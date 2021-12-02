<?php
session_start();
include "connection.php";
if(isset($_POST['load_post_table']))
{
    $sql="SELECT post.Post_discription, post.Upload_date, asset.Asset_name, asset.Asset_type, post.No_views, post.Post_status,
     post.Post_ID,post.Admin_ID,client.First_name,client.Last_name
   FROM post LEFT JOIN asset ON post.Asset_ID = asset.Asset_ID  LEFT JOIN client ON post.Client_ID = client.Client_ID ORDER BY post.Upload_date DESC";
   $result=$conn->query($sql);
   if($result->num_rows >0)
   {
       echo'
       <div class="col-lg table-responsive-sm">
       <table class="table table-dark rounded table-hover table-striped rounded" id="post_table">
       <caption class="caption"><h4 class="mx-auto"> All Asset post information  </h4></caption>
       <thead> 
         <tr>
           <th>Post ID</th>
           <th style="width:200px;">Post Discription</th>
           <th>Upload Date</th>
           <th>Asset name</th>
           <th>Asset type</th>
           <th>Number views</th>
           <th>Post status</th>
           <th>client name</th>
           
           <th>Admin ID</th>
           <th>action</th>
         </tr>
       </thead>
       <tbody>';
       while( $row=$result->fetch_assoc() )
       {
          echo' <tr>
           <td>'.$row['Post_ID'].'</td>
           <td class="w-25" style="width:200px;">'.$row['Post_discription'].'</td>
           <td>'.$row['Upload_date'].'</td>
           <td>'.$row['Asset_name'].'</td>
           <td>'.$row['Asset_type'].'</td>
           <td>'.$row['No_views'].'</td>
           <td>'.$row['Post_status'].'</td>
           <td>'.$row['First_name'].' '.$row['Last_name'].'</td>
          
           
           <td>'.$row['Admin_ID'].'</td>
           ';
           
           echo
           ' <td>
           <input type ="button"  name="activate"    value="Activate " onclick="activate_post('.$row['Post_ID'].')"    class=" btn btn-success m-2 ">
           <input type ="button"  name="activate"    value="suspend " onclick="suspend_post('.$row['Post_ID'].')"    class=" btn btn-primary m-2 ">
           <input type ="button"  name="deactivate"  value="remove " onclick="deactivate_post('.$row['Post_ID'].')"     class=" btn btn-danger m-2">
             
           
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

   }

}
elseif(isset($_POST['post_ID'])&& isset($_POST['Admin_ID']))
{
    $post_ID=$_POST['post_ID'];
    $Admin_ID=$_POST['Admin_ID'];
    $sql=" UPDATE post SET Post_status='suspended', Admin_ID='$Admin_ID' WHERE Post_ID='$post_ID'";
    if ($conn->query($sql)===true)
    {

    }
    else
    {
        echo' <div id= "toadd" class="w3-modal" >
        <div class="w3-modal-content w3-animate-zoom">
          <div class="container" id="success" >
              <div class="alert alert-danger alert-dismissible fade show">
                  <strong>!</strong> error occurred suspending post !!
                  <P>
                  <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
              </div>
          </div>
        </div>
      </div>';
    }


}


elseif(isset($_POST['Apost_ID']))
{
    $post_ID=$_POST['Apost_ID'];
    $Admin_ID=NULL;
    $sql="UPDATE post SET Post_status='active',Admin_ID=NULL WHERE  Post_ID='$post_ID'";
    if ($conn->query($sql)===true)
    {

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

elseif(isset($_POST['Dpost_ID']))
{
    $post_ID=$_POST['Dpost_ID'];
  
    $sql=" DELETE FROM post WHERE Post_ID='$post_ID'";
    if ($conn->query($sql)===true)
    {

    }
    else
    {
        echo' <div id= "toadd" class="w3-modal" >
        <div class="w3-modal-content w3-animate-zoom">
          <div class="container" id="success" >
              <div class="alert alert-danger alert-dismissible fade show">
                  <strong>!</strong> error occurred Removing post  !!
                  <P>
                  <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
              </div>
          </div>
        </div>
      </div>';
    }


}


?>