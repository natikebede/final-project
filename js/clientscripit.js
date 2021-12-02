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
    if(type=="register_company")
    {
        var name= document.forms[type]["name"];
        fname=name.value;
        name.value= fname[0].toUpperCase()+fname.slice(1);
    }
    else
    {
      var name= document.forms[type]["firstname"];
      fname=name.value;
      name.value= fname[0].toUpperCase()+fname.slice(1);
    }

}
function lname_validation(type)
{

    var name= document.forms[type]["lastname"];
    lname=name.value;
    name.value= lname[0].toUpperCase()+lname.slice(1);

}

$(document).ready(function()
{

  
      $("#search-bar").keyup(function()
      {
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


    $("#edit").click(function()
    {

          $("#uploads_content").hide();
          $("#message_content").hide();
          $("#home_content").hide();
          $("#edit_profile").show();
          loadpost();
    });

    $("#home_button").click(function()
    {
        $("#uploads_content").hide();
        $("#message_content").hide();
        $("#home_content").show();
        $("#edit_profile").hide();
        loadpost();
    });


    $("#uploads_button").click(function()
    {
        $("#uploads_content").show();
        $("#message_content").hide();
        $("#home_content").hide();
        $("#edit_profile").hide();
    });


    $("#Messages_button").click(function()
    {
        $("#uploads_content").hide();
        $("#message_content").show();
        $("#home_content").hide();
        $("#edit_profile").hide();
    });

    
});


var loadFile = function(event,num) //for loding the image to display
{
    var output = document.getElementsByClassName('forpic');
    output[num].src = URL.createObjectURL(event.target.files[0]);
    output[num].onload = function() 
    {
        URL.revokeObjectURL(output[num].src) // free memory
    }
}

function phone_upload ()
          {    
              var type="Client";
              var Id= document.forms["serial"]["ID"].value;
              $.ajax({
                        url:'php/phone_number_load.php',
                        method:'post',
                        data:{ID:Id,ACCtype:type},
                        success: function(response)
                        {
                            $('#phonenumberdisplay').html(response);
                        }


              });

       
          }


          //to remove a phone number
          
function deletenumber (count)
            { var type= "Client";
              $.ajax(
                  {
                    url:"php/phone_number_load.php",
                    method:"post",
                    data:{phone_ID:count,ACCtype:type},
                    success:function(response)
                    {
              
                    }
            
                  })
             
              phone_upload ();
          }
var loadtable= setInterval(loadpost_table,2000);
var loadviews= setTimeout(loadpost,200);
var loadview= setInterval(loadpost,2000000);
var load_selection= setInterval(fill_selection_form,20000);

//for  activating  post
  function activate_post(post_ID)
  {

      const xhttp = new XMLHttpRequest();
      xhttp.onload = function() 
      {
      
      
      }
      xhttp.open("GET", "php/post_table.php?post_ID="+post_ID, true);
      xhttp.send();
      loadpost_table();
      loadpost();
  }
  

//for deactivating post
function deactivate_post(post_ID)
{

    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() 
    {
    
    
    }
    xhttp.open("GET", "php/post_table.php?Dpost_ID="+post_ID, true);
    xhttp.send();
    loadpost_table();
    loadpost();
}

//function Removing_post(post_ID)
function Remove_post(post_ID)
{
    var value =confirm("are you sure ?");
    if (value==true)
    {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() 
    {
    
    
    }
    xhttp.open("GET", "php/post_table.php?Removepost_ID="+post_ID, true);
    xhttp.send();
    loadpost_table();
    loadpost();
  }
  else
  {
    
  }
}

//function Stop post
function Stop_post(post_ID)
{
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() 
  {
  
  
  }
  xhttp.open("GET", "php/post_table.php?stoppost_ID="+post_ID, true);
  xhttp.send();
  loadpost_table();
  loadpost();
}
 
load_famous_account= setTimeout(load_accounts,200);

function load_accounts()
{

  $.ajax({

    url:'php/display_account.php',
    method:'post',
    data:{active:true},
    success: function(response)
    {
        $("#display_top_avc").html(response);
       
    }
  });

}


//for loading all post info into a table
function loadpost_table()
{
    var client_id= document.forms["serial"]["ID"].value;
            
    var element =document.getElementById("post-table");
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() 
    {
      element.innerHTML=this.responseText;
    
    }
    xhttp.open("GET", "php/post_table.php?ID="+client_id, true);
    xhttp.send();
    loadpost();
    fill_selection_form();

}
function loadpost()
{
    var client_id= document.forms["serial"]["ID"].value;
            
    var element =document.getElementById("post_view");
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() 
    {
      element.innerHTML=this.responseText;
    
    }
    xhttp.open("GET", "php/post_table.php?client_ID="+client_id, true);
    xhttp.send();

}
//for viewing profile  after clicking  the view button
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




//for loading all asset type in to selection
function fill_selection_form()
{
 
    $.ajax({

      url:'php/selection_fill_result.php',
      method:'post',
      data:{set:true},
      success: function(response)
      {
          $("#selection_for_asset").html(response);
        
      }
    });


}
//send button load
function send_button_update(id,type)
{
  var user_Id= document.forms["serial"]["ID"].value;
  var account_type=document.forms["serial"]["Account_type"].value+"-"+type;
  var reciver_type=type;
  
  $.ajax({

    url:'php/chat_loadder.php',
    method:'post',
    data:{
      reciverID:id,
      acctype:account_type,
      user_id:user_Id,
      reciver_type:reciver_type
      
    },
    success: function(response)
    {
        $("#send_button").html(response);
        $("#chat_view").modal();
    }
  });

}

function write_message()
{
  type=$("#reciver_type").val();
  var text_message= $("#usermsg").val();
  var filename= $("#usermsgs").val();
  var user_Id= document.forms["serial"]["ID"].value;
  //alert(filename);
  
  $.ajax({

    url:'php/chat_loadder.php',
    method:'post',
    data:{
      text_message_send:text_message,
      file_name:filename,
      Account_type:type,
      
      
      
    },
    success: function(response)
    {
      $("#usermsg").val("");
      read_Chat_log();
    }
  });
  
  

}

load_text=setInterval(read_Chat_log,200);
//read chat log
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


