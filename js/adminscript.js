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




// j-query for search bar 
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

  //when the valuation button is clicked in the top naviagtion

  


    //when the eidt  button is clicked
    $("#edit").click(function()
    {
      $("#edit_profile").show();
      $('#post_display').hide();
      $('#register_Admin').hide();
      $("#deprate_display").hide();
      $("#license_request_display").hide();
      $("#Accounts_display").hide();
    
    });


  // when the register admin button is clicked
    $("#register_admin_button").click(function()
    {
        $('#register_Admin').show();
        $("#edit_profile").hide();
        $('#post_display').hide();
        $("#deprate_display").hide();
        $("#license_request_display").hide();
        $("#Accounts_display").hide();
    });


    //when the  post button is clicked
    $("#post_button").click(function()
    {
      $('#post_display').show();
      $('#register_Admin').hide();
      $("#edit_profile").hide();
      $("#deprate_display").hide();
      $("#license_request_display").hide();
      $("#Accounts_display").hide();
    
  
    });

    //when the dep button is clicked
    $("#dep_button").click(function()
    {

          $("#deprate_display").show();
          $('#post_display').hide();
          $('#register_Admin').hide();
          $("#edit_profile").hide();
          $("#license_request_display").hide();
          $("#Accounts_display").hide();
    });

    //when the license button is clicked
    $("#license_button").click(function()
    {
        $("#license_request_display").show();
        $("#deprate_display").hide();
        $('#post_display').hide();
        $('#register_Admin').hide();
        $("#edit_profile").hide();
        $("#Accounts_display").hide();
    });

    //when the Account button is clicked
    $("#account_button").click(function()
    {
        $("#Accounts_display").show();
        $("#license_request_display").hide();
        $("#deprate_display").hide();
        $('#post_display').hide();
        $('#register_Admin').hide();
      $("#edit_profile").hide();
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
var loadtable= setTimeout(loadpost_table,200);
var loadtable= setInterval(loadpost_table,20000);

//load valuation post table
function loadpost_table()
{
  
  var Account_type= document.forms["serial"]["Account_type"].value;
    $.ajax({
      url:"php/admin_post_view.php",
      method:"post",
      data:{load_post_table:true},
      success:function(response)
      {
       $("#post_table_display").html(response)
       
      }
     
    });

}
//for loading license request
function load_license_table()
{
  
  var Account_type= document.forms["serial"]["Account_type"].value;
    $.ajax({
      url:"php/admin_license_view.php",
      method:"post",
      data:{load_license_table:true},
      success:function(response)
      {
       $("#license_request_display-table").html(response)
       
      }
     
    });

}




var value=setTimeout(phone_upload,200);
var load=setTimeout(load_Dep_rate,200);
 load=setInterval(load_Dep_rate,20000);
var loads=setTimeout(load_license_table,200);
 loads=setInterval(load_license_table,20000);

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
                    
                    }
                

            });

       
          }

       

//to remove a phone number
function deletenumber (count)
{
  var type= document.forms["serial"]["Account_type"].value;
  $.ajax(
      {
        url:"php/phone_number_load.php",
        method:"post",
        data:{phone_ID:count,ACCtype:type},
        success:function(response)
        {

        }

      });
   
    phone_upload ();
}

//for suspending post
function suspend_post (count)
{
    var type= document.forms["serial"]["Account_type"].value;
    var Id= document.forms["serial"]["ID"].value;
    $.ajax(
        {
          url:"php/admin_post_view.php",
          method:"post",
          data:{post_ID:count,Admin_ID:Id},
          success:function(response)
          {
            loadpost_table();
          }

        });
   
    
}
//activation for post
function activate_post (count)
{
    var type= document.forms["serial"]["Account_type"].value;
    var Id= document.forms["serial"]["ID"].value;
    $.ajax(
        {
          url:"php/admin_post_view.php",
          method:"post",
          data:{Apost_ID:count},
          success:function(response)
          {
            loadpost_table();
          }

        });
    
  
}
//removal of a post
function deactivate_post(count)
{
    var type= document.forms["serial"]["Account_type"].value;
    var Id= document.forms["serial"]["ID"].value;
    var value =confirm("are you sure ?");
    if (value==true)
    {
      $.ajax(
          {
            url:"php/admin_post_view.php",
            method:"post",
            data:{Dpost_ID:count},
            success:function(response)
            {
              loadpost_table();
            }

            });
      }
  else
        {

        }
    
    
}
// for loading all the dep rate into aTable
function load_Dep_rate ()
          {    
              
              $.ajax({
                    url:'php/dep_rate_manage.php',
                    method:'post',
                    data:{load:true},
                    success: function(response)
                    {
                      $('#dep_rate_table').html(response);
                    
                    }
                  

              });

       
          }

//removal of a dep rate
function Remove_Dep(count)
{
    var type= document.forms["serial"]["Account_type"].value;
    var Id= document.forms["serial"]["ID"].value;
    var value =confirm("are you sure ?");
    if (value==true)
    {
      $.ajax(
          {
            url:"php/dep_rate_manage.php",
            method:"post",
            data:{Asset_ID:count},
            success:function(response)
            {
              load_Dep_rate ();
            }

          });
      }
  else
        {

        }
   
    
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


//function for approving license
function Approve_License(license_id,avc_id)
{

  var Id= document.forms["serial"]["ID"].value;
  $.ajax(
            {
              url:"php/admin_license_view.php",
              method:"post",
              data:{License_ID:license_id,Admin_ID:Id,AVC_ID:avc_id},
              success:function(response)
              {
                load_license_table();
              }

            });
  }

//function for deny approval for license
  function Denay_License (license_id,avc_id)
  {
  
    var Id= document.forms["serial"]["ID"].value;
    $.ajax(
              {
                url:"php/admin_license_view.php",
                method:"post",
                data:{DLicense_ID:license_id,Admin_ID:Id,AVC_ID:avc_id},
                success:function(response)
                {
                  load_license_table();
                }
  
              });
    }


    //function for account select type  to display all  
  function account_display (type)
  {
  
  
    $.ajax(
              {
                url:"php/manage_account.php",
                method:"post",
                data:{account_type:type},
                success:function(response)
                {
                 
                  $("#Account_display-table").html(response);
                }
  
              });
    }
