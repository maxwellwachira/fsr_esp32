<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="dannduati2@gmail.com +254723060846">
    <title>FSR ESP32</title>
   

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/3rdparties/bootstrap/css/bootstrap.css">
  
    <script src="assets/3rdparties/jquery/jquery.js"></script> 
    <script src="assets/3rdparties/bootstrap/js/bootstrap.js"></script>

    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.7.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.7.1/firebase-database.js"></script>

    <!--chart js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.1/chart.min.js" integrity="sha512-5vwN8yor2fFT9pgPS9p9R7AszYaNn0LkQElTXIsZFCL7ucT8zDCAqlQXDdaqgA1mZP47hdvztBMsIoFxq/FyyQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

      <!--custom css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <style type="text/css">
        body {
            font: 15px/1.5 'Open Sans', Roboto;
            padding: 0;
            margin: 0;

        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;

        }
        #graph .container canvas{
            max-height: 300px;
            background: #ECEFF3;
        }

        #graph h2{
          font-weight: 5px;
          text-align: center;  
        }

        #patients .container{
            text-align: center;
            min-height: 600px;
        }

        #patients button{
            display: inline-block;
            min-width: 400px;
            margin: 10px;
        }

        #bottom-patient .container{
            margin-top: 10px;
            text-align: center;
        }

    </style>
    
</head>

<body>
     <nav class="navbar navbar-expand-lg mb-0">
            <a class="navbar-brand text-white" href="/">FSR ESP32</a>
    </nav>
    <section id="heading">
        <div class="container">
            <!--<h1> Welcome Physiotherapist</h1>-->
            <h2 class="mt-3">FSREsp32 Webapp</h2>
        </div>
    </section>
    <!--
    <section id="patients">
        <div class="container">
            <h2>Please select the data you want to view</h2>
            
            <button type="button" class="btn btn-primary btn-lg btn-block">Patient1</button>
            <button type="button" class="btn btn-primary btn-lg btn-block">Patient2</button>
            <button type="button" class="btn btn-primary btn-lg btn-block">Patient3</button>
            <button type="button" class="btn btn-primary btn-lg btn-block">Patient4</button>
            <button type="button" class="btn btn-primary btn-lg btn-block">Patient5</button>
            <button type="button" class="btn btn-primary btn-lg btn-block">Patient6</button>
            <button type="button" class="btn btn-primary btn-lg btn-block">Combined</button>
        </div>
        
    </section>
    -->
    <section id="graph">
        <div class="container">
            <h2>Patient 1 data</h2>
            <p>Reps Completed: <span id="reps1">0</span></p>
            <canvas id="sensor1" width="200" height="200"></canvas>
            <h2>Patient 2 data</h2>
            <p>Reps Completed: <span id="reps1">0</span></p>
            <canvas id="sensor2" width="200" height="200"></canvas>
            <h2>Patient 3 data</h2>
            <p>Reps Completed: <span id="reps1">0</span></p>
            <canvas id="sensor3" width="200" height="200"></canvas>
            <h2>Patient 4 data</h2>
            <p>Reps Completed: <span id="reps1">0</span></p>
            <canvas id="sensor4" width="200" height="200"></canvas>
            <h2>Patient 5 data</h2>
            <p>Reps Completed: <span id="reps1">0</span></p>
            <canvas id="sensor5" width="200" height="200"></canvas>
            <h2>Patient 6 data</h2>
            <p>Reps Completed: <span id="reps1">0</span></p>
            <canvas id="sensor6" width="200" height="200"></canvas>
        </div>        
    </section>
    <script  src="assets/js/graphs.js"></script>

</body>

</html>