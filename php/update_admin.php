<!DOCTYPE html>
<html lang="en">
    <head>
        <title>AVS.com</title>
        <title>upload</title>
  <meta charset="utf-8">
  <meta name="viewport" content="wIDth=device-wIDth, initial-scale=1">
  
  <meta name="viewport" content="wIDth=device-wIDth, initial-scale=1">
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
    wIDth:100%;
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
    wIDth:  auto;
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
if (isset($_POST["update_Admin"])) 
{
  update_Admin ();
}
//function for rearranging multiple arrays
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

//function for updating Admin
function update_Admin ()
{
  
    $Admin_ID=$_SESSION['Admin_ID'];
    $f_name=$_POST['firstname'];
    $l_name=$_POST['lastname'];
    $pwd=md5($_POST['password']);
    $email=$_POST['email'];
    $city=$_POST['city'];
    $wereda=$_POST['wereda'];
    $conn=$GLOBALS['conn'];
    $profile=pic_upload("Admin");
    //update database with out image
    if($profile==null)
    {
        $sql="UPDATE admin SET First_name='$f_name',Last_name='$l_name',Email='$email',City='$city',
        Wereda='$wereda' WHERE Admin_ID='$Admin_ID'";
        if($conn->query($sql)===true)
        {
            
           //update password on account table
            $sql="UPDATE account SET Password='$pwd' WHERE 'Admin_ID'='$Admin_ID'";
            if($conn->query($sql)===true)
            {
                echo'<div ID= "toadd" class="" >
                    <div class=" w3-animate-zoom">
                      <div class="container" ID="success" >
                          <div class="alert alert-success alert-dismissible fade show">
                              <strong>!</strong> account information updated !!
                              <P>
                              <button type="button" onclick="go_to_home_admin ()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                          </div>
                      </div>
                    </div>
                  </div>';
            
        
            }
            else
            {
                echo'<div ID= "toadd" class="show" >
          <div class=" w3-animate-zoom">
            <div class="container p-2" ID="success" >
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
        else
        {
            echo'<div ID= "toadd" class="show" >
          <div class=" w3-animate-zoom">
            <div class="container p-2" ID="success" >
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
    //update database with image 
    else
    {
        $sql="UPDATE admin SET First_name='$f_name',Last_name='$l_name',Email='$email',City='$city',
        Wereda='$wereda',Profile_pic='$profile' WHERE Admin_ID='$Admin_ID'";
        if($conn->query($sql)===true)
        {
            //update password on account table
            $sql=" UPDATE account SET Password='$pwd'  WHERE Admin_ID='$Admin_ID'";;
            if($conn->query($sql)===true)
            {
                echo'<div ID= "toadd" class="" >
                    <div class=" w3-animate-zoom">
                      <div class="container" ID="success" >
                          <div class="alert alert-success alert-dismissible fade show">
                              <strong>!</strong> account information updated !!
                              <P>
                              <button type="button" onclick="go_to_home_admin ()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                          </div>
                      </div>
                    </div>
                  </div>';
            
        
            }
            else
            {
                echo'<div ID= "toadd" class="show" >
          <div class=" w3-animate-zoom">
            <div class="container p-2" ID="success" >
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
        else
        {
            echo'<div ID= "toadd" class="show" >
          <div class=" w3-animate-zoom">
            <div class="container p-2" ID="success" >
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
    
    }


    // method for uploading picture
function pic_upload($to)
{
    $php_FileUpload_Errors=array(
        0=>'There is no error, the file  uploaded with success',
        1=>'the  uploaded file exceeds the upload size limit in the php.ini directive',
        2=>'the  uploaded file exceeds the upload Max_FILE_ SIZE directive that was specified in the HTML form',
        3=>'the uploaded file was only partially uploaded',
        4=>'no the image was uploaded',
        5=>'file already exists',
        6=>'missing a temporary folder',
        7=>'failed to write file to disk',
        8=>'a php extension stoped the file upload',
    
    );

    if(isset($_FILES["profile_pic"]))
    {   $file_location=null;
        $target_file="uploads/profile_pic/".$to."_profile_pic/";
       $newfiles= re_Array_Files($_FILES["profile_pic"]);
      
      
        for($i=0;$i<count($newfiles);$i++)
        {
            if($newfiles[$i]['error'])
            {
                echo'<div ID= "toadd" class="" >
                <div class=" w3-animate-zoom">
                  <div class="container" ID="success" >
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
                    echo'<div ID= "toadd" class="show" >
                <div class=" w3-animate-zoom">
                  <div class="container p-2" ID="success" >
                      <div class="alert alert-danger alert-dismissible fade show">
                          <strong>!</strong> '.$newfiles[$i]["name"].'- invalID extenstion !!
                          <P>
                          <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                      </div>
                  </div>
                </div>
              </div>';
              return null;
    
                }
                else
                {   $target_file= $target_file.basename($newfiles[$i]["name"]);
                    if(file_exists($target_file))
                    {   
                      $file_location="php/uploads/profile_pic/".$to."_profile_pic/".$newfiles[$i]["name"];
                        echo'<div ID= "toadd" class="show" >
                        <div class=" w3-animate-zoom">
                          <div class="container p-2" ID="success" >
                              <div class="alert alert-success alert-dismissible fade show">
                              <strong>!</strong> '.$newfiles[$i]["name"].'- file aready exist\'s !!
                                  <P>
                                  <button type="button" onclick="go_to_home_admin ()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                              </div>
                          </div>
                        </div>
                      </div>';
                      continue;
    
                    }
                    else
                    {
                      
                        move_uploaded_file($newfiles[$i]['tmp_name'], $target_file);
                        $file_location="php/uploads/profile_pic/".$to."_profile_pic/".$newfiles[$i]["name"];
                        echo'<div ID= "toadd" class="show" >
                        <div class=" w3-animate-zoom">
                          <div class="container p-2" ID="success" >
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
        
        return $file_location ;

}
else
{
    return null;
}
}

?>
<script>
  function got_to_back()
  {
    history.back();
  }
  function go_to_home_admin()
  {
    window.location.href="../Adminpage.php";
  }
  function go_to_home_broker()
  {
    window.location.href="../brokerpage.php";
  }
  function go_to_home_AVC ()
  {
    window.location.href="../AVCpage.php";
  }
</script>
</body>
</html>