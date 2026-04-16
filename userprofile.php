<?php session_start();
	require 'admin/config.php'; 
	require 'functions.php'; 

	//Nos conectamos a la base de datos
	$conexion = func_conexion($bd_config);

	//si al conexion es incorrecta redirigimos a error.php
	if (!$conexion) {
		header('Location: error.php');
	}	

	if(empty($_SESSION['admin'])){
		func_comprobarSession();
	}
	

	$id = id_user_convertir($_GET['id']);

	//SI EL ID DEL USUARIO ESTA VACIO REDIRIGIMOS
	if(empty($id)){
		header('Location: index.php');
	}

	//SI EL ID DEL USUARIO NO EXISTE REDIRIGIMOS
	if(!validar_existencia_usuario($conexion, $id)){
		header('Location: index.php');
	}

	$user = obtener_usuarios_por_id($conexion, $id);

	if($user[0]['birth_date'] != ""){

	//Obtener la edad a partir de la fecha de nacimiento
	//date in mm/dd/yyyy format; or it can be in other formats as well
	  $birthDate = $user[0]['birth_date'];
	  //explode the date to get month, day and year
	  $birthDate = explode("-", $birthDate);
	  //get age from date or birthdate
	  $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[2], $birthDate[1], $birthDate[0]))) > date("md")
	    ? ((date("Y") - $birthDate[0]) - 1)
	    : (date("Y") - $birthDate[0]));
}else{
	$age = "";
}

	//print_r($user);
	//$id_user = 11;

	if($user[0]['img_route'] == ''){
		$userimg = 'user.jpg';
	}else{
		$userimg = $user[0]['img_route'];
	}

//////////////////////////////////Obtener lenguajes y los nombres de los lenguajes///////////////////
	 $lang = obtener_idiomas_usuario($conexion, $id);
	 $lang_name = array();

	 for($i = 0; $i<count($lang); $i++){
	 	 $new_language = obtener_nombre_idioma($conexion, $lang[$i][0]);
	 	 array_push($lang_name, $new_language);
	 }

//////////////////////////Obtener Industrias y nombres de las industrias///////////////////
	 $ind = obtener_industrias_usuario($conexion, $id);
	 //print_r($ind);
	 $ind_name = array();
	 for($i = 0; $i<count($ind); $i++){
	 	 $new_ind = obtener_nombre_idustria($conexion, $ind[$i][0]);
	 	 array_push($ind_name, $new_ind);
	 }
	 //print_r($ind_name);
////////////////////////////////////////////////////////////////////////////////////////////////
	 $area = obtener_areas_usuario($conexion, $id);
	 $area_name = array();

	 for($i = 0; $i<count($area); $i++){
	 	 $new_area = obtener_nombre_area($conexion, $area[$i][0]);
	 	 array_push($area_name, $new_area);
	 }



	$errores = '';
	$enviado = '';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $mensaje = $_POST['mensaje'];

    //echo "nombre:".$nombre;
    //echo "mail:".$correo;
    //echo "msj:".$mensaje;

    if(!empty($nombre)){
        #quitamos los espacios en el nombre
        $nombre = trim($nombre);
        #quitamos caracteres especiales
        $nombre = filter_var($nombre,FILTER_SANITIZE_STRING);
    }else{
        $errores .= 'Please type your name <br />';
    }

    if(!empty($correo)){
        #quitamos caracteres especiales
        $correo = filter_var($correo,FILTER_SANITIZE_EMAIL);

        #Comprobamos que sea un correo valido
        if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
            $errores .= 'Please use a valid email <br />';
        }
    }else{
        $errores .= 'Please type an email <br />';
    }

    if(!empty($mensaje)){
        #de esta manera podemos evitar que inyecten codigo en los campos de texto
        $mensaje = htmlspecialchars($mensaje);
        $mensaje = trim($mensaje);
        $mensaje = stripcslashes($mensaje);
    }else{
        $errores .= 'Write a message';
    }

    $m = $user[0]['email'];

    #si no hay errores
    if(!$errores){
        $enviar_a = "$m";
        $asunto = "Sent by Pressources";
        $mensaje_preparado = "From: $nombre \n";
        $mensaje_preparado .= "Email: $correo \n";
        $mensaje_preparado .= "Message: " . $mensaje;
        $cabeceras = 'From: info@pressources.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

        //Copia de envio a pressorces
        $copy_enviar_a = "pressources5@gmail.com";
        $copy_asunto = "Contact Notification";
        $copy_mensaje_preparado = "From: $nombre \n";
        $copy_mensaje_preparado .= "Email: $correo \n";
        $copy_mensaje_preparado .= "Message: " . $mensaje . "\n";
        $copy_mensaje_preparado .= "(by: " . $_SESSION['user'] . " From: " . "$m)";

        #enviamos el correo
        //mail($enviar_a, $asunto, $mensaje_preparado);
        mail($enviar_a, $asunto, $mensaje_preparado, $cabeceras);

        mail($copy_enviar_a, $copy_asunto, $copy_mensaje_preparado, $cabeceras);
        $enviado='true';

    }
}


require 'views/header.php';
require 'views/userprofile.view.php';
 ?>