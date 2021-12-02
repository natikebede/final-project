<!--forgot password displaymodal-->
<div class ="modal login_page fade rounded mt-5  " id="forgot_password">
  <div class="modal-dialog   modal-xl modal-dialog-centered">
    <div class="modal-content">
      
      <div class="modal-body rounded bg-light">
        <div class=" container  mxy-2 fade show   p-4 mb-4 bg-light rounded">
          <button type="button bg-dark" class="close" data-dismiss="modal">&times;</button>
          <h3 class=" display-3 font-weight-bolder  primary text-center w-100 logo "style="color:#012970;"> forgot password </h3>
          <form name="reset_password"  class =" py-3 " method ="POST" action="php/reset_password.php" enctype="multipart/form-data" >
            <div class="input-group mx-auto  my-5">
              <label for="city" class="font-weight-bolder">Enter the email  you registered with:</label>
              <input type="email" class=" mx-auto form-control w-100 " onblur='validation_Cemail("reset_password",3)'  placeholder="Enter email" id="coemail" name="email" required>
              <span id="coemail_location"class="email_location btn bg-danger fa fa-warning py text-white my-2 font-weight-bolder" style="display :none;"></span>
          
            </div>
            <div class="row p-3">
              <p> <label class="font-weight-bolder">Your Type:</label></p>
              <select name="account_type" class="custom-select w-100">
                <option selected style=" display:none;"> select type</option>
                <option value="Client">Client</option>
                <option value="Broker">Broker</option>
                <option value="AVC">AVC</option>
                
              </select>
              
             </div>
                    
          <div class ="row">
              <input type ="reset" value ="reset" style="width: 100px;" width="100px"name= "rest" class="mx-auto btn btn-primary mx-0 my-4">
              <input type ="submit" name="submit_email" value=" Send confirmation"   class="singups mx-auto btn btn-success mx-0 my-4">
          </div>
        </form>
      </div>

      </div>
        </div>

    
    
  </div>
 

</div>