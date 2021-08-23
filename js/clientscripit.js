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
              $.ajax({

                      url:'php/search_result.php',
                      method:'post',
                      data:{query:search_text},
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
    });

    $("#home_button").click(function()
    {
        $("#uploads_content").hide();
        $("#message_content").hide();
        $("#home_content").show();
        $("#edit_profile").hide();
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
var loadtable= setTimeout(loadpost_table,200);
var loadview= setTimeout(loadpost,200);

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

