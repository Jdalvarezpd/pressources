<?php session_start();

//uso del archivo de configuracion
	require 'admin/config.php'; 

	//uso del archivo de funciones
	require 'functions.php'; 

	//NOS CONECTAMOS A LA BASE DE DATOS
	$conexion = func_conexion($bd_config);

	$needed = '';
	$enviado = '';

	//SI NO EXISTE CONECCION A LA BASE DE DATOS, SE REDIRIGE A LA PAGINA DE ERRORES
	if (!$conexion) {
		header('Location: error.php');
	}

	func_comprobarSession();

	$email = $_SESSION['user'];

	$user_data = consultar_existencia_por_email($conexion, $email);

	if($user_data['type'] != 'JOURNALIST'){
		header('Location: ' . RUTA . "/profile.php");
	}
	//echo $user_data['id_user'];


	//SI YA SE HAN ENVIADO LOS DATOS, SE RECIBEN Y SE GUARDAN LOS VALORES EN VARIABLES
	//LOS DATOS SE ESTAN RECIBIENDO POR EL CAMPO (name="")
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$indone = limpiarDatos($_POST['indone']);
		$areaone = limpiarDatos($_POST['areaone']);
		$areatwo = limpiarDatos($_POST['areatwo']);
		$detailone = limpiarDatos($_POST['detailone']);

		$ready = true;
		$errores = '';

		if($indone == "-"){
			$ready = false;
			$needed = '*';
			$errores = $errores .= '<li>You have to include your industry</li>';
		}

		upgrade_user($conexion, $email);


		if($ready == true){

			//1. DESPUES DE OBTENER EL ID DEL USUARIO PROCEDEMOS A GUARDAR SU PROFESION
			if($detailone != "Profession..."){

					$statement3 = $conexion->prepare('INSERT INTO users_has_industries(users_id_user, industries_id_industry, detail)
					VALUES(:users_id_user, :industries_id_industry, :detail)');

					$statement3->execute(array(
						':users_id_user' => $user_data['id_user'],
						':industries_id_industry' => "$indone",
						':detail' => "$detailone"
					));

			}else{
					$statement3 = $conexion->prepare('INSERT INTO users_has_industries(users_id_user, industries_id_industry)
					VALUES(:users_id_user, :industries_id_industry)');

					$statement3->execute(array(
						':users_id_user' => $user_data['id_user'],
						':industries_id_industry' => "$indone"
					));	

			}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

			//1. SI INCLUYO VALORES EN LAS AREAS DE EXPERIENCIA
			if($areaone != "-"){
				$guardarArea = $conexion->prepare('INSERT INTO users_has_areas(users_id_user, areas_id_area)
				VALUES(:users_id_user, :areas_id_area)');

				$guardarArea->execute(array(
					':users_id_user' => $user_data['id_user'],
					':areas_id_area' => "$areaone"
				));
			}

	//2. SI INCLUYO VALORES EN LA SEGUNDA AREA DE EXPERIENCIA
			if($areatwo != "-"){
				$guardarArea2 = $conexion->prepare('INSERT INTO users_has_areas(users_id_user, areas_id_area)
				VALUES(:users_id_user, :areas_id_area)');

				$guardarArea2->execute(array(
					':users_id_user' => $user_data['id_user'],
					':areas_id_area' => "$areatwo"
				));
			}

			if(!$errores){
				$enviado = 'true';
			}

			//SI TODO ES CORRECTO LO ENVIAMOS AL INICIO
			header('Location:' . RUTA . "/profile.php");

		}
	}

	//Obtengo los posts de la base de datos
	$professions = obtener_industrias($conexion);

	//Obtengo los posts de la base de datos
	$areas = obtener_areas($conexion);


	require 'views/header.php';
	require 'views/complete_register_source.view.php';
 ?>