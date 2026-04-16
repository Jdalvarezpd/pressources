<?php session_start();
	require 'admin/config.php'; 
	require 'functions.php'; 

	//NOS CONECTAMOS A LA BASE DE DATOS
	$conexion = func_conexion($bd_config);

	//func_comprobarSession();

	//SI NO EXISTE CONECCION A LA BASE DE DATOS, SE REDIRIGE A LA PAGINA DE ERRORES
	if (!$conexion) {
		header('Location: error.php');
	} 


	if(isset($_SESSION['user'])){
		header('Location: ' . RUTA);
	}


	if($_SERVER['REQUEST_METHOD'] =='POST'){
	$email = limpiarDatos($_POST['email']);
	$password = limpiarDatos($_POST['pass']);

	$errores = '';

	$consultarUsuario = consultar_existencia_por_email($conexion, $email);

	if($consultarUsuario !=false){

		if(password_verify($password, $consultarUsuario['password'])){
			$_SESSION['user'] = $email;

			header('Location: ' . RUTA);
		}else{
			$errores = "The username or password you entered is incorrect.";
		}
	}else{
		$errores = "The username or password you entered is incorrect.";
	}
}
	require 'views/header.php';
	require 'views/login.view.php';

 ?>