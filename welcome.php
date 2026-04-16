<?php


//uso del archivo de configuracion
	require 'admin/config.php'; 

	//uso del archivo de funciones
	require 'functions.php'; 

	require 'views/header.php';

	$pagina_anterior = '';

	if(isset($_SERVER['HTTP_REFERER'])){
		$pagina_anterior=$_SERVER['HTTP_REFERER'];
	}

	if((strpos($pagina_anterior, "register.php") !==false) || (strpos($pagina_anterior, "register_source.php") !==false)){
				//echo "viene de registro";
	}else{
			//echo "no viene de registro";
		header('Location:' . RUTA);			
	}
?>

 <!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  </head>
  <body>

  	<div class="container">
		<div class="col-12">
			<h4 style="font-weight: bold; margin-top: 3%;">¡WELCOME TO PRESSOURCES!</h4>
		</div>
		<?php 


		?>
  		<div class="row rounded" style="margin-top: 3%; background-color: #f2f2f2;">
	  		<div class="col-12">

	  		</div>
  		</div>

  	</div>



<?php require 'views/footer.php'; ?>