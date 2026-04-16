<?php 

	//uso del archivo de configuracion
	require 'config.php'; 

	//uso del archivo de funciones
	require '../functions.php';

	//NOS CONECTAMOS A LA BASE DE DATOS
	$conexion = func_conexion($bd_config);

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$industry = limpiarDatos($_POST['ind_new']);
		$id_user = limpiarDatos($_POST['id_user']);
		$detail = limpiarDatos($_POST['detail_prof']);

		$industries = obtener_industrias_usuario($conexion, $id_user);
		$cantidad = count($industries);

		if($cantidad<=2){

			if($detail != "Profession..." && $detail != ''){

					$statement3 = $conexion->prepare('INSERT INTO users_has_industries(users_id_user, industries_id_industry, detail)
					VALUES(:users_id_user, :industries_id_industry, :detail)');

					$statement3->execute(array(
						':users_id_user' => "$id_user",
						':industries_id_industry' => "$industry",
						':detail' => "$detail"
					));

			}else{
					$statement3 = $conexion->prepare('INSERT INTO users_has_industries(users_id_user, industries_id_industry)
					VALUES(:users_id_user, :industries_id_industry)');

					$statement3->execute(array(
						':users_id_user' => "$id_user",
						':industries_id_industry' => "$industry"
					));	

			}
				header('Location:' . RUTA . "/editprofile.php");
		}else{
			header('Location:' . RUTA . "/profile.php?error=e2");
		}		
	}




 ?>