<!DOCTYPE HTML>

<html>

  <head>

    <title>FoodRAR</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css"
     integrity="sha384-v2Tw72dyUXeU3y4aM2Y0tBJQkGfplr39mxZqlTBDUZAb9BGoC40+rdFCG0m10lXk" crossorigin="anonymous">
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/fontawesome.css"
     integrity="sha384-q3jl8XQu1OpdLgGFvNRnPdj5VIlCvgsDQTQB6owSOHWlAurxul7f+JpUOVdAiJ5P" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/media.css">
    <link rel="stylesheet" type="text/css" href="css/modals.css">

    <script
      src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    <script src="js/main.js"></script>

  </head>

  <body>

    <nav>
      <div class="nav-wrapper">

        <i data-target="sideNav" class="sidenav-trigger fas fa-bars"></i>
        <a href="" class="brand-logo center">
          <img class="logoImg" src="img/logo.png"></img>
          Viand
        </a>

        <i data-target="loginModal" class="modal-trigger right fas fa-sign-in-alt"></i>
        <i data-target="registerModal" class="modal-trigger right fas fa-user-plus"></i>
        <i class="right fas fa-cog"></i>

      </div>
    </nav>

    <ul class="sidenav" id="sideNav">
      <a href="" id="navBarLogo">
         <img class="logoImg" src="img/logo.png">
        Viand
      </a>

      <div class="sideText" id="sideName">
        <i class="fas fa-user"></i>
        Name1 Name2-Name3
      </div>
      <div class="sideText" id="sideKg">
        <i class="fas fa-recycle"></i>
        100.26 kg
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
      <a class=" modal-action modal-close waves-effect waves-green btn-flat">Sign in</a>
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
        </form>
      </div>
    </div>
    <div class="modal-footer">
      <a class=" modal-action modal-close waves-effect waves-green btn-flat">Sign up</a>
    </div>
  </div>

  </body>

</html>
