// for hiding the home page
$(document).ready(function()
{
    $("#home_content").load(function()
  {
  
    $("#uploads_content").hide();
    $("#message_content").hide();
    $("#edit_profile").hide();
    
  });

});


function fname_validation(type)
{
    if(type=="update_Company")
    {
      var name= document.forms[type]["name"];
      fname=name.value;
      name.value= fname[0].toUpperCase()+fname.slice(1);
    }
}

// j-query for search bar 
$(document).ready(function()
{

      
        $("#search-bar").keyup(function(){
          var search_text= $("#search-bar").val();
          if(search_text!='')
          {
            
              search_text= search_text[0].toUpperCase()+search_text.slice(1);
              $("#search-bar").val(search_text);
              var Account_type= document.forms["serial"]["Account_type"].value;
              
        $.ajax({

                url:'php/search_result.php',
                method:'post',
                data:{
                  query:search_text,
                  type:Account_type
                },
                success: function(response)
                {
                    $('#search-dropdown').html(response);
                }
              });
          }
          else
          {
              $('#search-dropdown').html('');
          }
          
        
          
        });

    //when the valuation button is clicked in the top naviagtion
      $("#valuations_button").click(function()
      {
        $("#uploads_content").hide();
        $("#message_content").hide();
        $("#home_content").hide();
        $("#edit_profile").hide();
        $("#valuation_content").show();
        $("#license_form_content").hide();
      
      loadpost();
      license_check();
      });


      //when the eidt  button is clicked
      $("#edit").click(function()
      {
          $("#uploads_content").hide();
          $("#message_content").hide();
          $("#home_content").hide();
          $("#edit_profile").show();
          $("#valuation_content").hide();
          $("#license_form_content").hide();
          loadpost();
          license_check();
      });


    // when the home button is clicked
      $("#home_button").click(function()
      {
          $("#uploads_content").hide();
          $("#message_content").hide();
          $("#home_content").show();
          $("#edit_profile").hide();
          $("#valuation_content").hide();
          $("#license_form_content").hide();
          loadpost();
          license_check();
      });


      //when the  license button is clicked
      $("#license_button").click(function()
      {
          $("#uploads_content").hide();
          $("#message_content").hide();
          $("#license_form_content").show();
          $("#home_content").hide();
          $("#edit_profile").hide();
          $("#valuation_content").hide();
          loadpost();
          license_check();
      });

      //when the message button is clicked
      $("#Messages_button").click(function()
      {
          $("#uploads_content").hide();
          $("#message_content").show();
          $("#home_content").hide();
          $("#edit_profile").hide();
          $("#valuation_content").hide();
          $("#license_form_content").hide();
          loadpost();
          license_check();
      });

      
});


var loadFile = function(event,num) //for loding the image to display
{
  var output = document.getElementsByClassName('forpic');
  output[num].src = URL.createObjectURL(event.target.files[0]);
  output[num].onload = function() {
    URL.revokeObjectURL(output[num].src) // free memory
  }
}
var loadtable= setInterval(loadpost_table,2000);
//load valuation post table
function loadpost_table()
{
  var account_id= document.forms["serial"]["ID"].value;
  var Account_type= document.forms["serial"]["Account_type"].value;
    $.ajax({
      url:"php/upload_valuation.php",
      method:"post",
      data:{Account_ID:account_id,Account_type:Account_type},
      success:function(response)
      {
       $("#valuation_table").html(response)
       count_valuation();
      }
     
    });

}
// to remove valutation from the system 
function remove_valuation(ID)
{
con_value=confirm("Are you sure you want to remove this valuation post");
if(con_value==true){
  $.ajax({
    url:"php/upload_valuation.php",
    method:"post",
    data:{valuation_ID:ID},
    success:function(response)
    {
      loadpost_table();
      count_valuation();
    }


  });}
  else
  {
    
  }
}
// for loading number of valuations
function count_valuation()
{
  var Id= document.forms["serial"]["ID"].value;
  var Account_type= document.forms["serial"]["Account_type"].value;
  $.ajax({
    url:'php/upload_valuation.php',
    method:'post',
    data:{count_ID:Id,ACCtype:Account_type},
    success: function(response)
    {
      $('#post_amount_count').html(response);
    }


});

}

//to display all phone number on edit page
function phone_upload ()
          {    
            var type= document.forms["serial"]["Account_type"].value;
            var Id= document.forms["serial"]["ID"].value;
            $.ajax({
                url:'php/phone_number_load.php',
                method:'post',
                data:{ID:Id,ACCtype:type},
                success: function(response)
                {
                  $('#phonenumberdisplay').html(response);
                  address_load ();
                }
                

            });

       
          }
//  to load all the address in the edit page
          function address_load ()
          {    
            var type= document.forms["serial"]["Account_type"].value;
            var Id= document.forms["serial"]["ID"].value;
            $.ajax({
                url:'php/address_load.php',
                method:'post',
                data:{ID:Id,ACCtype:type},
                success: function(response)
                {
                  $('#addressdisplay').html(response);
                }


            });

       
          }

