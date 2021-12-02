<?php
include "connection.php";
if(isset($_POST['text_message_send'])&&isset($_POST['file_name']) &&isset($_POST['Account_type']))
{
    $acc_type=$_POST['Account_type'];
    if($acc_type=='AVC')
    {
        if(isset($_POST['file_name']))
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
       
        }
    }
    else
    {

    if(isset($_POST['file_name'])){
        $text_message=$_POST['text_message_send'];
        $file=$_POST['file_name'];
        $text_message='
            <div class="incoming" >
                            <div class="details ">
                            <p class=" text-light bg-info p-4" >
                            '.$text_message.'
                                <span class="text-light w-100  float-right"style="bottom:0;font-size:10px;">
                                '.date("g:i A").'
                                </span>
                            </p>
                            </div>
                    </div>
        ';
    }
        }
  file_put_contents($file, $text_message, FILE_APPEND | LOCK_EX);
}
?>