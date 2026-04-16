<?php session_start();
	//uso del archivo de configuracion
	require 'admin/config.php'; 

	//uso del archivo de funciones
	require 'functions.php'; 

	//NOS CONECTAMOS A LA BASE DE DATOS
	$conexion = func_conexion($bd_config);

	//COMPROBAMOS LA SESION
	func_comprobarSession();

	//COMPROBAMOS QUE LA PAGINA ANTERIOR
	/*$pagina_anterior = '';
	if(isset($_SERVER['HTTP_REFERER'])){
		$pagina_anterior=$_SERVER['HTTP_REFERER'];
	}*/

	//SI NO EXISTE CONECCION A LA BASE DE DATOS, SE REDIRIGE A LA PAGINA DE ERRORES
	if (!$conexion) {
		header('Location: error.php');
	}

	//OBTENEMOS EL ID DEL USUARIO LOGGEADO
	$email = $_SESSION['user'];
	$user_id = consultarID($conexion, $email);
	$user_id_number = $user_id[0][0];

	$sector = "-";
	$langone = "...";
	$langtwo = "...";
	$langthree = "...";

	//SI EL USUARIO VIENE DE LA PAGINA DE REGISTRO DE JOURNALIST
	if($user_id = $user_id){
		//echo "viene de registro de journalist";
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$sector = limpiarDatos($_POST['sector']);
			$posnews = limpiarDatos($_POST['posnews']);
			$newsinst = limpiarDatos($_POST['newsinst']);
			$langone = limpiarDatos($_POST['langone']);
			$langtwo = limpiarDatos($_POST['langtwo']);
			$langthree = limpiarDatos($_POST['langthree']);
			$journalink = limpiarDatos($_POST['journalink']);


			//COMPROBAMOS SI LA VARIABLE ESTA VACIA
			if($sector != ""){
				//1. DESPUES DE OBTENER EL ID DEL USUARIO PROCEDEMOS A GUARDAR SU PROFESION
				if($posnews == "-"){
					$statement3 = $conexion->prepare('INSERT INTO users_has_sectors(users_id_user, sectors_id_sector)
					VALUES(:users_id_user, :sectors_id_sector)');

					$statement3->execute(array(
						':users_id_user' => "$user_id_number",
						':sectors_id_sector' => "$sector"
					));

				}else{
					$statement3 = $conexion->prepare('INSERT INTO users_has_sectors(users_id_user, sectors_id_sector, id_posnews)
					VALUES(:users_id_user, :sectors_id_sector, :id_posnews)');

					$statement3->execute(array(
						':users_id_user' => "$user_id_number",
						':sectors_id_sector' => "$sector",
						':id_posnews' => "$posnews"
					));
				}
			}


			//2. GUARDAMOS EL CAMPO DE NEWS OUTLET SOLO SI ESTA LLENO
			if(empty($newsinst)){

			}else{
				$statement4 = $conexion->prepare('UPDATE users SET newsoutlet_institution = :newsoutlet_institution WHERE id_user = :id_user');
				$statement4->execute(array(
					':newsoutlet_institution' => $newsinst,
					':id_user' => $user_id_number
				));
			}



			//3. SI EXISTE UN VALOR EN EL PRIMER IDIOMA
			if($langone != "..."){
				$statement4 = $conexion->prepare('INSERT INTO users_has_languages(users_id_user, languages_id_language)
				VALUES(:users_id_user, :languages_id_language)');

				$statement4->execute(array(
					':users_id_user' => "$user_id_number",
					':languages_id_language' => "$langone"
				));
			}

			//4. SI EXISTE UN VALOR EN EL SEGUNDO IDIOMA
			if($langtwo != "..."){
				$segundoIdioma = $conexion->prepare('INSERT INTO users_has_languages(users_id_user, languages_id_language)
				VALUES(:users_id_user, :languages_id_language)');

				$segundoIdioma->execute(array(
					':users_id_user' => "$user_id_number",
					':languages_id_language' => "$langtwo"
				));
			}

			//5. SI EXISTE UN VALOR EN EL TERCER IDIOMA
			if($langthree != "..."){
				$tercerIdioma = $conexion->prepare('INSERT INTO users_has_languages(users_id_user, languages_id_language)
				VALUES(:users_id_user, :languages_id_language)');

				$tercerIdioma->execute(array(
					':users_id_user' => "$user_id_number",
					':languages_id_language' => "$langthree"
				));
			}

			//6. GUARDAMOS EL CAMPO DEL LINK
			if(empty($journalink)){

			}else{
				$statement4 = $conexion->prepare('UPDATE users SET journalink = :journalink WHERE id_user = :id_user');
				$statement4->execute(array(
					':journalink' => $journalink,
					':id_user' => $user_id_number
				));
			}


			echo "<script type='text/javascript'>confirmar(); 

			function confirmar()
				{
				if (confirm('Register as a source too')==false)
				{
					window.location.href='searchprofile.php'
				return false;
				}
				else
				{
					window.location.href='register_s_2.php'
				return true;
				}
				} 

			</script>";

			//SI TODO ES CORRECTO LO ENVIAMOS AL INICIO
			//header('Location:' . RUTA . "/searchprofile.php");
		}

		
	//SI NO VIENE DE REGISTRO DE JOURNALIST LO ENVIAMOS A HOME
	}else{
		//echo "no viene de registro";
		header('Location:' . RUTA);	
	}

	//obtengo los roles de periodistas de la base de datos
	$roles = obtener_sectores($conexion);

	//Obtengo los posts de la base de datos
	$languages = obtener_idiomas($conexion);

	require 'views/header.php';

	require 'views/register_j_2.view.php';
?>