//to remove a phone number
function deletenumber (count)
{
  var type= document.forms["serial"]["Account_type"].value;
  $.ajax(
      {url:"php/phone_number_load.php",
      method:"post",
      data:{phone_ID:count,ACCtype:type},
      success:function(response)
      {

      }

      })
   
    phone_upload ();
}
//for deleting address
function delete_address (count)
{
  var type= document.forms["serial"]["Account_type"].value;
  $.ajax(
      {url:"php/address_load.php",
      method:"post",
      data:{address_ID:count,ACCtype:type},
      success:function(response)
      {

      }

      })
   
      address_load ();
}
var loadview= setInterval(loadpost,3000);

//to open the valuation form 

function valuate_post(ID)
{
  $("#uploads_content").show();
  $("#message_content").hide();
  $("#home_content").hide();
  $("#edit_profile").hide();
  $("#valuation_content").hide();
  $("#post_ID").val(ID);
  $.ajax ({

      url:"php/post_view.php",
      method:"post",
      data:{Post_ID:ID},
      success:function(response)
      {
        $("#valuation_image").html(response);
        
      }

  });
}





// for loading the all post
function loadpost()
{
  var Id= document.forms["serial"]["ID"].value;
  var Account_type= document.forms["serial"]["Account_type"].value;
  $.ajax({
      url:'php/AVC_post_view.php',
      method:'post',
      data:{Account_ID:Id,ACCtype:Account_type,true:true},
      success: function(response)
    {
      $('#post_view').html(response);
    }


});
           
  
}
//for loading all the profile information of search result
function view_profile(id,type)
{
 
  $.ajax({

    url:'php/search_result.php',
    method:'post',
    data:{pID:id,acctype:type},
    success: function(response)
    {
      $("#viewprofile").html(response);
      $("#profile_view").modal();
    }
  });


}

// function for checking license has been request been sent
var load_licese_check=setInterval(license_check,20000);
function license_check()
{

  var Id= document.forms["serial"]["ID"].value;
  $.ajax({

    url:'php/license_check.php',
    method:'post',
    data:{Account_ID:Id},
    success: function(response)
    {
     
      
      
        $("#license_result_display").html(response);
        $("#license_result_display").show();
        $("#licesne_upload_from").show();
      
     
    }
  });

}
//function for removing request for approval

function remove_request(Id)
{

  var value =confirm("are you sure ?");
    if (value==true)
    {
  $.ajax({

    url:'php/license_check.php',
    method:'post',
    data:{License_ID:Id},
    success: function(response)
    {
      $("#license_result_display").html(response);
      license_check();
     
    }
  });
}
else
{
  
}

}


//open modal for chat 
function view_message(id,type)
{
 
    $.ajax({

      url:'php/chat_loadder.php',
      method:'post',
      data:{pID:id,acctype:type},
      success: function(response)
      {
          $("#chat_header").html(response);
          send_button_update(id,type);
      }
    });


}




//send button load
function send_button_update(id,type)
{
  if (type=="Broker")
  {
   var value=id;
   id = document.forms["serial"]["ID"].value;
    var account_type=type+"-"+document.forms["serial"]["Account_type"].value;
    user_Id=value;
    
  }
  else{
  var user_Id= document.forms["serial"]["ID"].value;
  var account_type=type+"-"+document.forms["serial"]["Account_type"].value;
  

  }
  $.ajax({

    url:'php/chat_loadder.php',
    method:'post',
    data:{
      reciverID:user_Id,
      acctype:account_type,
      user_id:id,
      reciver_type:type
      
    },
    success: function(response)
    {
        $("#send_button").html(response);
        $("#chat_view").modal();
    }
  });

}
//function write message to file
function write_message()
{
  
  
  type=$("#reciver_type").val();
  var text_message= $("#usermsg").val();
  var filename= $("#usermsgs").val();
  //alert(filename);
  
  $.ajax({

    url:'php/chat_broker.php',
    method:'post',
    data:{
      text_message_send:text_message,
      file_name:filename,
      Account_type:type
      
      
    },
    success: function(response)
    {
      $("#usermsg").val("");
        
    }
  });
  
  

}

load_text=setInterval(read_Chat_log,200);
function read_Chat_log()
{
  var oldscrollHeight = $("#chat-log-display")[0].scrollHeight - 20; //Scroll height before the request
    
  var filename= $("#usermsgs").val();
  //alert(filename);
  
  $.ajax({

    url:'php/chat_loadder.php',
    method:'post',
    data:{
      
      read_file_name:filename
      
      
    },
    success: function(response)
    {
      
       $("#chat-log-display").html(response);
       var newscrollHeight = $("#chat-log-display")[0].scrollHeight - 20; //Scroll height after the request
            if(newscrollHeight > oldscrollHeight){
                $("#chat-log-display").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
            }   
    }
  });
}


