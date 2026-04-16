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

	//SI YA SE HAN ENVIADO LOS DATOS, SE RECIBEN Y SE GUARDAN LOS VALORES EN VARIABLES
	//LOS DATOS SE ESTAN RECIBIENDO POR EL CAMPO (name="")
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$name = limpiarDatos($_POST['name']);
		$last = limpiarDatos($_POST['last']);
		$mail = limpiarDatos($_POST['mail']);
		$pass = limpiarDatos($_POST['pass']);
		$pass2 = limpiarDatos($_POST['pass2']);

		$ready = true;

		$errores = '';

		$pass_encrypted = password_hash($pass, PASSWORD_DEFAULT, array("cost" =>12));

		if(strlen($pass) < 8){
			$ready = false;
			$needed = '*';
			$errores = $errores .= '<li>The password must contain at least eight characters</li>';
		}

		if(empty($name) or empty($last) or empty($mail) or empty($pass) or empty($pass2)){
			$ready = false;
			$needed = '*';
			$errores = $errores .= '<li>Some fields are empty</li>';
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

		//CREAN EL VALOR DE LA VARIABLE PARA EL CAMPO DE TIPO DE USUARIO (type: SOURCE/JOURNALIST)
		$type = "SOURCE";

		//COMPROBAR SI EL EMAIL EXISTE YA EN LA BASE DE DATOS
		$comprobarEmail = consultar_existencia_por_email($conexion, $mail);

		if($ready == true){
		if($comprobarEmail != false){
			$errores = $errores .= '<li>The email address already exists in our database</li>';

		//SI EL EMAIL NO EXISTE, SE CONTINUA PARA MANDAR LOS DATOS A ALMACENAR	
		}else{
			//echo "No Existe";

			$statement2 = $conexion->prepare('INSERT INTO users(name, last_name, email, password, type)
			VALUES (:name, :last_name, :email, :password, :type)');

			$statement2->execute(array(
			':name' => $name,
			':last_name' => $last,
			':email' => $mail,
			':password' => $pass_encrypted,
			':type' => $type
			));


			//SI NO HAY ERRORES
			if(!$errores){
				$enviado = 'true';
			}


			$_SESSION['user'] = $mail;

			$cabeceras = 'From: info@pressources.com' . "\r\n" .'X-Mailer: PHP/' . phpversion();
			$msj = 'Hi ' . $name . "\n\n" . 'Welcome to Pressources!' . "\n" . 'We invite you to visit our website www.pressources.com and keep your profile updated, upload a picture and write a short paragraph about yourself.' . "\n\n" . 'Sincerely,' . "\n\n" . 'The Pressources Team';
				mail($mail, "Welcome to Pressources", $msj, $cabeceras);

			//SI TODO ES CORRECTO LO ENVIAMOS AL INICIO
			header('Location:' . RUTA . "/register_s_2.php");

			
		}

	}

	}

require 'views/header.php';

require 'views/register_s.view.php';
 ?>