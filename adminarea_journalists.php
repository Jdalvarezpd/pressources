<?php session_start();
require 'admin/config.php'; 
require 'functions.php';

if(!isset($_SESSION['admin'])){
    //header('Location: ' . RUTA);
    echo "Error...";
    header('Location:' . RUTA);
  }
  
	//Nos conectamos a la base de datos
	$conexion = func_conexion($bd_config);

	//si al conexion es incorrecta redirigimos a error.php
	if (!$conexion) {
		header('Location: error.php');
	}

  $admin = func_comprobarSession_Admin();

  $pagina = isset($_GET['p']) ? (int)$_GET['p'] : 1;
  $postPorPagina = 20;

  $errores = '';

  //Si la variable pagina es mayor a 1, la variable apgina se multiplica por los por postporpagina y se le resta los postpotpagina, en otro caso es igual a cero
  //de esta manera se desde que post traer dependiendo de la pagina en la que se encuentre el usuario
  $inicio = ($pagina > 1) ? ($pagina * $postPorPagina - $postPorPagina) : 0;


  if($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['busqueda'])){
        $busqueda = limpiarDatos($_GET['busqueda']);

        $users = $conexion->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM users WHERE (name LIKE '$busqueda' OR last_name LIKE '$busqueda' OR email LIKE '$busqueda') AND (type = 'JOURNALIST/SOURCE' OR type = 'JOURNALIST') LIMIT $inicio, $postPorPagina");
        $users->execute();
        $users = $users->fetchAll();

        //calculamos el total de usuarios para saber cuantas links a paginas deben haber en la paginacion
        $totalUsers = $conexion->query('SELECT FOUND_ROWS() as total');
        $totalUsers = $totalUsers->fetch()['total'];

        //la funcion ceil redondea hacia arriba si hay decimales en la division, de esa manera puedo obtener las paginas necesarias para los posts
        $numeroPaginas = ceil($totalUsers / $postPorPagina);


        if(empty($users)){
            $errores = 'No results were found';
        } else{
            //$titulo = 'Resultado de la busqueda: ' . $busqueda;
        }
    }else{
      $users = $conexion->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM users WHERE (type = 'JOURNALIST/SOURCE' OR type = 'JOURNALIST') LIMIT $inicio, $postPorPagina");
      $users->execute();
      $users = $users->fetchAll();

    //comprobar si entra a una pagina donde no hay registro de usuario osea el array() esta vacio
      if(!$users){
        header('Location: ' . RUTA . "/adminarea_journalists.php");
      }

      //calculamos el total de usuarios para saber cuantas links a paginas deben haber en la paginacion
      $totalUsers = $conexion->query('SELECT FOUND_ROWS() as total');
      $totalUsers = $totalUsers->fetch()['total'];

      //la funcion ceil redondea hacia arriba si hay decimales en la division, de esa manera puedo obtener las paginas necesarias para los posts
      $numeroPaginas = ceil($totalUsers / $postPorPagina);
    }
 ?>


 <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?php echo RUTA; ?>/css/styleOne.css">
    <link rel="stylesheet" href="<?php echo RUTA; ?>/css/bootstrap.min.css">
    
  </head>
  <body>

    <div class="container-fluid d-flex justify-content-center">

      <div class="row">
        <div class="col-8">
          <h5 style="margin-bottom: 3em; margin-top: 2em;">Pressources Admin Area</h5>
        </div>
        <div class="col-4">
          <a style="margin-top: 2em; color: #fff" href="<?php echo RUTA; ?>/cerrar.php" class="btn btn-danger">Logout</a>
        </div>
        <div class="col-12">
          <p class="text-danger"><?php echo $errores; ?></p>
        </div>
        <div class="col-8">
          <form class="form-inline navbar-form navbar-left" action="<?php echo RUTA; ?>/adminarea.php" method="get">
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Name, LastName or email" aria-label="Recipient's username" aria-describedby="basic-addon2" name="busqueda">
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Find</button>
              </div>
              <div class="" style="margin-left: 2em;">
                <a href="<?php echo RUTA; ?>/adminarea.php">All</a>
                <a style="margin-left: 1em;" href="<?php echo RUTA; ?>/adminarea_journalists.php">Only Journalists</a>
              </div>
            </div>
          </form>
        </div>

        <div class="col-12">
          <table width="100%" border="1">
            <tr style="background-color: #424242; color: #fff;">
              <td width="50">Id</td>
              <td width="80">Name</td>
              <td width="80">LastName</td>
              <td width="80">Email</td>
              <td width="100">Birth Date</td>
              <td width="100">Type</td>
              <td width="100">Origin</td>
              <td width="100">Residence</td>
              <td width="100">Link (JOURNALISTS)</td>
              <td width="100">Sign UpDate</td>
              <td width="100"></td>
            </tr>
            <?php foreach ($users as $user): ?>
            <tr style="font-size: 0.8em;">
              <td width="50"><p><?php echo $user['id_user']; ?></p></td>
              <td width="80"><p><?php echo $user['name']; ?></p></td>
              <td width="80"><p><?php echo $user['last_name']; ?></td>
              <td width="80"><p><?php echo $user['email']; ?></td>
              <td width="100"><p><?php echo $user['birth_date']; ?></td>
              <td width="100"><p><?php echo $user['type']; ?></td>
              <td width="100"><p><?php echo $user['place_origin']; ?></td>
              <td width="100"><p><?php echo $user['place_residence']; ?></td>
              <td width="100"><a href="<?php echo $user['journalink']; ?>"><?php echo $user['journalink']; ?></a></td>
              <td width="100"><p><?php echo $user['signup_date']; ?></td>
              <td width="100"><a class="text-danger" href="admin/delete_user.php?id=<?php echo $user['id_user']; ?>">Delete</a><a class="text-primary" href="userprofile.php?id=<?php echo $user['id_user']; ?>"> View</a></td>
            </tr>
            <?php endforeach;?>
          </table>
        </div>
      </div>
    </div><!-- /container -->

    <section class="paginacion" style="margin-top: 3em; text-align: center;">
      <ul>
        <!--ESTABLECER CUANDO EL BOTON ANTERIOR ESTA DESABILITADO-->
        <?php if ($pagina == 1): ?>
          <li class="disab">&laquo;</li>
        <?php else: ?>
          <li><a href="?p=<?php echo $pagina - 1; ?>">&laquo;</a></li>
        <?php endif ?>

        <!--EJECUTAMOS EL CICLO APRA MOSTRAR LAS PAGINAS-->
        <?php 
          for ($i=1; $i <= $numeroPaginas ; $i++) { 
            if($pagina == $i){
              echo "<li class='active'><a href='?p=$i'>$i</a></li>";
            }else{
              echo "<li><a href='?p=$i'>$i</a></li>";
            }
          }
         ?>

        <!--ESTABLECER CUANDO EL BOTON SIGUIENTE ESTA DESABILITADO-->
         <?php if ($pagina == $numeroPaginas): ?>
          <li class="disab">&raquo;</li>
        <?php else: ?>
          <li><a href="?p=<?php echo $pagina + 1; ?>">&raquo;</a></li>
        <?php endif ?>
      </ul>
    </section>

     <!--Delete industries-->
        <form method="post" action="admin/delete_iry.php">
        <div class="modal fade" id="modal_ind_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sure you want to delete?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete</button>
              </div>
            </div>
          </div>
        </div>
        </form>

    <?php require 'views/footer.php'; ?>