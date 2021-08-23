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


      $("#valuations_button").click(function()
      {
          $("#uploads_content").hide();
          $("#message_content").hide();
          $("#home_content").hide();
          $("#edit_profile").hide();
          $("#valuation_content").show();
        
        loadpost();
      });

      $("#edit").click(function()
      {
        $("#uploads_content").hide();
        $("#message_content").hide();
        $("#home_content").hide();
        $("#edit_profile").show();
        $("#valuation_content").hide();
        loadpost();
      });

      $("#home_button").click(function()
      {
          $("#uploads_content").hide();
          $("#message_content").hide();
          $("#home_content").show();
          $("#edit_profile").hide();
          $("#valuation_content").hide();
          loadpost();
      });


  


      $("#Messages_button").click(function()
      {
        $("#uploads_content").hide();
        $("#message_content").show();
        $("#home_content").hide();
        $("#edit_profile").hide();
        $("#valuation_content").hide();
        loadpost();
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
var loadtable= setTimeout(loadpost_table,200);
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
    if(con_value==true)
    {
        $.ajax({
                url:"php/upload_valuation.php",
                method:"post",
                data:{valuation_ID:ID},
                success:function(response)
                {
                  loadpost_table();
                  count_valuation();
                }


              });
    }
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

                }


             });

       
 }

//to remove a phone number
function deletenumber (count)
{
    var type= document.forms["serial"]["Account_type"].value;
    $.ajax({
      
            url:"php/phone_number_load.php",
            method:"post",
            data:{phone_ID:count,ACCtype:type},
            success:function(response)
            {

            }

        });
    
      phone_upload ();
}

var loadview= setTimeout(loadpost,200);

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
      url:'php/post_view.php',
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








