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
          Gigel Gigica
        </div>

      </div>
    </nav>

    <?php

    require_once('../setup.php');

    if (!isset($_SESSION['collector'])) {
    	http_response_code(401);
    	die('Not logged in');
    }

    $stmt = $db_conn->prepare('select posts.*, status.display_name as status_display_name from posts inner join status on status.name=posts.status where posts.user_email = ?');
    $stmt->bind_param("s", $_SESSION['collector']['email']);

    if (!$stmt->execute()) {
    	http_response_code(500);
    	die('Could not fetch posts');
    }

    $result = $stmt->get_result();

    print(json_encode($result->fetch_all(MYSQLI_ASSOC)));

    ?>

    <script
      src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    <script src="./js/collector.js"></script>

  </body>

</html>
