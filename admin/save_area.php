<?php 

	//uso del archivo de configuracion
	require 'config.php'; 

	//uso del archivo de funciones
	require '../functions.php';

	//NOS CONECTAMOS A LA BASE DE DATOS
	$conexion = func_conexion($bd_config);

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$area = limpiarDatos($_POST['area_new']);
		$id_user = limpiarDatos($_POST['id_user']);

		$areas = obtener_areas_usuario($conexion, $id_user);
		$cantidad = count($areas);

		if($cantidad<=2){		
			$guardarArea = $conexion->prepare('INSERT INTO users_has_areas(users_id_user, areas_id_area)
				VALUES(:users_id_user, :areas_id_area)');

				$guardarArea->execute(array(
					':users_id_user' => "$id_user",
					':areas_id_area' => "$area"
				));
				
				header('Location:' . RUTA . "/editprofile.php");
		}else{
			header('Location:' . RUTA . "/profile.php?error=e1");
		}
	}




 ?>