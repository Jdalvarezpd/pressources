<?php session_start();

	//uso del archivo de configuracion
	require 'config.php'; 

	//uso del archivo de funciones
	require '../functions.php';

	if(!isset($_SESSION['admin'])){
    //header('Location: ' . RUTA);
    echo "Error...";
    header('Location:' . RUTA);
  }
  
	//Nos conectamos a la base de datos
	$conexion = func_conexion($bd_config);

	//si la conexion es incorrecta redirigimos a error.php
	if (!$conexion) {
		header('Location: error.php');
	}

	if($_SERVER['REQUEST_METHOD'] == 'GET'){
		$id_user = limpiarDatos($_GET['id']);

		$delete = delete_user($conexion, $id_user);

		header('Location:' . RUTA . "/adminarea.php");
	}




 ?>