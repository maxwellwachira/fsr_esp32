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
              <div class="col-lg-6 col-md-6 col-sm-12 mt-5 p-3  bg-light mb-5">
                   <form method="post" class="mt-3 ">
                      <?php echo $message; ?>
                       <?php echo $returnurl; ?>
                      
                       <div class="form-group d-flex justify-content-center text-black mt-3 font-weight-bold">
                        Sign In
                       </div>
                       <div id="op"></div>
                      <div class="form-group d-flex justify-content-center">
                        <div class="input-group-prepend bg-white">
                          <button class="input-button" disabled="true"><i class="far fa-envelope"></i></button>
                        </div>   
                          <input type="email" name="email"  class="form-control" id = "email" placeholder="Enter your email"> 
                          <span class="equallizer"></span> 
                      </div>  

                      <div class="form-group d-flex justify-content-center">
                        <div class="input-group-prepend bg-white">
                          <button class="input-button" disabled="true"><i class="fas fa-unlock-alt"></i></button>
                        </div> 
                          <input type="password" name="password" id = "password" class="form-control" placeholder=" Enter Password">
                          <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                      </div>
                      <div class="form-group text-center mt-3">
                          <a class="explore-text-sm" href="/forgot-password"> Forgot password?</a> 
                      </div>

                      <div class="form-group text-center mt-3">
                        <button type="submit" id="login_submit" class="login-button animated pulse infinite" ><i class='fa fa-check'></i> Sign In</button>
                    </div>
                    <div class="form-group text-center mt-3" >
                        <a id="" href="/sign-up" class="explore-text-sm">or register here</a>
                    </div>

                  </form> 
              </div>
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
      function login_submit(){
  
        // pull in values/variables
        var email = $("#email").val();
        var password = $("#password").val();
        var csrf_token = $("#csrf").val();
        var returnurl = $("#returnurl").val();
        //console.log(returnurl);

        //check if any of the variable is empty
        if (!email || !password) {
          $('#op').html('<div class="alert alert-danger animated bounce" role="alert"><i class="fa fa-warning animated swing infinite"></i> Please fill out all sections</div>');
        } 
        else {

          $('#op').html('');

          $.ajax({  
              url:"/login",  
              method:"POST",  
              data:{
                csrf_token:csrf_token,
                email:email,
                password:password,
                returnurl:returnurl

              },
              dataType: 'text', 
              success:function(data)  
              {  
                  //console.log(data);
                  var response = JSON.parse(data);
                  //console.log(response);
                  if (response.message !== 'success') {
                  
                     $('#op').html('<div class="alert alert-danger animated bounce" role="alert"><i class="fa fa-warning animated swing infinite"></i> ' + response.message +'</div>');
                                 
                    // clear the fields

                  }else if(response.message === 'success'){
                    if(!returnurl){
                       window.location = '/';
                      }else {
                         window.location = returnurl;
                      }
                  }
                  
              },
              error: function (jqXhr, textStatus, errorThrown) {
                  
                  $('#op').html('<div class="alert alert-danger animated bounce" role="alert"><i class="fa fa-warning animated swing infinite"></i> Contact system Admin. System error</div>');
                  console.log(jqXhr + " || " + textStatus + " || " + errorThrown);
              } 
          });
        }
      }
      $(document).ready(function() {

       $('form').submit(function(event){
        event.preventDefault();
        login_submit();
        return false;
       });

    });
    </script>

</html>
