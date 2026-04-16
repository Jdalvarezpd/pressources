<?php session_start();

//uso del archivo de configuracion
	require 'admin/config.php'; 

	//uso del archivo de funciones
	require 'functions.php'; 

	//Nos conectamos a la base de datos
	$conexion = func_conexion($bd_config);

	//si al conexion es incorrecta redirigimos a error.php
	if (!$conexion) {
		header('Location: error.php');
	}

	func_comprobarSession();

	$errores = '';

	$email = $_SESSION['user'];

	$areas_of_exp = obtener_areas($conexion);
	$industrias_usuario = obtener_industrias($conexion);
	$lenguajes_usuario = obtener_idiomas($conexion);

	$user_data = consultar_existencia_por_email($conexion, $email);

	$user_id = consultarID($conexion, $email);

	$user_type = $user_data['type'];
	$username = $user_data['name'];
	$userlastname = $user_data['last_name'];
	$user_description = $user_data['description'];

	if($user_data['img_route'] == ''){
		$user_image = 'user.jpg';
	}else{
		$user_image = $user_data['img_route'];
	}


	$lang = obtener_idiomas_usuario($conexion, $user_id[0][0]);
	$lang_name = array();

	for($i = 0; $i<count($lang); $i++){
	 	$new_language = obtener_nombre_idioma($conexion, $lang[$i][0]);
	 	array_push($lang_name, $new_language);
	}


	$ind = obtener_industrias_usuario($conexion, $user_id[0][0]);
	 //print_r($ind);
	 $ind_name = array();
	 for($i = 0; $i<count($ind); $i++){
	 	 $new_ind = obtener_nombre_idustria($conexion, $ind[$i][0]);
	 	 array_push($ind_name, $new_ind);
	 }


	$area = obtener_areas_usuario($conexion, $user_id[0][0]);
	 $area_name = array();

	 for($i = 0; $i<count($area); $i++){
	 	 $new_area = obtener_nombre_area($conexion, $area[$i][0]);
	 	 array_push($area_name, $new_area);
	 }


	 $sector_name = array();
	 $posnews_name = array();

	if($user_type == 'JOURNALIST' || $user_type == 'JOURNALIST/SOURCE'){
		$sector = obtener_sector_usuario($conexion, $user_id[0][0]);
	 		

	 for($i = 0; $i<count($sector); $i++){
	 	 $new_sector = obtener_nombre_sector($conexion, $sector[$i][0]);
	 	 $posnews_name = obtener_nombre_posnews($conexion, $sector[$i][1]);
	 	 array_push($sector_name, $new_sector);
	 }
	 //print_r($posnews_name);
	}


	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$thumb = $_FILES['thumb'];
		$thumb_saved = $_POST['thumb_saved'];
		$desc = $_POST['desc'];

		$fullname = $_POST['quote'];

		echo $fullname;

		/*print_r($thumb["type"] . "si");

		$aja = exif_imagetype($_FILES['thumb']['tmp_name']);
		echo $aja;*/

		if(empty($thumb['name'])){
			$statement = $conexion->prepare(
			'UPDATE users SET description = :description WHERE id_user = :id'
			);

			$statement->execute(array(
				':description' => $desc,
				':id' => $user_id[0][0]
			));

		}else{

			//COMPROBAMOS QUE NO SE SUPERE EL TAMAÑO MAXIMO DE LA IMAGEN
			if($thumb['size'] <= 3000000){

				$extension = explode("/", $_FILES["thumb"]["type"]);

				//print_r($extension[1]);

				//VERIFICAMOS QUE EL FORMATO NO SEA DIFERENTE A JPG O PNG
				if($extension[1] == "jpeg" || $extension[1] == "JPEG" || $extension[1] == "jpg" || $extension[1] == "JPG" || $extension[1] == "png" || $extension[1] == "PNG"){
					$extension = explode("/", $_FILES["thumb"]["type"]); //extension del archivo
					$imagenameformat = $email . '-userimage' . '.' . $extension[1];

					$archivo_subido = 'images/users/' . $imagenameformat;
					move_uploaded_file($_FILES['thumb']['tmp_name'], $archivo_subido);

					$statement = $conexion->prepare(
					'UPDATE users SET img_route = :img_route, description = :description WHERE id_user = :id'
					);

					$statement->execute(array(
						':img_route' => $imagenameformat,
						':description' => $desc,
						':id' => $user_id[0][0]
					));	

					//header('Location:' . RUTA . "/profile.php");

				}else{
					$errores = 'your picture must be in jpg or png format';
				}

			}else{
				$errores = 'your picture should be maximum 3 megabytes';
			}
			
		}


		if(isset($fullname)){
				$statement = $conexion->prepare(
				'UPDATE users SET fullname_quote = :fullname_quote WHERE id_user = :id'
				);

				$statement->execute(array(
					':fullname_quote' => "no",
					':id' => $user_id[0][0]
				));
			}else{
				$statement = $conexion->prepare(
				'UPDATE users SET fullname_quote = :fullname_quote WHERE id_user = :id'
				);

				$statement->execute(array(
					':fullname_quote' => "yes",
					':id' => $user_id[0][0]
				));
			}


			header('Location:' . RUTA . "/profile.php");
	}


require 'views/header.php';

require 'views/editprofile.view.php';
 ?>