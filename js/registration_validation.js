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



function validation_Cphone (type,count)
{
      var buttons=document.getElementsByClassName("signups");
      var phnumber= document.forms[type]["phonenumber"].value;
      if(isNaN(phnumber))
      {
          var x=document.getElementsByClassName("phone_location");
          x[count].style.display="block";
          x[count].innerHTML="enter a valid number";
          buttons[count].disabled = true;
      }
      else
      {
          var x=document.getElementsByClassName("phone_location");
          x[count].style.display="none";
          buttons[count].disabled = false;
      }

}
function validation_Cpassword(type,count)
{
    var repassword= document.forms[type]["repassword"].value;
    var password= document.forms[type]["password"].value;
    var lowerCaseLetters = /[a-z]/g;
    var upperCaseLetters = /[A-Z]/g;
    var numbers = /[0-9]/g;
    var buttons=document.getElementsByClassName("signups");


        if(repassword.match(password))
        {
            var x=document.getElementsByClassName("repass_location");
            x[count].style.display="none";
            buttons[count].disabled = false;
           


        }
        else
        {
             var x=document.getElementsByClassName("repass_location");
             x[count].style.display="block";
             x[count].innerHTML="password doesn't match"; 
             buttons[count].disabled = true;
        }

        
        if(password.length<6)
        {
             var x=document.getElementsByClassName("pass_location");
             x[count].style.display="block";
             x[count].innerHTML="password must at least be 6  characters long";
             buttons[count].disabled = true;
        }
        else
        {
            
             var x=document.getElementsByClassName("pass_location");
             x[count].style.display="none";
             buttons[count].disabled = false;
            if(password.match(numbers))
            {
                 var x=document.getElementsByClassName("pass_location");
                 x[count].style.display="none";
                 buttons[count].disabled = false;
                if(password.match(lowerCaseLetters))
                {
                     var x=document.getElementsByClassName("pass_location");
                     x[count].style.display="none";
                     buttons[count].disabled = false;
                      if(password.match(upperCaseLetters))
                    {
                         var x=document.getElementsByClassName("pass_location");
                         x[count].style.display="none";
                         buttons[count].disabled = false;
                    }
                    else
                    {
                         var x=document.getElementsByClassName("pass_location");
                         x[count].style.display="block";
                         x[count].innerHTML="password must contain upper case letters";
                         buttons[count].disabled = true;
                    }
                }
                else
                {
                     var x=document.getElementsByClassName("pass_location");
                     x[count].style.display="block";
                     x[count].innerHTML="password must contain lower case letters";
                     buttons[count].disabled = true;
                }
            }
            else
            {
                 var x=document.getElementsByClassName("pass_location");
                 x[count].style.display="block";
                 x[count].innerHTML="password must contain numbers";
                 buttons[count].disabled = true;
            }
        }
    
       

}


function validation_Cemail(type,count)
{   var buttons=document.getElementsByClassName("signups");
    var email= document.forms[type]["email"].value;
    var atposition=email.indexOf("@");  
    var dotposition=email.lastIndexOf(".");  
    if (atposition<1 || dotposition<atposition+2 || dotposition+2>=email.length)
    {  
        var x=document.getElementsByClassName("email_location");
        x[count].style.display="block";
        x[count].innerHTML="Email address is Invalid  enter a valid email";
        buttons[count].disabled = true;
    }
    else
    {
       var x=document.getElementsByClassName("email_location");
       x[count].style.display="none";
       buttons[count].disabled = false;
     
    }
}  

function validation_username(type,count)
{   
    var buttons=document.getElementsByClassName("signups");
    var username= document.forms[type]["username"].value;
    var x=document.getElementsByClassName("username_location");
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
     if(this.responseText=="valid") 
     {
        x[count].style.display="none";
        buttons[count].disabled = false;
     }
      else if (this.responseText=="invalid")
      {
        x[count].style.display="block";
        x[count].innerHTML="username is already taken pic another";
        buttons[count].disabled = true;
      }
    }
      
    xhttp.open("GET", "php/username_validation.php?username="+username, true);
    xhttp.send();

}

function validation_username_edit(type,count)
{    
    var buttons=document.getElementsByClassName("signups");
    var Editusername= document.forms[type]["username"].value;
    var x=document.getElementsByClassName("username_location");
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
     if(this.responseText=="valid") 
     {
        x[count].style.display="none";
        buttons[count].disabled = false;
     }
      else if (this.responseText=="invalid")
      {
        x[count].style.display="block";
        x[count].innerHTML="username is already taken pic another";
        buttons[count].disabled = true;
      }
    }
      
    xhttp.open("GET", "php/username_validation.php?editusername="+Editusername, true);
    xhttp.send();

}

