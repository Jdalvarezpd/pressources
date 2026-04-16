<?php 

	//uso del archivo de configuracion
	require 'config.php'; 

	//uso del archivo de funciones
	require '../functions.php';

	//NOS CONECTAMOS A LA BASE DE DATOS
	$conexion = func_conexion($bd_config);

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$sector_array = limpiarDatos($_POST['sector']);
		$posnews = limpiarDatos($_POST['posnews']);
		$id_user = limpiarDatos($_POST['id_user']);

		$sector = obtener_sector_usuario($conexion, $id_user);
		$cantidad = count($sector);

		if($cantidad<=0){
			
			$sector = $sector_array[0][0];
			
			if($posnews == "-"){
				$statement3 = $conexion->prepare('INSERT INTO users_has_sectors(users_id_user, sectors_id_sector)
				VALUES(:users_id_user, :sectors_id_sector)');

				$statement3->execute(array(
					':users_id_user' => "$id_user",
					':sectors_id_sector' => "$sector"
				));

			}else{
				$statement3 = $conexion->prepare('INSERT INTO users_has_sectors(users_id_user, sectors_id_sector, id_posnews)
				VALUES(:users_id_user, :sectors_id_sector, :id_posnews)');

				$statement3->execute(array(
					':users_id_user' => "$id_user",
					':sectors_id_sector' => "$sector",
					':id_posnews' => "$posnews"
				));
			}

				
				header('Location:' . RUTA . "/profile.php");
		}else{
			header('Location:' . RUTA . "/profile.php?error=e3");
		}
	}




 ?>