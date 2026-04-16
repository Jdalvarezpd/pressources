<?php session_start();
require 'admin/config.php'; 
require 'functions.php';

	//Nos conectamos a la base de datos
	$conexion = func_conexion($bd_config);

	//si al conexion es incorrecta redirigimos a error.php
	if (!$conexion) {
		header('Location: error.php');
	}

	$errores = '';

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$user = limpiarDatos($_POST['user']);
	$pass = limpiarDatos($_POST['pass']);

		if($user == $admin_user1['user'] && $pass == $admin_user1['pass']){
			$_SESSION['admin'] = $user['user'];
			header('Location:' . RUTA . '/adminarea.php');
		}else{
			if($user == $admin_user2['user'] && $pass == $admin_user2['pass']){
				$_SESSION['admin'] = $user['user'];
				header('Location:' . RUTA . '/adminarea.php');
			}else{
				$errores .= 'incorrect username or password';
			}
		}
	}

 ?>


 <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?php echo RUTA; ?>/css/bootstrap.min.css">
  </head>
  <body>

    <div class="container-fluid d-flex justify-content-center fondo_inicial">

        <div class="card" style="width: 20rem; margin-top: 10em;">
          <div class="card-body">

            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <input type="text" id="inputEmail" name="user" class="form-control" placeholder="User" style="margin-bottom: 1em;" required autofocus>
                <input type="password" id="inputEmail" name="pass" class="form-control" placeholder="Pass" style="margin-bottom: 1em;" required autofocus>
                <input type="hidden" name="key" value="<?php echo $key; ?>">
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Login</button>
            </form><!-- /form -->

            <?php if(!empty($errores)): ?>

                <div class="row">
                  <div class="col-12">
                      <div class="alert alert-danger" role="alert" style="margin-top: 1em;">
                         <?php echo $errores; ?>
                      </div>
                    </div>
                  </div>

               <?php endif; ?>
          </div>
        </div>
    </div><!-- /container -->

    <?php require 'views/footer.php'; ?>