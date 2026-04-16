<?php session_start();
	require 'admin/config.php'; 
	require 'functions.php'; 

	/*Nos conectamos a la base de datos y en caso de ser incorrecta redirigimos a la pagina de error*/
	$conexion = func_conexion($bd_config);
	if (!$conexion) {
		header('Location: error.php');
	}

	$errores = '';
	$enviado = '';

	$users_index = array();

	if(isset($_SESSION['user'])){
	    $typeuser = obtener_tipo_usuario($conexion, $_SESSION['user']);

	    if($typeuser[0]["type"] == "JOURNALIST" || $typeuser[0]["type"] == "JOURNALIST/SOURCE"){
	    	$users_index = $conexion->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM users ORDER BY RAND() LIMIT 3");
	        $users_index->execute();
	        $users_index = $users_index->fetchAll();
	    }
     }

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $mensaje = $_POST['mensaje'];

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

    #si no hay errores
    if(!$errores){
        $enviar_a = "pressources5@gmail.com";
        $asunto = "Sended from Pressources";
        $mensaje_preparado = "From: $nombre \n";
        $mensaje_preparado .= "Email: $correo \n";
        $mensaje_preparado .= "Message: " . $mensaje;
        $cabeceras = 'From: info@pressources.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

        #enviamos el correo
        //mail($enviar_a, $asunto, $mensaje_preparado);
        mail($enviar_a, $asunto, $mensaje, $cabeceras);
        $enviado='true';

    }


}

	require 'views/header.php';
	require 'views/index.view.php';
 ?>