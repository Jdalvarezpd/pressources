<?php session_start();

	//uso del archivo de configuracion
	require 'config.php'; 

	//uso del archivo de funciones
	require '../functions.php';

	//NOS CONECTAMOS A LA BASE DE DATOS
	$conexion = func_conexion($bd_config);

	//si al conexion es incorrecta redirigimos a error.php
	if (!$conexion) {
		header('Location: error.php');
	}

	func_comprobarSession();

	$email = $_SESSION['user'];

	if($_SERVER['REQUEST_METHOD'] == 'GET'){
		$id_area = limpiarDatos($_GET['id']);

		$user_id = consultarID($conexion, $email);

		$ok = delete_area($conexion, $user_id[0][0], $id_area);

		header('Location:' . RUTA . "/editprofile.php");
	}




 ?>