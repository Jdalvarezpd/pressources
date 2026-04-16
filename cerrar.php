<?php session_start(); 

//uso del archivo de configuracion
	require 'admin/config.php'; 

session_destroy();
$_SESSION = array();

header('Location: ' . RUTA);


 ?>