<?php
session_start();
include "connection.php";
//for activating account  of any type
if(isset($_POST['active_account_id'])&& isset($_POST['active_account_type']))
{
    $type=$_POST['active_account_type'];
    $id=$_POST['active_account_id'];

    if($type=="Client")
    {
        $sql="UPDATE account SET Account_status='Active' WHERE Client_ID='$id'";
        if($conn->query($sql)===true)
        {

        }
        else
        {

        }

    }
    elseif($type=="Admin")
    {
        $sql="UPDATE account SET Account_status='Active' WHERE Admin_ID='$id'";
        if($conn->query($sql)===true)
        {

        }
        else
        {

        }

    }
    elseif($type=="Broker")
    {
        $sql="UPDATE account SET Account_status='Active' WHERE Broker_ID='$id'";
        if($conn->query($sql)===true)
        {

        }
        else
        {

        }
    }

    elseif($type=="AVC")
    {
        $sql="UPDATE account SET Account_status='Active' WHERE AVC_ID='$id'";
        if($conn->query($sql)===true)
        {

        }
        else
        {

        }
    }
    

}



//for suspending account

if(isset($_POST['deactive_account_id'])&& isset($_POST['deactive_account_type']))
{
    $type=$_POST['deactive_account_type'];
    $id=$_POST['deactive_account_id'];

    if($type=="Client")
    {
        $sql="UPDATE account SET Account_status='Suspended' WHERE Client_ID='$id'";
        if($conn->query($sql)===true)
        {

        }
        else
        {

        }

    }
    elseif($type=="Admin")
    {
        $sql="UPDATE account SET Account_status='Suspended' WHERE Admin_ID='$id'";
        if($conn->query($sql)===true)
        {

        }
        else
        {

        }

    }
    elseif($type=="Broker")
    {
        $sql="UPDATE account SET Account_status='Suspended' WHERE Broker_ID='$id'";
        if($conn->query($sql)===true)
        {

        }
        else
        {

        }
    }

    elseif($type=="AVC")
    {
        $sql="UPDATE account SET Account_status='Suspended' WHERE AVC_ID='$id'";
        if($conn->query($sql)===true)
        {

        }
        else
        {

        }
    }
    

}



//for removing account totally
if(isset($_POST['remove_account_id'])&& isset($_POST['remove_account_type']))
{
    $type=$_POST['remove_account_type'];
    $id=$_POST['remove_account_id'];

    if($type=="Client")
    {
        $sql="DELETE FROM client WHERE Client_ID='$id'";
        if($conn->query($sql)===true)
        {

        }
        else
        {
            echo' <div id= "toadd" class="w3-modal" >
            <div class="w3-modal-content w3-animate-zoom">
              <div class="container" id="success" >
                  <div class="alert alert-danger alert-dismissible fade show">
                      <strong>!</strong> error occurred removing Admin!!
                      <P>
                      <button type="button" class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                  </div>
              </div>
            </div>
          </div>';

        }

    }
    elseif($type=="Admin")
    {
        $sql="DELETE FROM Admin  WHERE Admin_ID='$id'";
        if($conn->query($sql)===true)
        {

        }
        else
        {
            echo' <div id= "toadd" class="w3-modal" >
            <div class="w3-modal-content w3-animate-zoom">
              <div class="container" id="success" >
                  <div class="alert alert-danger alert-dismissible fade show">
                      <strong>!</strong> error occurred removing admin !!
                      <P>
                      <button type="button" class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                  </div>
              </div>
            </div>
          </div>';

        }

    }
    elseif($type=="Broker")
    {
        $sql="DELETE FROM broker  WHERE Broker_ID='$id'";
        if($conn->query($sql)===true)
        {

        }
        else
        {

            echo' <div id= "toadd" class="w3-modal" >
            <div class="w3-modal-content w3-animate-zoom">
              <div class="container" id="success" >
                  <div class="alert alert-danger alert-dismissible fade show">
                      <strong>!</strong> error occurred removing admin !!
                      <P>
                      <button type="button" class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                  </div>
              </div>
            </div>
          </div>';
        }
    }

    elseif($type=="AVC")
    {
        $sql="DELETE FROM avc  WHERE AVC_ID='$id'";
        if($conn->query($sql)===true)
        {

        }
        else
        {
            echo' <div id= "toadd" class="w3-modal" >
            <div class="w3-modal-content w3-animate-zoom">
              <div class="container" id="success" >
                  <div class="alert alert-danger alert-dismissible fade show">
                      <strong>!</strong> error occurred removing AVC!!
                      <P>
                      <button type="button" class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
                  </div>
              </div>
            </div>
          </div>';
        }
    }
    

}

?>