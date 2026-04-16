<?php session_start();

	//uso del archivo de configuracion
	require 'config.php'; 

	//uso del archivo de funciones
	require '../functions.php';

	//NOS CONECTAMOS A LA BASE DE DATOS
	$conexion = func_conexion($bd_config);

	func_comprobarSession();

	$errores = '';

	$email = $_SESSION['user'];

	$user_id = consultarID($conexion, $email);

	$city_origin_hidden = "";
	$country_origin_hidden = "";
	$city_residence_hidden = "";
	$country_residence_hidden = "";

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$place_origin = limpiarDatos($_POST['place_origin']);
		$place_residence = limpiarDatos($_POST['place_residence']);

		$city_origin_hidden = limpiarDatos($_POST['origin_city_hidden']);
		$country_origin_hidden = limpiarDatos($_POST['origin_country_hidden']);

		$city_residence_hidden = limpiarDatos($_POST['residence_city_hidden']);
		$country_residence_hidden = limpiarDatos($_POST['residence_country_hidden']);

		echo $place_origin . " --- "  . $place_residence;



		/*$guardarOrigen = $conexion->prepare('INSERT INTO users_has_areas(users_id_user, areas_id_area)
				VALUES(:users_id_user, :areas_id_area)');

				$guardarArea->execute(array(
					':users_id_user' => "$id_user",
					':areas_id_area' => "$area"
				));
				
				header('Location:' . RUTA . "/editprofile.php");
		}else{
			header('Location:' . RUTA . "/profile.php?error=e1");
		}*/


		if($place_origin != ""){
			$statement = $conexion->prepare(
			'UPDATE users SET place_origin = :place_origin WHERE id_user = :id'
			);

			$statement->execute(array(
				':place_origin' => $place_origin,
				':id' => $user_id[0][0]
			));
		}

		if($place_residence != ""){
			$statement = $conexion->prepare(
			'UPDATE users SET place_residence = :place_residence WHERE id_user = :id'
			);

			$statement->execute(array(
				':place_residence' => $place_residence,
				':id' => $user_id[0][0]
			));
		}

		//2	GUARDAMOS LA CIUDAD DE ORIGEN
			if(!empty($city_origin_hidden)){
				$statement = $conexion->prepare('UPDATE users SET cityfield_origin = :cityfield_origin, countryfield_origin = :countryfield_origin WHERE id_user = :id_user');
				$statement->execute(array(
					':cityfield_origin' => $city_origin_hidden,
					':countryfield_origin' => $country_origin_hidden,
					':id_user' => $user_id[0][0]
				));
			}

			//3	GUARDAMOS LA CIUDAD DE RESIDENCIA
			if(!empty($city_residence_hidden)){
				$statement = $conexion->prepare('UPDATE users SET cityfield_residence = :cityfield_residence, countryfield_residence = :countryfield_residence WHERE id_user = :id_user');
				$statement->execute(array(
					':cityfield_residence' => $city_residence_hidden,
					':countryfield_residence' => $country_residence_hidden,
					':id_user' => $user_id[0][0]
				));
			}

		header('Location:' . RUTA . "/editprofile.php");
		
	}




 ?>