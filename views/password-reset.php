<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-P90VYKNMTL"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-P90VYKNMTL');
    </script>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <!-- Site Metas --> 
    <meta name="description" content="Beyond Grades is an online learning and teaching Academy with over 20 courses. Our main focus is IoT ranging from PCB design to firmware and web development. Learn PCB design, Firmware programming, web development and more">
    <meta name="title" content="Online Courses - Anytime, Anywhere | BeyondGrades">
    <meta name="keywords" content="Internet of Things, IoT, PCB design courses, Programming Courses, AI course, High Frequency PCB design, Free technology courses, Web development courses, 2021,">
    <meta name="author" content="maxwellwachira67@gmail.com +254703519593">


   <!--icon-->
    <link rel="icon" href="assets/img/favicon/favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="assets/img/favicon/favicon.ico" type="image/x-icon"/>

    <!-- Font Awesome CSS -->
    <script src="https://kit.fontawesome.com/91ae273ed7.js" crossorigin="anonymous"></script>

    <!-- Montserrat -->
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Montserrat'>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!--animate-->
    <link rel="stylesheet" type="text/css" href="assets/3rdparties/animate/animate.css">
    <!--custom css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <title>Beyond Grades</title>
  </head>
  <body>
    <?php
      session_start();
      if($GLOBALS['live'] == true){
        $dotClass = '<span class="red-dot"></span>';
      }else{
        $dotClass = '<span class="grey-dot"></span>';
      }
      if($_SESSION["subscription"] == true){
        $subscription = '<p class = "text-success subscribe-text">Subscription Active</p>';
       }else{
         $subscription = '<p class = "text-warning subscribe-text">No active Subscription</p>';
       }
      if($_SESSION["loggedin"] == true){
        $username = $_SESSION['name'];
        $initials = explode(' ', $username);
        $initials = $initials[0][0].$initials[1][0];  
        echo '
          <nav class="navbar navbar-expand-lg mb-0">
            <a class="navbar-brand" href="/"><img src="assets/img/Beyond Grades.svg" height="100px" width="150px" alt="Responsive image"></a>
            <button class="navbar-toggler text-white" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <i class="fas fa-bars fa-lg"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto align-bottom">
                <li class="nav-item">
                  <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/live">'.$dotClass.' Live</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/all-courses">All Courses</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/advanced-courses">Advanced Courses</a>
                </li>
               <li class="nav-item">
                  <a class="nav-link" href="/pro">Pro</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/about">About</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Chats</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/shop">Shop</a>
                </li>
                 <li class="nav-item dropleft">
                  <a class="nav-link  user" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    '.$initials.'
                  </a>
                    <div class="dropdown-menu dropdown-menu-nav " aria-labelledby="navbarDropdown">
                    <ul id="parent">
                        <p class = "user-big">'.$initials.'</p>
                        <li><b>'.$_SESSION['name'].'</b><br><span class = "small-text">'.$_SESSION['email'].'</span></li>
                        '.$subscription.'
                    </ul>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Account Settings</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Payment History</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Wishlist</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Messages</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Edit Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">My Referrals</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/logout?returnurl=/">log Out</a>
                  </div>
                </li>
              </ul>
            </div>
          </nav>';

      } else{
        echo '
          <nav class="navbar navbar-expand-lg mb-0">
            <a class="navbar-brand" href="/"><img src="assets/img/Beyond Grades.svg" height="100px" width="150px" alt="Responsive image"></a>
            <button class="navbar-toggler text-white" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <i class="fas fa-bars fa-lg"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto align-bottom">
                <li class="nav-item">
                  <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/live">'.$dotClass.' Live</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/all-courses">All Courses</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/advanced-courses">Advanced Courses</a>
                </li>
               <li class="nav-item">
                  <a class="nav-link" href="/pro">Pro</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/about">About</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/shop">Shop</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link auth-sign-in" href="/sign-in">Sign in</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link auth-sign-up" href="/sign-up">Sign up</a>
                </li>
              </ul>
            </div>
          </nav>';
      } 
    ?>
    <div class="bg2">
     <div class="container">
           <div class = "row animated bounce" >
              <div class="none col-lg-3 col-md-3 col-sm-12 mt-5 mt-5"></div>
              <div class="col-lg-6 col-md-6 col-sm-12 card mt-5 shadow-lg p-3  bg-info mb-5 card-auth" style="box-shadow: 0px 0px 20px  #0C0C0C !important;margin:5px;">
                <img src="assets/img/logo.png" class="card-img-top" alt="logo">
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
                                  <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                              </div>
                              <div class="d-flex justify-content-center">
                                <button type="submit" class="btn-blue" id="send_button" style="width:80%">Get New Password</button>
                              </div>
                        </div>
                      </div>
                  </form> 
              </div>
          </div>
      </div> 
    </div>
    
    <?php include_once 'layouts/footer.php'; ?>
 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <script type="text/javascript">
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
                    $('#op').html('<div class="alert alert-success animated bounce" role="alert"><i class="fa fa-tick"></i> Your password has been reset succesfully. Click here to log in to your account <a href="/login">Log in</a> </div>');
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