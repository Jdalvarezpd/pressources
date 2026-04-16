<?php
	require 'admin/config.php'; 
	require 'functions.php'; 

	//NOS CONECTAMOS A LA BASE DE DATOS
	$conexion = func_conexion($bd_config);

	//func_comprobarSession();

	//SI NO EXISTE CONECCION A LA BASE DE DATOS, SE REDIRIGE A LA PAGINA DE ERRORES
	if (!$conexion) {
		header('Location: error.php');
	} 


	if($_SERVER['REQUEST_METHOD'] =='POST'){
	$email = limpiarDatos($_POST['email']);

	$errores = '';

	$consultarUsuario = consultar_existencia_por_email($conexion, $email);

	if($consultarUsuario !=false){

		$key = randHash();
		$link = RUTA . "/newpass.php?key=$key&m=$email";

		$sql = "UPDATE users SET resetkey = :resetkey WHERE email = :email LIMIT 1";

		$statement = $conexion->prepare($sql);

		$statement->execute(array(
				':resetkey' => $key,
				':email' => $email
		));


		#si no hay errores
	    if(!$errores){
	        $enviar_a = "$email";
	        $asunto = "Reset your password pressources";
	        //$mensaje_preparado = "From: Pressources\nGo to the link to reset your password\n";
	        //$mensaje_preparado .= "$link";

	        $mensaje_preparado = '
	        <html>
			<body>
			<p>Click the link below to reset your password</p>
			<a href="'.$link.'">Click Here!!!</a>
			</body>
			</html>
			';
	        /*$cabeceras = 'From: info@pressources.com' . "\r\n" .
	        'X-Mailer: PHP/' . phpversion();
	        $cabeceras .= "Content-type: text/html; charset= iso-8859-1\n";*/

	        $headers  = "Content-type: text/html;" . "\r\n";
	        $headers  .=  "From: info@pressources.com";


	        #enviamos el correo
	        //mail($enviar_a, $asunto, $mensaje_preparado);
	        mail($enviar_a, $asunto, $mensaje_preparado, $headers);
	        $enviado='true';

	        echo "<script type='text/javascript'>confirmar(); 

			function confirmar()
				{
					alert('we you just sent an email with the instructions to reset your password');
					window.location.href = 'index.php';
				} 

			</script>";
	    }

	    //header("Location: $link");
	}else{
		$errores = "The username you entered is incorrect.";
	}
}
	require 'views/resetpassword.view.php';

 ?>