<?php session_start();

//uso del archivo de configuracion
	require 'admin/config.php'; 

	//uso del archivo de funciones
	require 'functions.php'; 

	//NOS CONECTAMOS A LA BASE DE DATOS
	$conexion = func_conexion($bd_config);

	//COMPROBAMOS LA SESION
	func_comprobarSession();

	$needed = '';
	$enviado = '';

	//SI NO EXISTE CONECCION A LA BASE DE DATOS, SE REDIRIGE A LA PAGINA DE ERRORES
	if (!$conexion) {
		header('Location: error.php');
	}

	//OBTENEMOS EL ID DEL USUARIO LOGGEADO
	$email = $_SESSION['user'];
	$user_id = consultarID($conexion, $email);
	$user_id_number = $user_id[0][0];

	$t = obtener_tipo_usuario($conexion, $email);
	$user_type = $t[0][0];
	//echo $user_type;

	$day = '';
	$month = '';
	$gender = '';
	$indone = "-";
	$detailone = '';
	$areaone = '-';
	$areatwo = '-';
	$langone = "...";
	$langtwo = "...";
	$langthree = "...";

	$company = "";
	$description = "";

	$city_origin_hidden = "";
	$country_origin_hidden = "";
	$city_residence_hidden = "";
	$country_residence_hidden = "";



	//SI YA SE HAN ENVIADO LOS DATOS, SE RECIBEN Y SE GUARDAN LOS VALORES EN VARIABLES
	//LOS DATOS SE ESTAN RECIBIENDO POR EL CAMPO (name="")
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$day = limpiarDatos($_POST['day']);
		$month = limpiarDatos($_POST['month']);
		$year = limpiarDatos($_POST['year']);
		$indone = limpiarDatos($_POST['indone']);

		//$areaone = limpiarDatos($_POST['areaone']);
		//$areatwo = limpiarDatos($_POST['areatwo']);

		$langone = limpiarDatos($_POST['langone']);
		$langtwo = limpiarDatos($_POST['langtwo']);
		$langthree = limpiarDatos($_POST['langthree']);

		$detailone = limpiarDatos($_POST['detailone']);

		$city_origin_hidden = limpiarDatos($_POST['origin_city_hidden']);
		$country_origin_hidden = limpiarDatos($_POST['origin_country_hidden']);

		$city_residence_hidden = limpiarDatos($_POST['residence_city_hidden']);
		$country_residence_hidden = limpiarDatos($_POST['residence_country_hidden']);

		$company = limpiarDatos($_POST['company']);
		$description = limpiarDatos($_POST['desc']);

		$place_origin = limpiarDatos($_POST['place_origin']);
		$place_residence = limpiarDatos($_POST['place_residence']);

		if(isset($_POST['1'])){$ar1 = limpiarDatos($_POST['1']);}else{$ar1='-';}
		if(isset($_POST['2'])){$ar2 = limpiarDatos($_POST['2']);}else{$ar2='-';}
		if(isset($_POST['3'])){$ar3 = limpiarDatos($_POST['3']);}else{$ar3='-';}
		if(isset($_POST['4'])){$ar4 = limpiarDatos($_POST['4']);}else{$ar4='-';}
		if(isset($_POST['5'])){$ar5 = limpiarDatos($_POST['5']);}else{$ar5='-';}
		if(isset($_POST['6'])){$ar6 = limpiarDatos($_POST['6']);}else{$ar6='-';}
		if(isset($_POST['7'])){$ar7 = limpiarDatos($_POST['7']);}else{$ar7='-';}
		if(isset($_POST['8'])){$ar8 = limpiarDatos($_POST['8']);}else{$ar8='-';}
		if(isset($_POST['9'])){$ar9 = limpiarDatos($_POST['9']);}else{$ar9='-';}
		if(isset($_POST['10'])){$ar10 = limpiarDatos($_POST['10']);}else{$ar10='-';}
		if(isset($_POST['11'])){$ar11 = limpiarDatos($_POST['11']);}else{$ar11='-';}
		if(isset($_POST['12'])){$ar12 = limpiarDatos($_POST['12']);}else{$ar12='-';}
		if(isset($_POST['13'])){$ar13 = limpiarDatos($_POST['13']);}else{$ar13='-';}
		if(isset($_POST['14'])){$ar14 = limpiarDatos($_POST['14']);}else{$ar14='-';}
		if(isset($_POST['15'])){$ar15 = limpiarDatos($_POST['15']);}else{$ar15='-';}
		if(isset($_POST['16'])){$ar16 = limpiarDatos($_POST['16']);}else{$ar16='-';}
		if(isset($_POST['17'])){$ar17 = limpiarDatos($_POST['17']);}else{$ar17='-';}
		if(isset($_POST['18'])){$ar18 = limpiarDatos($_POST['18']);}else{$ar18='-';}
		if(isset($_POST['19'])){$ar19 = limpiarDatos($_POST['19']);}else{$ar19='-';}
		//echo $ar;

		if(isset($_POST['quote'])){
			$quote = "true";
			echo $quote;
		}

		$ready = true;

		$errores = '';

		$arregloAreas = array($ar1, $ar2, $ar3, $ar4, $ar5, $ar6, $ar7, $ar8, $ar9, $ar10, $ar11, $ar12, $ar13, $ar14, $ar15, $ar16, $ar17, $ar18, $ar19);

		//print_r($arregloAreas);

		//AGREGADO DE AREAS DE EXPERIENCIA DINAMICAS
		for($i = 0; $i<count($arregloAreas); $i++){
			//echo "area " . $arregloAreas[$i];
			if($arregloAreas[$i] == '-'){
				//echo "string";
			}else{
				$guardarArea2 = $conexion->prepare('INSERT INTO users_has_areas(users_id_user, areas_id_area)
				VALUES(:users_id_user, :areas_id_area)');

				$guardarArea2->execute(array(
					':users_id_user' => "$user_id_number",
					':areas_id_area' => $arregloAreas[$i]
				));
			}
		}


		if($month == "2" or $month == "4" or $month == "6" or $month == "9" or $month == "11"){
			if($day > 30){
				$ready = false;
				$needed = '*';
				$errores = $errores .= '<li>Day cant have that value</li>';
			}
		}

		if($day<1 or $day > 31){
			$ready = false;
			$needed = '*';
			$errores = $errores .= '<li>Day field is wrong</li>';
		}

		/*if($year <1900 or $year>2017){
			$ready = false;
			$needed = '*';
			$errores = $errores .= '<li>Year field is wrong</li>';
		}*/

		//CREANDO EL FORMATO DE FECHA PARA ALMACENAR EN LA BASE DE DATOS 
		$birth_date = $year. "-" . $month . "-" . $day;


		//SI TODOE ESTA BIEN PROCEDEMOS A GUARDAR LOS DATOS
		if($ready == true){

			//1	GUARDAMOS LA FECHA DE NACIMIENTO
			if(!empty($year)){
				$statement4 = $conexion->prepare('UPDATE users SET birth_date = :birth_date WHERE id_user = :id_user');
				$statement4->execute(array(
					':birth_date' => $birth_date,
					':id_user' => $user_id_number
				));
			}


			//2	GUARDAMOS LA CIUDAD DE ORIGEN
			if(!empty($city_origin_hidden)){
				$statement = $conexion->prepare('UPDATE users SET cityfield_origin = :cityfield_origin, countryfield_origin = :countryfield_origin WHERE id_user = :id_user');
				$statement->execute(array(
					':cityfield_origin' => $city_origin_hidden,
					':countryfield_origin' => $country_origin_hidden,
					':id_user' => $user_id_number
				));
			}

			//3	GUARDAMOS LA CIUDAD DE RESIDENCIA
			if(!empty($city_residence_hidden)){
				$statement = $conexion->prepare('UPDATE users SET cityfield_residence = :cityfield_residence, countryfield_residence = :countryfield_residence WHERE id_user = :id_user');
				$statement->execute(array(
					':cityfield_residence' => $city_residence_hidden,
					':countryfield_residence' => $country_residence_hidden,
					':id_user' => $user_id_number
				));
			}


			//4. SI EXISTE UN VALOR EN EL PRIMER IDIOMA
			if($langone != "..."){
				$statement4 = $conexion->prepare('INSERT INTO users_has_languages(users_id_user, languages_id_language)
				VALUES(:users_id_user, :languages_id_language)');

				$statement4->execute(array(
					':users_id_user' => "$user_id_number",
					':languages_id_language' => "$langone"
				));
			}

			//5. SI EXISTE UN VALOR EN EL SEGUNDO IDIOMA
			if($langtwo != "..."){
				$segundoIdioma = $conexion->prepare('INSERT INTO users_has_languages(users_id_user, languages_id_language)
				VALUES(:users_id_user, :languages_id_language)');

				$segundoIdioma->execute(array(
					':users_id_user' => "$user_id_number",
					':languages_id_language' => "$langtwo"
				));
			}

			//6. SI EXISTE UN VALOR EN EL TERCER IDIOMA
			if($langthree != "..."){
				$tercerIdioma = $conexion->prepare('INSERT INTO users_has_languages(users_id_user, languages_id_language)
				VALUES(:users_id_user, :languages_id_language)');

				$tercerIdioma->execute(array(
					':users_id_user' => "$user_id_number",
					':languages_id_language' => "$langthree"
				));
			}


			//7. GUARDAMOS SU PROFESION
			if($detailone != "Profession..." && $detailone != ''){

					$statement3 = $conexion->prepare('INSERT INTO users_has_industries(users_id_user, industries_id_industry, detail)
					VALUES(:users_id_user, :industries_id_industry, :detail)');

					$statement3->execute(array(
						':users_id_user' => "$user_id_number",
						':industries_id_industry' => "$indone",
						':detail' => "$detailone"
					));

			}else{
					$statement3 = $conexion->prepare('INSERT INTO users_has_industries(users_id_user, industries_id_industry)
					VALUES(:users_id_user, :industries_id_industry)');

					$statement3->execute(array(
						':users_id_user' => "$user_id_number",
						':industries_id_industry' => "$indone"
					));	
			}


			if($user_type == 'JOURNALIST'){
			//7.1 Guardamos la profesion si ya es journalist
				$statement3 = $conexion->prepare('INSERT INTO users_has_industries(users_id_user, industries_id_industry)
					VALUES(:users_id_user, :industries_id_industry)');

				$statement3->execute(array(
						':users_id_user' => "$user_id_number",
						':industries_id_industry' => 41
				));
				/////////////////////////////////////////////
				////////////////////////////////////////////
			}


			//8	GUARDAMOS COMPANY/ORG/INST
			if(!empty($company)){
				$statement = $conexion->prepare('UPDATE users SET company_institution_sources = :company_institution_sources WHERE id_user = :id_user');
				$statement->execute(array(
					':company_institution_sources' => $company,
					':id_user' => $user_id_number
				));
			}


			//9. SI INCLUYO VALORES EN LAS AREAS DE EXPERIENCIA
			/*if($areaone != "-"){
				$guardarArea = $conexion->prepare('INSERT INTO users_has_areas(users_id_user, areas_id_area)
				VALUES(:users_id_user, :areas_id_area)');

				$guardarArea->execute(array(
					':users_id_user' => "$user_id_number",
					':areas_id_area' => "$areaone"
				));
			}

			//10. SI INCLUYO VALORES EN LA SEGUNDA AREA DE EXPERIENCIA
			if($areatwo != "-"){
				$guardarArea2 = $conexion->prepare('INSERT INTO users_has_areas(users_id_user, areas_id_area)
				VALUES(:users_id_user, :areas_id_area)');

				$guardarArea2->execute(array(
					':users_id_user' => "$user_id_number",
					':areas_id_area' => "$areatwo"
				));
			}*/

			/*for(int $i=0; $i<2; $i++){

			}*/

			//11 GUARDAMOS LA DESCRIPCION
			if(!empty($description)){
				$statement = $conexion->prepare('UPDATE users SET description = :description WHERE id_user = :id_user');
				$statement->execute(array(
					':description' => $description,
					':id_user' => $user_id_number
				));
			}

			//12 SI ES UN JOURNALIST ACTUALIZAMOS SU TIPO A JOURNALIST/SOURCE
			 if($user_type == "JOURNALIST"){
				$statement = $conexion->prepare('UPDATE users SET type = :type WHERE id_user = :id_user');
				$statement->execute(array(
					':type' => "JOURNALIST/SOURCE",
					':id_user' => $user_id_number
				));
			 }

			 //13 GUARDAMOS EL LUGAR DE ORIGEN
			if(!empty($place_origin)){
				$statement = $conexion->prepare('UPDATE users SET place_origin = :place_origin WHERE id_user = :id_user');
				$statement->execute(array(
					':place_origin' => $place_origin,
					':id_user' => $user_id_number
				));
			}

			 //14 GUARDAMOS EL LUGAR DE RESIDENCIA
			if(!empty($place_residence)){
				$statement = $conexion->prepare('UPDATE users SET place_residence = :place_residence WHERE id_user = :id_user');
				$statement->execute(array(
					':place_residence' => $place_residence,
					':id_user' => $user_id_number
				));
			}

			if(!empty($quote)){
				$statement = $conexion->prepare('UPDATE users SET fullname_quote = :fullname_quote WHERE id_user = :id_user');
				$statement->execute(array(
					':fullname_quote' => "no",
					':id_user' => $user_id_number
				));
			}



			//SI TODO ES CORRECTO LO ENVIAMOS AL PERFIL
			header('Location:' . RUTA . "/profile.php");
			
		}
	}

	//Obtengo los posts de la base de datos
	$languages = obtener_idiomas($conexion);
	//print_r($posts);

	//Obtengo los posts de la base de datos
	$professions = obtener_industrias($conexion);

	//Obtengo los posts de la base de datos
	$areas = obtener_areas($conexion);

require 'views/header.php';

require 'views/register_s_2.view.php';
 ?>