<?php session_start();
	require 'admin/config.php'; 
	require 'functions.php'; 

	//Nos conectamos a la base de datos
	$conexion = func_conexion($bd_config);

	//si al conexion es incorrecta redirigimos a error.php
	if (!$conexion) {
		header('Location: error.php');
	}

	func_comprobarSession();

	$email = $_SESSION['user'];

	$areas_of_exp = obtener_areas($conexion);
	$industrias_usuario = obtener_industrias($conexion);
	$lenguajes_usuario = obtener_idiomas($conexion);


	$user_data = consultar_existencia_por_email($conexion, $email);

	$user_id = consultarID($conexion, $email);

	$newsoutlet = obtener_newsoutlet($conexion, $user_id[0][0]);

	$user_type = $user_data['type'];
	$username = $user_data['name'];
	$userlastname = $user_data['last_name'];
	$user_description = $user_data['description'];

	if($user_data['img_route'] == ''){
		$user_image = 'user.jpg';
	}else{
		$user_image = $user_data['img_route'];
	}

	//Obtener la edad a partir de la fecha de nacimiento
	//date in mm/dd/yyyy format; or it can be in other formats as well
	  $birthDate = $user_data['birth_date'];

	  if($birthDate .= null){
	  //explode the date to get month, day and year
	  $birthDate = explode("-", $birthDate);
	  //get age from date or birthdate
	  $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[2], $birthDate[1], $birthDate[0]))) > date("md")
	    ? ((date("Y") - $birthDate[0]) - 1)
	    : (date("Y") - $birthDate[0]));
	  }

	//Obtengo la ciudad de nacimiento a partir de los arrays
	//$place_of_birth = obtener_pais_residencia($conexion, $user_data['cityfield_origin']);
	$city_residence = $user_data['cityfield_residence'];
	$country_residence = $user_data['countryfield_residence'];
	$city_origin = $user_data['cityfield_origin'];
	$country_origin = $user_data['countryfield_origin'];

	$company = $user_data['company_institution_sources'];


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

	//obtengo los roles de periodistas de la base de datos
	$roles = obtener_sectores($conexion);


require 'views/header.php';
require 'views/profile.view.php';
 ?>