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


    <!--custom css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <title>FSR ESP32</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg mb-0">
            <a class="navbar-brand text-white" href="/">FSR ESP32</a>
    </nav>
     <div class="container">
           <div class = "row animated bounce" >
              <div class="none col-lg-3 col-md-3 col-sm-12 mt-5 mt-5"></div>
              <div class="col-lg-6 col-md-6 col-sm-12 mt-5  p-3 mb-5">
                   <form method="post" class="mt-3 ">
                    
                    <?php echo $message;?>
                    <div id="op"></div>
                      <div class="form-group">
                        <div class="mb-5 mt-3">
                           <label class="ml-5 black-text-sm">Password</label>
                              <div class="form-group d-flex justify-content-center">
                                <div class="input-group-prepend bg-white">
                                  <button class="input-button" disabled="true"><i class="fas fa-unlock-alt"></i></button>
                                </div> 
                                  <input type="password" name="password" id = "password" class="form-control" placeholder=" Enter Password">
                                  <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                              </div>

                              <label class="ml-5 black-text-sm">Confirm Password</label>
                              <div class="form-group d-flex justify-content-center">
                                <div class="input-group-prepend bg-white">
                                  <button class="input-button" disabled="true"><i class="fas fa-unlock-alt"></i></button>
                                </div> 
                                  <input type="password" name="confirmPassword" id = "confirmPassword" class="form-control" placeholder=" Confirm Password">
                                  <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-confirmPassword"></span>
                              </div>
                              <div class="d-flex justify-content-center">
                                <button type="submit" class="login-button mt-3" id="send_button" style="width:80%">Get New Password</button>
                              </div>
                        </div>
                      </div>
                  </form> 
              </div>
          </div>
      </div> 
 
 
  <script src="assets/3rdparties/jquery/jquery.js"></script> 
    <script src="assets/3rdparties/bootstrap/js/bootstrap.js"></script>

    <script type="text/javascript">

      $(".toggle-password").click(function() {

        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $("#password").attr("type");
        if (input == "password") {
          $("#password").attr("type", "text");
        } else {
          $("#password").attr("type", "password");
        }
      });
      $(".toggle-confirmPassword").click(function() {

        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $("#confirmPassword").attr("type");
        if (input == "password") {
          $("#confirmPassword").attr("type", "text");
        } else {
          $("#confirmPassword").attr("type", "password");
        }
      });
     function clear_register_field() {
        $("#password").val('');
        $("#confirmPassword").val('');
      }


    function register_submit(){
      
      // pull in values/variables
      var password = $("#password").val();
      var confirmPassword = $("#confirmPassword").val(); 
      var rst_token = $("#rst_token").val();

      //check if any of the variable is empty
      if(!password || !confirmPassword) {
        $('#op').html('<div class="alert alert-danger animated bounce" role="alert"><i class="fa fa-warning animated swing infinite"></i>Enter all fields</div>');
        clear_register_field();
      } 
      else {

        if(password != confirmPassword){

          $('#op').html('<div class="alert alert-danger animated bounce" role="alert"><i class="fa fa-warning animated swing infinite"></i> Password does no match confirm Password</div>');

        }else{

          $('#op').html('');

          $.ajax({  
              url:"/password-reset", 
              method:"POST",  
              data:{
                password:password,
                rst_token:rst_token
              },
              dataType: 'text', 
              success:function(data)  
              {  
                  console.log(data);
                  var response = JSON.parse(data);
                  //console.log(response);
                  if (response.message !== 'success') {
                    
                     $('#op').html('<div class="alert alert-danger animated bounce" role="alert"><i class="fa fa-warning animated swing infinite"></i> ' + response.message +'</div>');
                    

                  }else if(response.message === 'success'){
                    // clear the fields
                    $('#op').html('<div class="alert alert-success animated bounce" role="alert"><i class="fa fa-tick"></i> Your password has been reset succesfully. <br>Click here to log in to your account <a href="/">Log in</a> </div>');
                      //$('#remove-form').html('');
                      clear_register_field();
                  }
                  
              },
              error: function (jqXhr, textStatus, errorThrown) {
                  
                  $('#op').html('<div class="alert alert-danger animated bounce" role="alert"><i class="fa fa-warning animated swing infinite"></i> Contact system Admin. System error</div>');
                  console.log(jqXhr + " || " + textStatus + " || " + errorThrown);
              } 
          });
        }
      }
    }


    $(document).ready(function() {

       $('form').submit(function(event){
        event.preventDefault();
        register_submit();
        return false;
       });

    }); 
    </script>
</html>