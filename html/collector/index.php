<?php require_once('setup.php'); ?>

<!DOCTYPE HTML>

<html>

  <head>

    <title>Viand Collector</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">

    <link rel="shortcut icon" type="image/png" href="../img/logo.png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css"
     integrity="sha384-v2Tw72dyUXeU3y4aM2Y0tBJQkGfplr39mxZqlTBDUZAb9BGoC40+rdFCG0m10lXk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/fontawesome.css"
     integrity="sha384-q3jl8XQu1OpdLgGFvNRnPdj5VIlCvgsDQTQB6owSOHWlAurxul7f+JpUOVdAiJ5P" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="./css/collector.css">

  </head>

  <body>

    <nav>
      <div class="nav-wrapper">

        <a href="" class="left brand-logo">
          <img class="logoImg" src="../img/logo.png"></img>
          Viand
        </a>

        <div class="brand-logo right collectorName">
          <?php print($_SESSION['user']['name']); ?>
        </div>

      </div>
    </nav>

    <div id="pageContainer">

      <br>
      <div class="customContainer">
      	<div style="display: flex; flex-direction: column; flex-grow: 1;">
      		<div>
      		  <i class="fas fa-recycle"></i>
      		  <span class="weight">1.5kg</span>
      		</div>

      		<div>
      			<i class="fas fa-map-marker"></i>
      			<span class="location">Str. bla bla bla, bla bla bla bla bla...</span>
      		</div>
      	</div>

      	<div style="display: flex; flex-direction: column; align-items: flex-end;">
      	  <div class="status">Not taken</div>
      	  <div class="date-time" style="flex-shrink: 0; white-space: nowrap;">23/11/2016 1:42 AM</div>
      	</div>
      </div>

    </div>

    <script
      src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    <script src="./js/collector.js"></script>

  </body>

</html>
