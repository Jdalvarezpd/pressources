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

	$journalink = "";

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$journalink = limpiarDatos($_POST['journalink']);

		if($journalink != ""){
			$statement = $conexion->prepare(
			'UPDATE users SET journalink = :journalink WHERE id_user = :id'
			);

			$statement->execute(array(
				':journalink' => $journalink,
				':id' => $user_id[0][0]
			));
		}

		header('Location:' . RUTA . "/editprofile.php");
		
	}




 ?>