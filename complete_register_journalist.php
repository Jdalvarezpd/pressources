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

	if($user_data['type'] != 'SOURCE'){
		header('Location: ' . RUTA . "/profile.php");
	}


	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$newsinst = limpiarDatos($_POST['newsinst']);
		$sector = limpiarDatos($_POST['sector']);
		$posnews = limpiarDatos($_POST['posnews']);

		$ready = true;
		$errores = '';

		if($sector == "-"){
			$ready = false;
			$needed = '*';
			$errores = $errores .= '<li>You have to put your sector in the news outlet</li>';
		}

		if(isset($_POST['terms']) && $_POST['terms']!=""){
			//echo "is checked";
		}else{
			$ready = false;
			$needed = '*';
			$errores = $errores .= '<li>You have to accept the terms and conditions</li>';
		}



		upgrade_user($conexion, $email);

		if($ready == true){

			////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		//1. DESPUES DE OBTENER EL ID DEL USUARIO PROCEDEMOS A GUARDAR SU PROFESION

				if($posnews == "-"){
					$statement3 = $conexion->prepare('INSERT INTO users_has_sectors(users_id_user, sectors_id_sector)
					VALUES(:users_id_user, :sectors_id_sector)');

					$statement3->execute(array(
						':users_id_user' => $user_data['id_user'],
						':sectors_id_sector' => "$sector"
					));

				}else{
					$statement3 = $conexion->prepare('INSERT INTO users_has_sectors(users_id_user, sectors_id_sector, id_posnews)
					VALUES(:users_id_user, :sectors_id_sector, :id_posnews)');

					$statement3->execute(array(
						':users_id_user' => $user_data['id_user'],
						':sectors_id_sector' => "$sector",
						':id_posnews' => "$posnews"
					));
				}

		}

	}

	//obtengo los roles de periodistas de la base de datos
	$roles = obtener_sectores($conexion);

	require 'views/header.php';
	require 'views/complete_register_journalist.view.php';
 ?>