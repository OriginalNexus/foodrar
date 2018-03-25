<?php
        require_once('setup.php');

        $logged_in = isset($_SESSION['user']);
?>

<!DOCTYPE HTML>

<html>

  <head>

    <title>FoodRAR</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">

    <link rel="shortcut icon" type="image/png" href="img/logo.png"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css"
     integrity="sha384-v2Tw72dyUXeU3y4aM2Y0tBJQkGfplr39mxZqlTBDUZAb9BGoC40+rdFCG0m10lXk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/fontawesome.css"
     integrity="sha384-q3jl8XQu1OpdLgGFvNRnPdj5VIlCvgsDQTQB6owSOHWlAurxul7f+JpUOVdAiJ5P" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/media.css">
    <link rel="stylesheet" type="text/css" href="css/modals.css">

  </head>

  <body>

    <nav>
      <div class="nav-wrapper">

        <?php if ($logged_in) { ?>
        <i data-target="sideNav" class="sidenav-trigger fas fa-bars"></i>
        <?php } ?>

        <?php if ($logged_in) { ?>
        <a href="" class="brand-logo center">
        <?php } else { ?>
        <a href="" class="brand-logo" style="margin-left: 15px;">
        <?php } ?>
          <img class="logoImg" src="img/logo.png"></img>
          Viand
        </a>

        <?php if (!$logged_in) { ?>
        <i data-target="loginModal" class="modal-trigger right fas fa-sign-in-alt"></i>
        <i data-target="registerModal" class="modal-trigger right fas fa-user-plus"></i>
        <?php } else { ?>
        <i id="logoutBtn" class="right fas fa-sign-out-alt"></i>
        <i data-target="settingsModal" class="modal-trigger right fas fa-cog"></i>
        <?php } ?>

      </div>
    </nav>

    <?php if ($logged_in) { ?>

    <ul class="sidenav" id="sideNav">

      <a href="" id="navBarLogo">
        <img class="logoImg" src="img/logo.png">
        Viand
      </a>

      <div class="sideText" id="sideName">

      </div>
      <div class="sideText" id="sideKg">

      </div>

      <li class="sideItemContainer" id="recents">
        <div class="sideItem">
          <i class="fas fa-history sideNavIcons"></i>
          Recents
        </div>
      </li>
      <li class="sideItemContainer" id="badges">
        <div class="sideItem">
        <i class="fas fa-certificate sideNavIcons"></i>
        Badges
      </div>
      </li>
      <li class="sideItemContainer" id="vouchers">
        <div class="sideItem">
          <i class="fas fa-dollar-sign sideNavIcons"></i>
          Vouchers
        </div>
      </li>
      <li class="sideItemContainer" id="restaurants">
        <div class="sideItem">
          <i class="fas fa-utensils sideNavIcons"></i>
          Involved restaurants
        </div>
      </li>

    </ul>

    <?php } ?>

    <?php if (!$logged_in) { ?>
    <img src="img/resizer.png" id="backgroundImg">
    <div id="firstPageContainer">
      <img style="margin-left:22.5px;width:70px;height:70px;" class="logoImg" src="img/logo.png">
      <br>
      <div>Viand</div>
      <div id="firstPageInfo">
        Roughly one third of the food produced in the world for human consumption
        every year gets lost or wasted.
        <br>
        Sign up today, make a food donation and help reduce the worldwide food waste!
      </div>
      <a style="background-color: rgb(95, 75, 139); margin-top: 15px; font-size: 18px;" data-target="registerModal" class="modal-trigger waves-effect waves-light btn">Sign up</a>
    </div>
    <?php } else { ?>
      <div id="motivationalContainer">

      </div>
      <br>
      <div id="pageContainer">
        <div id="contentTitle" class="leftTitle"></div>
        <hr>
        <div id="itemsContainer">

        </div>

        <a href="#newPostModal" class="fixed-action-btn modal-trigger btn-floating btn-large waves-effect waves-light"><i style="background-color: rgb(95, 75, 139);" class="material-icons">add</i></a>
      </div>
    <?php } ?>

<?php
  include('modals/login.html');
  include('modals/register.html');
  include('modals/settings.html');
  include('modals/new_post.html');
?>

  <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
  <script src="js/main.js"></script>

  </body>

</html>
