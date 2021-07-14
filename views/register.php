<!DOCTYPE html>
<html lang="en">
  <head>
   
   <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- Site Metas --> 
    <meta name="author" content="maxwellwachira67@gmail.com +254703519593">


    <!--icon-->
    <link rel="icon" href="assets/img/favicon/favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="assets/img/favicon/favicon.ico" type="image/x-icon"/>

    <!-- Font Awesome CSS -->
    <script src="https://kit.fontawesome.com/91ae273ed7.js" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/3rdparties/bootstrap/css/bootstrap.css">

    <!--animate-->
    <link rel="stylesheet" type="text/css" href="assets/3rdparties/animate/animate.css">

    <!--pogo-slider-->
    <link rel="stylesheet" href="assets/3rdparties/pogoslider/pogo-slider.min.css">


    <!--custom css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <title>FSR ESP32</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg mb-0">
      <a class="navbar-brand text-white" href="#">FSR ESP32</a>
    </nav>
    <div class="bg-light h-100">
     <div class="container">
          <div class = "row animated bounce" >
            <div class="none col-lg-3 col-md-3 col-sm-12 mt-5 mt-5"></div>
              <div class="col-lg-6 col-md-6 col-sm-12 mt-3 mb-2">
                   <form method="post" class="mt-3" id="register-form">
                        <?php echo $message;?>
                        <?php echo $ref;?>
                       <div class="form-group d-flex justify-content-center text-black mt-3 font-weight-bold">
                        Sign Up
                       </div>
                        <div id="response"></div>
                       <label class="ml-5 black-text-sm">First Name</label>
                      <div class="form-group d-flex justify-content-center">
                        <div class="input-group-prepend bg-white">
                          <button class="input-button" disabled="true"><i class="fas fa-user"></i></button>
                        </div>   
                          <input type="text" name="firstname"  class="form-control" id = "firstname" placeholder="John"> 
                          <span class="equallizer"></span> 
                      </div> 

                      <label class="ml-5 black-text-sm">Last Name</label>
                      <div class="form-group d-flex justify-content-center">
                        <div class="input-group-prepend bg-white">
                          <button class="input-button" disabled="true"><i class="fas fa-user"></i></button>
                        </div>   
                          <input type="text" name="secondname"  class="form-control" id = "secondname" placeholder="Doe"> 
                          <span class="equallizer"></span> 
                      </div>  

                      <label class="ml-5 black-text-sm">Email</label>
                      <div class="form-group d-flex justify-content-center">
                        <div class="input-group-prepend bg-white">
                          <button class="input-button" disabled="true"><i class="far fa-envelope"></i></button>
                        </div>   
                          <input type="email" name="email"  class="form-control" id = "email" placeholder="example@site.com"> 
                          <span class="equallizer"></span> 
                      </div>

                      <label class="ml-5 black-text-sm">Password</label>
                      <div class="form-group d-flex justify-content-center">
                        <div class="input-group-prepend bg-white">
                          <button class="input-button" disabled="true"><i class="fas fa-unlock-alt"></i></button>
                        </div> 
                          <input type="password" name="password" id = "password" class="form-control" placeholder=" Enter Password">
                          <span toggle="#password-field" id="toggle-password" class="fa fa-fw fa-eye field-icon toggle-password"></span><br>
                      </div>
                       <small class="form-text text-muted ml-5 mt-0">* Password Must be atleast 8 (eight) Characters</small>

                      <div class="form-check mt-3 ml-5">
                        <input type="checkbox" class="form-check-input" value="terms">
                        <label class="form-check-label" >Agree to <a href="/terms-and-conditions" class="explore-text-sm">Terms and Conditions</a></label>
                      </div>


                      <div class="form-group text-center mt-3">
                        <button type="submit" id="register_submit" class="login-button animated pulse infinite" ><i class='fa fa-check'></i>Sign Up</button>
                    </div>
                  
                    <div class="form-group text-center mt-3" >
                        <a id="" href="/" class="explore-text-sm">or Sign In here</a>
                    </div>

                  </form> 
              </div>
          </div>
      </div> 
    </div>
 
    <script src="assets/3rdparties/jquery/jquery.js"></script> 
    <script src="assets/3rdparties/bootstrap/js/bootstrap.js"></script>

    <script type="text/javascript">
      $("#toggle-password").click(function() {

        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $("#password").attr("type");
        if (input == "password") {
          $("#password").attr("type", "text");
        } else {
          $("#password").attr("type", "password");
        }
      });
      $("#toggle-confirmPassword").click(function() {

        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $("#confirmPassword").attr("type");
        if (input == "password") {
          $("#confirmPassword").attr("type", "text");
        } else {
          $("#confirmPassword").attr("type", "password");
        }
      });

     

      
      function clear_register_field() {
          $("#firstname").val('');
          $("#secondname").val('');
          $("#phonenumber").val('');
          $("#email").val('');
          $("#password").val('');
          
      }


      function register_submit(){
        
        // pull in values/variables
        var firstname = $("#firstname").val();
        var csrf_token = $("#csrf").val();
        var secondname = $("#secondname").val();
        var phonenumber = $("#phonenumber").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var ref = $('#ref').val();
        var confirmPassword = password; 
        var terms = $('input[type="checkbox"]:checked').val();
       
       
        //console.log(background);
        //check if any of the variable is empty
        if (!firstname || !secondname  || !email || !password) {
          $('#response').html('<div class="alert alert-danger animated bounce" role="alert"><i class="fa fa-warning animated swing infinite"></i> Please fill out all sections</div>');
        } 
        else {

            if (password != confirmPassword) {

                $('#response').html('<div class="alert alert-danger animated bounce" role="alert"><i class="fa fa-warning animated swing infinite"></i> Passwords do not match</div>');

              } else {

                if (Number(password.length) < 8){

                  $('#response').html('<div class="alert alert-danger animated bounce" role="alert"><i class="fa fa-warning animated swing infinite"></i> Password Must be atleast 8 characters</div>');

                }else {

                  if(!terms){
                    $('#response').html('<div class="alert alert-danger animated bounce" role="alert"><i class="fa fa-warning animated swing infinite"></i>You have to agree to Terms and Conditions</div>');
                  }else{
                   
                    $('#response').html('');

                    $.ajax({  
                        url:"/register",  
                        method:"POST",  
                        data:{
                          csrf_token:csrf_token,
                          firstname:firstname,
                          secondname:secondname,
                          email:email,
                          phonenumber:phonenumber,
                          password:password,
                          confirmPassword:confirmPassword,
                          ref:ref     
                        },
                        dataType: 'text', 
                        success:function(data)  
                        {  

                            //console.log(data);
                            var response = JSON.parse(data);
                            console.log(response);
                            if (response.message == 'success') {
                            
                              $('#response').html('<div class="alert alert-success animated bounce" role="alert"><i class="fa fa-check animated swing infinite"></i>Sign Up Success. Click <a href = "/">Here to Sign In</a> </div>');
                              
                              // clear the fields
                              clear_register_field();

                            } else {
                              $('#response').html('<div class="alert alert-danger animated bounce" role="alert"><i class="fa fa-warning animated swing infinite"></i> '+response.message +'</div>');
                              
                            }
                            
                        },
                        error: function (jqXhr, textStatus, errorThrown) {
                            
                            $('#response').html('<hr><div class="alert alert-danger animated bounce" role="alert"><i class="fa fa-warning animated swing infinite"></i> Contact system Admin. System error</div>');
                            //console.log(jqXhr + " || " + textStatus + " || " + errorThrown);
                        } 
                    });
                  }

                }

              } 
          }
        }

        $(document).ready(function() {

          $('#register-form').submit(function(event){
            event.preventDefault();            
              register_submit();  
              return false;    
            });
      });
    
    </script>
</html>
