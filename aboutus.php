<?php
	require 'admin/config.php'; 
	require 'functions.php'; 

	$conexion = func_conexion($bd_config);

	if (!$conexion) {
		header('Location: error.php');
	}
	
	require 'views/header.php';
	require 'views/aboutus.view.php';
 ?>