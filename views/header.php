<?php 
//NOS CONECTAMOS A LA BASE DE DATOS
  $conexion = func_conexion($bd_config);
  
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?php echo RUTA; ?>/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA; ?>/css/styleOne.css">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-129693078-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-129693078-1');
    </script>
  </head>
  <body>
  
      <nav class="navbar navbar-expand-lg navbar-light bg-light navigation_bar">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="col-6 col-sm-3">
          <a href="<?php echo RUTA ?>"><img class="logo_menu" src="images/logo-03.svg"></a>
        </div>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">

              <li class="nav-item">
                <a class="nav-link link_barra" href="<?php echo RUTA; ?>">Home</a>
              </li>

              <?php if(isset($_SESSION['user'])){
                $typeuser = obtener_tipo_usuario($conexion, $_SESSION['user']);

                if($typeuser[0]["type"] == "JOURNALIST" || $typeuser[0]["type"] == "JOURNALIST/SOURCE"){

                  ?>
              <li class="nav-item">
                <a class="nav-link link_barra" href="<?php echo RUTA; ?>/searchprofile.php">Search</a>
              </li>

              <?php } ?>

              <li class="nav-item">
                <a class="nav-link link_barra" href="<?php echo RUTA; ?>/profile.php">My Profile</a>
              </li>

              <?php } ?>

              <li class="nav-item">
                <a class="nav-link link_barra" href="<?php echo RUTA; ?>/assistant.php">News Assistant</a>
              </li>

              <li class="nav-item">
                <a class="nav-link link_barra" href="<?php echo RUTA; ?>/calendar.php">Newsworthy Events</a>
              </li>

              <li class="nav-item">
                <a class="nav-link link_barra" href="<?php echo RUTA; ?>/schools.php">Schools of Journalism</a>
              </li>
              
              <li class="nav-item">
                <a class="nav-link link_barra" href="<?php echo RUTA; ?>/aboutus.php">About Us</a>
              </li>
              

              <?php if(isset($_SESSION['user'])){ ?>
              <li class="nav-item">
                <a class="nav-link link_barra" href="<?php echo RUTA; ?>/cerrar.php">Logout</a>
              </li>
              <?php } ?>

              <?php if(!isset($_SESSION['user'])){ ?>
              <li class="nav-item">
                <a class="nav-link link_barra" href="<?php echo RUTA; ?>/login.php">Login</a>
              </li>
              <?php } ?>
            </ul>
          </div>   
        </nav>