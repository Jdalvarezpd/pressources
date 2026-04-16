<?php session_start();

//uso del archivo de configuracion
	require 'admin/config.php'; 

	//uso del archivo de funciones
	require 'functions.php'; 

	//NOS CONECTAMOS A LA BASE DE DATOS
	$conexion = func_conexion($bd_config);

	$needed = '';
	$enviado = '';

	//SI NO EXISTE CONECCION A LA BASE DE DATOS, SE REDIRIGE A LA PAGINA DE ERRORES
	if (!$conexion) {
		header('Location: error.php');
	}

	if(isset($_SESSION['user'])){
		header('Location: ' . RUTA);
	}
	$day = '';
	$month = '';
	$gender = '';
	$sector = "-";


	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$name = limpiarDatos($_POST['name']);
		$last = limpiarDatos($_POST['last']);
		$mail = limpiarDatos($_POST['mail']);
		$pass = limpiarDatos($_POST['pass']);
		$pass2 = limpiarDatos($_POST['pass2']);
		$gender = limpiarDatos($_POST['gender']);
		$day = limpiarDatos($_POST['day']);
		$month = limpiarDatos($_POST['month']);
		$year = limpiarDatos($_POST['year']);
		$newsinst = limpiarDatos($_POST['newsinst']);
		$sector = limpiarDatos($_POST['sector']);
		//$countryres = limpiarDatos($_POST['countryres']);
		//$cityres = limpiarDatos($_POST['cityres']);
		//$countryorig = limpiarDatos($_POST['countryorig']);
		//$cityorig = limpiarDatos($_POST['cityorig']);

		//$cityfield_res = limpiarDatos($_POST['cityfield_res']);
		//$cityfield_orig = limpiarDatos($_POST['cityfield_orig']);

		$city_origin_hidden = limpiarDatos($_POST['origin_city_hidden']);
		$country_origin_hidden = limpiarDatos($_POST['origin_country_hidden']);

		$city_residence_hidden = limpiarDatos($_POST['residence_city_hidden']);
		$country_residence_hidden = limpiarDatos($_POST['residence_country_hidden']);

		echo $sector;

		$posnews = limpiarDatos($_POST['posnews']);
		//echo $posnews;

		//CIUDAD DEFAULT MIENTRAS SE SOLUCIONA EL PROBLEMA DE LA ELECCION DE CIUDADES EN LA LISTA DESPLEGABLE
		//$cityres = "1";
		//$cityorig = "1";
		//////////////////////////////////////////////////////////////////////////////////////////////////////

		$ready = true;

		$errores = '';

		$pass_encrypted = password_hash($pass, PASSWORD_DEFAULT, array("cost" =>12));

		if(strlen($pass) < 8){
			$ready = false;
			$needed = '*';
			$errores = $errores .= '<li>The password must contain at least eight characters</li>';
		}

		if($month == "2" or $month == "4" or $month == "6" or $month == "9" or $month == "11"){
			if($day > 30){
				$ready = false;
				$needed = '*';
				$errores = $errores .= '<li>Day cant have that value</li>';
			}
		}


		if(empty($name) or empty($last) or empty($mail) or empty($pass) or empty($pass2)){
			$ready = false;
			$needed = '*';
			$errores = $errores .= '<li>Some fields are empty</li>';
		}

		if($day<1 or $day > 31){
			$ready = false;
			$needed = '*';
			$errores = $errores .= '<li>Day field is wrong</li>';
		}

		if($year <1900 or $year>2017){
			$ready = false;
			$needed = '*';
			$errores = $errores .= '<li>Year field is wrong</li>';	
		}

		if(empty($city_origin_hidden)){
			$ready = false;
			$needed = '*';
			$errores = $errores .= '<li>You have to put your city of origin</li>';
		}

		if(empty($city_residence_hidden)){
			$ready = false;
			$needed = '*';
			$errores = $errores .= '<li>You have to put your city of residence</li>';
		}

		/*if($countryres == "-"){
			$ready = false;
			$needed = '*';
			$errores = $errores .= '<li>You have to put your country of residence</li>';
		}

		if($countryorig == "-"){
			$ready = false;
			$needed = '*';
			$errores = $errores .= '<li>You have to put your country of origin</li>';
		}

		if(empty($cityfield_orig)){
			$ready = false;
			$needed = '*';
			$errores = $errores .= '<li>You have to put your city of origin</li>';
		}	

		if(empty($cityfield_res)){
			$ready = false;
			$needed = '*';
			$errores = $errores .= '<li>You have to put your city of residence</li>';
		}		
	

		if($cityres == "-"){
			$ready = false;
			$needed = '*';
			$errores = $errores .= '<li>You have to put your city of residence</li>';
		}

		if($cityorig == "-"){
			$ready = false;
			$needed = '*';
			$errores = $errores .= '<li>You have to put your city of origin</li>';
		}
		*/

		if($sector == "-"){
			$ready = false;
			$needed = '*';
			$errores = $errores .= '<li>You have to put your sector in the news outlet</li>';
		}

		if($pass != $pass2){
			$ready = false;
			$needed = '*';
			$errores = $errores .= '<li>The two passwords do not match</li>';
		}

		if(isset($_POST['terms']) && $_POST['terms']!=""){
			//echo "is checked";
		}else{
			$ready = false;
			$needed = '*';
			$errores = $errores .= '<li>You have to accept the terms and conditions</li>';
		}


		//CREANDO EL FORMATO DE FECHA PARA ALMACENAR EN LA BASE DE DATOS 
		$birth_date = $year. "-" . $month . "-" . $day;

		//CREAN EL VALOR DE LA VARIABLE PARA EL CAMPO DE TIPO DE USUARIO (type: SOURCE/JOURNALIST)
		$type = "JOURNALIST";

		//COMPROBAR SI EL EMAIL EXISTE YA EN LA BASE DE DATOS
		$comprobarEmail = consultar_existencia_por_email($conexion, $mail);


		if($ready == true){

			if($comprobarEmail != false){
			$errores = $errores .= '<li>The email address already exists in our database</li>';

			//SI EL EMAIL NO EXISTE, SE CONTINUA PARA MANDAR LOS DATOS A ALMACENAR	
			}else{


			if(empty($newsinst)){
				$statement2 = $conexion->prepare('INSERT INTO users(name, last_name, email, password, gender, birth_date, type, cityfield_origin, cityfield_residence, countryfield_origin, countryfield_residence)
				VALUES (:name, :last_name, :email, :password, :gender, :birth_date, :type, :cityfield_origin, :cityfield_residence, :countryfield_origin, :countryfield_residence)');

				$statement2->execute(array(
				':name' => $name,
				':last_name' => $last,
				':email' => $mail,
				':password' => $pass_encrypted,
				':gender' => $gender,
				':birth_date' => $birth_date,
				':type' => "$type",
				':cityfield_origin' => $city_origin_hidden,
				':cityfield_residence' => $city_residence_hidden,
				':countryfield_origin' => $country_origin_hidden,
				':countryfield_residence' => $country_residence_hidden
				));

			}else{
				$statement2 = $conexion->prepare('INSERT INTO users(name, last_name, email, password, gender, newsoutlet_institution, birth_date, type, cityfield_origin, cityfield_residence, countryfield_origin, countryfield_residence)
				VALUES (:name, :last_name, :email, :password, :gender, :newsoutlet_institution, :birth_date, :type, :cityfield_origin, :cityfield_residence, :countryfield_origin, :countryfield_residence)');

				$statement2->execute(array(
				':name' => $name,
				':last_name' => $last,
				':email' => $mail,
				':password' => $pass_encrypted,
				':gender' => $gender,
				':newsoutlet_institution' => $newsinst,
				':birth_date' => $birth_date,
				':type' => "$type",
				':cityfield_origin' => $city_origin_hidden,
				':cityfield_residence' => $city_residence_hidden,
				':countryfield_origin' => $country_origin_hidden,
				':countryfield_residence' => $country_residence_hidden
				));
			}

			//CONSULTAR EL NUMERO DEL ID DEL USUARIO RECIEN CREADO EN LA BASE DE DATOS
			//DE ESTA MANERA SE PUEDE PROCEDER A REGISTRAR LOS IDIOMAS, LAS PROFESIONES Y LAS AREAS DE EXPERIENCIA CON ESE NUMERO DE ID (id_user)
			//ES NECESARIA HACER LA CONSULTA YA QUE NO SE CONOCE EL NUMERO DE ID DE USUARIO SINO HASTA QUE SE CREA EN LA BASE DE DATOS - DESPUES LO CONSULTAMOS
			$consultaID = consultarID($conexion, $mail);
			$numerodeID = $consultaID[0]["id_user"];


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//1. DESPUES DE OBTENER EL ID DEL USUARIO PROCEDEMOS A GUARDAR SU PROFESION

			if($posnews == "-"){
				$statement3 = $conexion->prepare('INSERT INTO users_has_sectors(users_id_user, sectors_id_sector)
				VALUES(:users_id_user, :sectors_id_sector)');

				$statement3->execute(array(
					':users_id_user' => "$numerodeID",
					':sectors_id_sector' => "$sector"
				));

			}else{
				$statement3 = $conexion->prepare('INSERT INTO users_has_sectors(users_id_user, sectors_id_sector, id_posnews)
				VALUES(:users_id_user, :sectors_id_sector, :id_posnews)');

				$statement3->execute(array(
					':users_id_user' => "$numerodeID",
					':sectors_id_sector' => "$sector",
					':id_posnews' => "$posnews"
				));
			}



			


			//echo '<script type="text/javascript"> alert("Good"); </script>';

			if(!$errores){
				$enviado = 'true';
			}

			$_SESSION['user'] = $mail;

			//SI TODO ES CORRECTO LO ENVIAMOS AL INICIO
			header('Location:' . RUTA . "/welcome.php");

			}

		}

	}

	//obtengo los roles de periodistas de la base de datos
	$roles = obtener_sectores($conexion);

	//Obtengo los paises de la base de datos
	//$countries = obtener_paises($conexion);

	//Obtengo las ciudades de la base de datos
	//$cities = obtener_ciudades($conexion);

require 'views/header.php';

require 'views/register.view.php';
 ?>