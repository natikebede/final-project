
  <!DOCTYPE html>
<html lang="en">
    <head>
        <title>AVS.com</title>
        <title>upload</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  
  <script src="../fonts/css/all.min.css"></script>
  <script src="../js/jquery.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
        <style>
.w3-modal{
    z-index:3;
    display:block;
    padding-top:100px;
    position:fixed;
    left:0;
    top:0;
    width:100%;
    height:100%;
    overflow:auto;
    align-content:center;
    background-color:rgb(0,0,0);
    background-color:rgba(0,0,0,0.4)}
  
  .w3-animate-zoom {animation:animatezoom 0.6s}@keyframes animatezoom{from{transform:scale(0)} to{transform:scale(1)}}
  
  .w3-modal-content
  {
  
     height: auto; 
     overflow: auto;
       border-radius: 15px;
       padding: 10px;
       margin: 10px 10px 50px;
    width:  auto;
    display: block;
  padding-bottom: 40px;
  background-color: (232, 235, 235)
  
  }
 
</style>
       
    </head>
    <body class="bg-dark">
        
<?php
 session_start();

include "connection.php";

$php_FileUpload_Errors=array(
    0=>'There is no error, the file  uploaded with success',
    1=>'the  uploaded file exceeds the upload size limit in the php.ini directive',
    2=>'the  uploaded file exceeds the upload Max_FILE_ SIZE directive that was specified in the HTML form',
    3=>'the uploaded file was only partially uploaded',
    4=>'no the file was uploaded',
    5=>'file already exists',
    6=>'missing a temporary folder',
    7=>'failed to write file to disk',
    8=>'a php extension stoped the file upload',

);



