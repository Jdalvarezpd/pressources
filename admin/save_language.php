<?php 

	//uso del archivo de configuracion
	require 'config.php'; 

	//uso del archivo de funciones
	require '../functions.php';

	//NOS CONECTAMOS A LA BASE DE DATOS
	$conexion = func_conexion($bd_config);

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$language = limpiarDatos($_POST['lang_new']);
		$id_user = limpiarDatos($_POST['id_user']);

		$languages = obtener_idiomas_usuario($conexion, $id_user);
		$cantidad = count($languages);

		if($cantidad<=4){

			$statement4 = $conexion->prepare('INSERT INTO users_has_languages(users_id_user, languages_id_language)
			VALUES(:users_id_user, :languages_id_language)');

			$statement4->execute(array(
				':users_id_user' => "$id_user",
				':languages_id_language' => "$language"
			));

		header('Location:' . RUTA . "/editprofile.php");
	}else{
		header('Location:' . RUTA . "/profile.php?error=3");
	}
	}




 ?>