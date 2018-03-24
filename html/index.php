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
        <i id="settingsBtn" class="right fas fa-cog"></i>
        <?php } ?>

      </div>
    </nav>

    <?php if ($logged_in ) { ?>

    <ul class="sidenav" id="sideNav">

      <a href="" id="navBarLogo">
        <img class="logoImg" src="img/logo.png">
        Viand
      </a>

      <div class="sideText" id="sideName">
        <i class="fas fa-user"></i>
          <?php print($_SESSION['user']['name']); ?>
      </div>
      <div class="sideText" id="sideKg">
        <i class="fas fa-recycle"></i>
        <?php print($_SESSION['user']['quantity']); ?> kg
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
    <div id="firstPageContainer">
      <img style="margin-left:25px;width:70px;height:70px;" class="logoImg" src="img/logo.png">
      <br>
      <div>Viand</div>
      <div id="firstPageInfo">
        Roughly one third of the food produced in the world for human consumption
        every year gets lost or wasted.
        <br>
        Sign up today, make a food donation and help reduce the worldwide food waste!
      </div>
      <a style="background-color:rgb(95, 75, 139);margin-top:15px; font-size:18px;" data-target="registerModal" class="modal-trigger waves-effect waves-light btn">Sign up</a>
    </div>
    <?php } ?>

    <!-- Modal Structure -->
  <div id="loginModal" class="modal">
    <div class="modal-content">
      <h4>Sign in</h4>

      <div class="row">
        <form class="col s12">
          <div class="row modal-form-row">
            <div class="input-field col s12">
              <input id="emailLogin" type="text" class="validate">
              <label for="emailLogin">Email</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input id="passwordLogin" type="password" class="validate">
              <label for="passwordLogin">Password</label>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="modal-footer">
      <a id="loginBtn" class="modal-action modal-close waves-effect waves-green btn-flat">Sign in</a>
    </div>
  </div>

  <div id="registerModal" class="modal">
    <div class="modal-content">
      <h4>Sign up</h4>

      <div class="row">
        <form class="col s12">
          <div class="row modal-form-row">
            <div class="input-field col s12">
              <input id="nameRegister" type="text" class="validate">
              <label for="nameRegister">Name</label>
            </div>
          </div>
          <div class="row modal-form-row">
            <div class="input-field col s12">
              <input id="emailRegister" type="text" class="validate">
              <label for="emailRegister">Email</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input id="passwordRegister" type="password" class="validate">
              <label for="passwordRegister">Password</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input id="phoneRegister" type="text" class="validate">
              <label for="phoneRegister">Phone number</label>
            </div>
          </div>
          <div class="row">
              <div class="input-field col s6">
                <label>
                  <input class="with-gap" name="registerGroup" type="radio" checked />
                  <span>Person</span>
                </label>
              </div>
              <div class="input-field col s6">
                <label>
                  <input class="with-gap" name="registerGroup" type="radio"/>
                  <span>Company</span>
                </label>
              </div>
          </div>
        </form>
      </div>
    </div>
    <div class="modal-footer">
      <a id="registerBtn" class=" modal-action modal-close waves-effect waves-green btn-flat">Sign up</a>
    </div>
  </div>

  <div id="settingsModal" class="modal">
    <div class="modal-content">
      <h4>Sign up</h4>

      <div class="row">
        <form class="col s12">
          <div class="row modal-form-row">
            <div class="input-field col s12">
              <input id="nameSettings" type="text" class="validate">
              <label for="nameSettings">Name</label>
            </div>
          </div>
          <div class="row modal-form-row">
            <div class="input-field col s12">
              <input id="emailSettings" type="text" class="validate">
              <label for="emailSettings">Email</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input id="passwordSettings" type="password" class="validate">
              <label for="passwordSettings">Password</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input id="phoneSettings" type="text" class="validate">
              <label for="phoneSettings">Phone number</label>
            </div>
          </div>
          <div class="row">
              <div class="input-field col s12">
                  <label>
                      <input id="isCompanySettings" type="checkbox" class="filled-in" />
                      <span>Company</span>
                  </label>
              </div>
          </div>
        </form>
      </div>
    </div>
    <div class="modal-footer">
      <a id="settingsBtn" class=" modal-action modal-close waves-effect waves-green btn-flat">Sign up</a>
    </div>
  </div>

<div id="newPostModal" class="modal">
    <div class="modal-content">
      <h4>New Post</h4>

      <div class="row">
        <form class="col s12">
          <p>Available Time</p>
          <div class="row modal-form-row">
            <div class="input-field col s12">
              <input id="fromNewPost" type="text" class="timepicker" required>
              <label for="fromNewPost">From</label>
            </div>
          </div>
          <div class="row modal-form-row">
            <div class="input-field col s12">
              <input id="toNewPost" type="text" class="timepicker" required>
              <label for="toNewPost">To</label>
            </div>
          </div>
          <div class="row modal-form-row">
            <div class="input-field col s12">
              <input id="kgNewPost" type="text" required>
              <label for="kgNewPost">Kilograms</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input id="addressNewPost" type="text" required>
              <label for="addressNewPost">Address</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input id="notesNewPost" type="text">
              <label for="notesNewPost">Notes</label>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="modal-footer">
      <a id="newPostBtn" class=" modal-action modal-close waves-effect waves-green btn-flat">Send</a>
    </div>
  </div>
  <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
  <script src="js/main.js"></script>

  </body>

</html>