function pre_r($array)
{
    echo'<pre>';
    print_r($array);
    echo'</pre>';
    
}
function re_Array_Files($file_post)
{
    $file_array=array();
    $file_count=count($file_post['name']);
    $file_keys= array_keys($file_post);
    for($i=0; $i<$file_count;$i++)
    {
        foreach($file_keys as $key)
        {
            $file_array[$i][$key]=$file_post[$key][$i];
        }
    }
    return $file_array;
}
if(isset($_FILES["asset_pic"]))
{   $file_location=array();
    
   $newfiles= re_Array_Files($_FILES["asset_pic"]);
    //pre_r( $newfiles);
    for($i=0;$i<count($newfiles);$i++)
    {
      $target_file="uploads/asset_pic/";
        if($newfiles[$i]['error'])
        {
            echo'<div id= "toadd" class="" >
            <div class=" w3-animate-zoom">
              <div class="container" id="success" >
                  <div class="alert alert-danger alert-dismissible fade show">
                      <strong>!</strong> '.$newfiles[$i]["name"].'- '.$php_FileUpload_Errors[$newfiles[$i]["error"]].' !!
                      <P>
                      <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                  </div>
              </div>
            </div>
          </div>';

        }
        else
        {
            $extesion=array('jpg','png','gif','PNG','jpeg','JPG','GIF','JPEGS');
            $file_ext=explode('.',$newfiles[$i]['name']);
            $file_ext=end($file_ext);
            if(!in_array($file_ext,$extesion))
            {
                echo'<div id= "toadd" class="show" >
            <div class=" w3-animate-zoom">
              <div class="container p-2" id="success" >
                  <div class="alert alert-danger alert-dismissible fade show">
                      <strong>!</strong> '.$newfiles[$i]["name"].'- invalid extenstion !!
                      <P>
                      <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                  </div>
              </div>
            </div>
          </div>';

            }
            else
            {   $target_file= $target_file.basename($newfiles[$i]["name"]);
                if(file_exists($target_file))
                {   
                  $file_location[$i]="php/uploads/asset_pic/".$newfiles[$i]["name"];
                    echo'<div id= "toadd" class="show" >
                    <div class=" w3-animate-zoom">
                      <div class="container p-2" id="success" >
                          <div class="alert alert-success alert-dismissible fade show">
                          <strong>!</strong> '.$newfiles[$i]["name"].'- file aready exist\'s !!
                              <P>
                              <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                          </div>
                      </div>
                    </div>
                  </div>';
                  continue;

                }
                else
                {
                  
                    move_uploaded_file($newfiles[$i]['tmp_name'], $target_file);
                    $file_location[$i]="php/uploads/asset_pic/".$newfiles[$i]["name"];
                    echo'<div id= "toadd" class="show" >
                    <div class=" w3-animate-zoom">
                      <div class="container p-2" id="success" >
                          <div class="alert alert-success alert-dismissible fade show">
                          <strong>!</strong> '.$newfiles[$i]["name"].'- '.$php_FileUpload_Errors[$newfiles[$i]["error"]].' !!
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
    
    $last_id=  upload_to_database(); //to upload data to database 
    upload_image($last_id,$file_location);//to upload image to databa
//pre_r( $file_location);
}
function upload_to_database()
{ $client_ID=$_SESSION['Client_ID'];
  $conn=$GLOBALS['conn'];
  $discription=$_POST["discription"];
  $date=date("Y-m-d h:i:s");
  $sql="INSERT INTO post( Post_discription, Upload_date,  Client_ID )VALUES ('$discription','$date','$client_ID')";
  if($conn->query($sql)===true)
  {
    $last_id= $conn->insert_id;
    $sql="SELECT * FROM client where   Client_ID ='$client_ID'";
    $result=$conn->query($sql);
    if($result->num_rows==1)
    {
      while($row=$result->fetch_assoc())
      {
        $amount=$row['post_amount']+1;
        $sql="UPDATE client SET post_amount='$amount' where Client_ID='$client_ID'";
        if($conn->query($sql)===true)
        {

        }
        else
        {
          echo'<div id= "toadd" class="show" >
          <div class=" w3-animate-zoom">
            <div class="container p-2" id="success" >
                <div class="alert alert-danger alert-dismissible fade show">
                <strong>!</strong> Error:'. $sql . '<br>' . $conn->error.' !!
                    <P>
                    <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                </div>
            </div>
          </div>
        </div>';
        }
      }
    }
    else
    {
      echo'<div id= "toadd" class="show" >
      <div class=" w3-animate-zoom">
        <div class="container p-2" id="success" >
            <div class="alert alert-danger alert-dismissible fade show">
            <strong>!</strong> Error:'. $sql . '<br>' . $conn->error.' !!
                <P>
                <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
            </div>
        </div>
      </div>
    </div>';
    }
   return $last_id;

  }

  else
  {
    echo'<div id= "toadd" class="show" >
    <div class=" w3-animate-zoom">
      <div class="container p-2" id="success" >
          <div class="alert alert-danger alert-dismissible fade show">
          <strong>!</strong> Error:'. $sql . '<br>' . $conn->error.' !!
              <P>
              <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
          </div>
      </div>
    </div>
  </div>';
  }


  

    
}
function upload_image($last_id,$pics)
{
  $conn=$GLOBALS['conn'];
  for($i=0;$i<count($pics);$i++)
  {
    $sql="INSERT INTO image_url( Post_ID, Img_url) VALUES ('$last_id','$pics[$i]')";
    if($conn->query($sql)===true)
    {

     

    }
    else
    {
      echo'<div id= "toadd" class="show" >
      <div class=" w3-animate-zoom">
        <div class="container p-2" id="success" >
            <div class="alert alert-danger alert-dismissible fade show">
            <strong>!</strong> Error:'. $sql .' <br> ' . $conn->error.' !!
                <P>
                <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
            </div>
        </div>
      </div>
    </div>';
    return;

    
    }

  }
  echo'<div id= "toadd" class="show" >
  <div class=" w3-animate-zoom">
    <div class="container p-2" id="success" >
        <div class="alert alert-success alert-dismissible fade show">
        <strong>!</strong> all information has been uploded successfully !!
            <P>
            <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
        </div>
    </div>
  </div>
</div>';

}


?>
<script>
  function got_to_back()
  {
    history.back();
  }
</script>
</body>
</html>