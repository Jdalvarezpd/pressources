<?php 

//Funcion de conexion a base de datos
function func_conexion($bd_config){
	try {
		$conexion = new PDO('mysql:host='.$bd_config['host'].';dbname='.$bd_config['basedatos'], $bd_config['usuario'], $bd_config['pass']);

		return $conexion;

	} catch (PDOException $e) {
		return false;
	}
}

//Funcion para comprobar si se inicio sesion correctamente y de esta manera no se puede acceder a la carpeta admin por medio de la url
function func_comprobarSession(){
	if(!isset($_SESSION['user'])){
		header('Location: ' . RUTA);

		echo $_SESSION['user'];
	}
}

function func_comprobarSession_Admin(){
	if(!isset($_SESSION['admin'])){
		header('Location: ' . RUTA);

		echo $_SESSION['admin'];
	}
}

//funcion para limpiar los datos
function limpiarDatos($datos){
//la funcion trim elimina espacios al principio y al final del texto
	$datos = trim($datos);
	//la funcion stripcslashes nos quita las barras y nos concatena para que no se pueda inyectar codigo
	$datos = stripcslashes($datos);
	//quita caracteres especiales para que no se pueda inyectar codigo
	$datos = htmlspecialchars($datos);
	return $datos;
}

//Funcion para obtener idiomas
function obtener_idiomas($conexion){
	$sentencia = $conexion->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM languages ORDER BY name_language");
	$sentencia->execute();
	return $sentencia->fetchAll();
}

//Funcion para obtener industrias
function obtener_industrias($conexion){
	$sentencia = $conexion->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM industries ORDER BY name_industry");
	$sentencia->execute();
	return $sentencia->fetchAll();
}

//Funcion para obtener areas
function obtener_areas($conexion){
	$sentencia = $conexion->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM areas ORDER BY name_area");
	$sentencia->execute();
	return $sentencia->fetchAll();
}

//Funcion para obtener roles de periodistas
function obtener_sectores($conexion){
	$sentencia = $conexion->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM sectors");
	$sentencia->execute();
	return $sentencia->fetchAll();
}

//FUNCION PARA CONSULTAR EL ID DEL USUARIO POR MEDIO DEL EMAIL
function consultarID($conexion, $email){
	$sentencia = $conexion->prepare("SELECT id_user FROM users where email = '$email'");
	$sentencia->execute();
	return $sentencia->fetchAll();
}

//FUNCION PARA CONSULTAR SI UN EMAIL YA ESTA REGISTRADO EN LA BASE DE DATOS
function consultar_existencia_por_email($conexion, $email){
	$sentencia = $conexion->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
	$sentencia->execute(array(':email' => $email));
	$resultado = $sentencia->fetch();
	return $resultado;
}

//FUNCION PARA VALIDAR EL LOGIN
function validar_login($conexion, $email, $pass){
	$sentencia = $conexion->prepare('SELECT * FROM users WHERE email = :email AND password = :pass LIMIT 1');
	$sentencia->execute(array(':email' => $email, ':pass' =>$pass));
	$resultado = $sentencia->fetch();
	return $resultado;
}

function validar_existencia_usuario($conexion, $id){
	$sentencia = $conexion->prepare('SELECT * FROM users WHERE id_user = :id LIMIT 1');
	$sentencia->execute(array(':id' => $id));
	$resultado = $sentencia->fetch();
	return $resultado;
}

//FUNCION PARA OBTENER TIPO DE USUARIO
function obtener_tipo_usuario($conexion, $email){
	$sentencia = $conexion->prepare("SELECT type FROM users WHERE email = '$email' LIMIT 1");
	$sentencia->execute();
	return $sentencia->fetchAll();
}

//funcion para obtener el numero de paginas necesarias
function numero_paginas($post_por_pagina, $conexion){
	$total_post = $conexion->prepare('SELECT FOUND_ROWS() as total');
	$total_post->execute();
	$total_post = $total_post->fetch()['total'];

	$numero_paginas = ceil($total_post / $post_por_pagina);
	return $numero_paginas;
}

//retornamos el numero de la pagina donde nos encontramos
function func_pagina_actual(){
	return isset($_GET['p']) ? (int)$_GET['p'] : 1;
}


/*function obtener_usuarios($conexion, $indsearch, $city_residence, $users_per_page){
	//si la pagina actual es mayor a 1 entonces tomamos el resultado de la pagina actual y lo multiplicamos por los post por pagina menos los postporpagina, de otra forma es 0 
	$inicio = (func_pagina_actual() > 1) ? func_pagina_actual() * $post_por_pagina - $post_por_pagina : 0;

	$sentencia = $conexion->prepare("SELECT id_user, name, last_name, name_industry, cityfield_residence, countryfield_residence, img_route FROM users INNER JOIN users_has_industries ON id_user = users_id_user INNER JOIN industries ON industries_id_industry = id_industry WHERE (id_industry = '$indsearch' AND cityfield_residence = '$city_residence' AND (type = 'SOURCE' OR type = 'JOURNALIST/SOURCE')) OR (id_industry = '$indsearch' AND cityfield_origin = '$city_residence' AND (type = 'SOURCE' OR type = 'JOURNALIST/SOURCE')) LIMIT $inicio, $users_per_page");
	$sentencia->execute();
	return $sentencia->fetchAll();
}*/

function obtener_usuarios($conexion, $indsearch, $place, $users_per_page){
	//si la pagina actual es mayor a 1 entonces tomamos el resultado de la pagina actual y lo multiplicamos por los post por pagina menos los postporpagina, de otra forma es 0 
	$inicio = (func_pagina_actual() > 1) ? func_pagina_actual() * $post_por_pagina - $post_por_pagina : 0;

	$sentencia = $conexion->prepare("SELECT * FROM users INNER JOIN users_has_industries ON id_user = users_id_user INNER JOIN industries ON industries_id_industry = id_industry WHERE (id_industry = '$indsearch' AND place_residence LIKE '%$place%' AND (type = 'SOURCE' OR type = 'JOURNALIST/SOURCE')) OR (id_industry = '$indsearch' AND place_origin LIKE '%$place%' AND (type = 'SOURCE' OR type = 'JOURNALIST/SOURCE')) LIMIT $inicio, $users_per_page");
	$sentencia->execute();
	return $sentencia->fetchAll();
}

/*function obtener_usuarios_por_ciudad($conexion, $city_residence, $users_per_page){
	//si la pagina actual es mayor a 1 entonces tomamos el resultado de la pagina actual y lo multiplicamos por los post por pagina menos los postporpagina, de otra forma es 0 
	$inicio = (func_pagina_actual() > 1) ? func_pagina_actual() * $post_por_pagina - $post_por_pagina : 0;

	//$sentencia = $conexion->prepare("SELECT * FROM users WHERE cityfield_residence = '$city_residence' LIMIT $inicio, $users_per_page");
	$sentencia = $conexion->prepare("SELECT id_user, name, last_name, name_industry, cityfield_residence, countryfield_residence FROM users INNER JOIN users_has_industries on id_user = users_id_user INNER JOIN industries on industries_id_industry = id_industry WHERE cityfield_residence = '$city_residence' LIMIT $inicio, $users_per_page");
	$sentencia->execute();
	return $sentencia->fetchAll();
}*/

/*function obtener_usuarios_por_ciudad($conexion, $city_residence, $users_per_page){
	//si la pagina actual es mayor a 1 entonces tomamos el resultado de la pagina actual y lo multiplicamos por los post por pagina menos los postporpagina, de otra forma es 0 
	$inicio = (func_pagina_actual() > 1) ? func_pagina_actual() * $post_por_pagina - $post_por_pagina : 0;

	//$sentencia = $conexion->prepare("SELECT * FROM users WHERE cityfield_residence = '$city_residence' LIMIT $inicio, $users_per_page");
	$sentencia = $conexion->prepare("SELECT id_user, name, last_name, cityfield_residence, countryfield_residence, img_route FROM users WHERE (cityfield_residence = '$city_residence' OR cityfield_origin = '$city_residence') AND (type = 'SOURCE' OR type = 'JOURNALIST/SOURCE') LIMIT $inicio, $users_per_page");
	$sentencia->execute();
	return $sentencia->fetchAll();
}*/

function obtener_usuarios_por_ciudad($conexion, $place, $users_per_page){
	//si la pagina actual es mayor a 1 entonces tomamos el resultado de la pagina actual y lo multiplicamos por los post por pagina menos los postporpagina, de otra forma es 0 
	$inicio = (func_pagina_actual() > 1) ? func_pagina_actual() * $post_por_pagina - $post_por_pagina : 0;

	//$sentencia = $conexion->prepare("SELECT * FROM users WHERE cityfield_residence = '$city_residence' LIMIT $inicio, $users_per_page");
	$sentencia = $conexion->prepare("SELECT * FROM users WHERE (place_origin LIKE '%$place%' OR place_residence LIKE '%$place%') AND (type = 'SOURCE' OR type = 'JOURNALIST/SOURCE') LIMIT $inicio, $users_per_page");
	$sentencia->execute();
	return $sentencia->fetchAll();
}

function obtener_usuarios_por_industrias($conexion, $indsearch, $users_per_page){
	//si la pagina actual es mayor a 1 entonces tomamos el resultado de la pagina actual y lo multiplicamos por los post por pagina menos los postporpagina, de otra forma es 0 
	$inicio = (func_pagina_actual() > 1) ? func_pagina_actual() * $post_por_pagina - $post_por_pagina : 0;

	$sentencia = $conexion->prepare("SELECT id_user, name, last_name, name_industry, cityfield_residence, countryfield_residence, img_route FROM users INNER JOIN users_has_industries on id_user = users_id_user INNER JOIN industries on industries_id_industry = id_industry WHERE id_industry = '$indsearch' AND (type = 'SOURCE' OR type = 'JOURNALIST/SOURCE') LIMIT $inicio, $users_per_page");
	$sentencia->execute();
	return $sentencia->fetchAll();
}


function obtener_posnews($conexion, $id_posnews){
	$sentencia = $conexion->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM posnews WHERE id_sector = '$id_posnews' ORDER BY name_pos");
	$sentencia->execute();
	return $sentencia->fetchAll();
}


//FUNCION PARA PASAR A SER JOURNALIST/SOURCE
function upgrade_user($conexion, $email){
	$sentencia = $conexion->prepare("UPDATE users SET type = 'JOURNALIST/SOURCE' WHERE email = '$email'");
	$sentencia->execute();
	return $sentencia->fetchAll();
}


//obtenemos el id que llega por GET, lo limpiamos y lo convertimos a entero
function id_user_convertir($id){
	return (int)limpiarDatos($id);
}

function obtener_usuarios_por_id($conexion, $id){
	$sentencia = $conexion->prepare("SELECT name, last_name, email, birth_date, cityfield_origin, cityfield_residence, countryfield_residence, countryfield_origin, place_origin, place_residence, img_route, description, fullname_quote, journalink FROM users WHERE id_user = '$id' LIMIT 1");
	$sentencia->execute();
	return $sentencia->fetchAll();
}

////////////////////////////////////////////////////////////////////////////////////////
function obtener_idiomas_usuario($conexion, $id){
	$sentencia = $conexion->prepare("SELECT languages_id_language FROM users_has_languages WHERE users_id_user = '$id'");
	$sentencia->execute();
	return $sentencia->fetchAll();
}

function obtener_nombre_idioma($conexion, $idlang){
	$sentencia = $conexion->prepare("SELECT id_language, name_language FROM languages WHERE id_language = '$idlang'");
	$sentencia->execute();
	return $sentencia->fetchAll();
}
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
function obtener_industrias_usuario($conexion, $id){
	$sentencia = $conexion->prepare("SELECT industries_id_industry FROM users_has_industries WHERE users_id_user = '$id'");
	$sentencia->execute();
	return $sentencia->fetchAll();
}

function obtener_nombre_idustria($conexion, $id){
	$sentencia = $conexion->prepare("SELECT id_industry, name_industry FROM industries WHERE id_industry = '$id'");
	$sentencia->execute();
	return $sentencia->fetchAll();
}
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
function obtener_areas_usuario($conexion, $id){
	$sentencia = $conexion->prepare("SELECT areas_id_area FROM users_has_areas WHERE users_id_user = '$id'");
	$sentencia->execute();
	return $sentencia->fetchAll();
}

function obtener_nombre_area($conexion, $id){
	$sentencia = $conexion->prepare("SELECT id_area, name_area FROM areas WHERE id_area = '$id'");
	$sentencia->execute();
	return $sentencia->fetchAll();
}
/////////////////////////////////////////////////////////////////////////////////////////////


function obtener_sector_usuario($conexion, $id){
	$sentencia = $conexion->prepare("SELECT sectors_id_sector, id_posnews FROM users_has_sectors WHERE users_id_user = '$id'");
	$sentencia->execute();
	return $sentencia->fetchAll();
}
function obtener_nombre_sector($conexion, $id){
	$sentencia = $conexion->prepare("SELECT name_sector FROM sectors WHERE id_sector = '$id'");
	$sentencia->execute();
	return $sentencia->fetchAll();
}
function obtener_nombre_posnews($conexion, $id){
	$sentencia = $conexion->prepare("SELECT name_pos FROM posnews WHERE id_pos = '$id'");
	$sentencia->execute();
	return $sentencia->fetchAll();
}

function obtener_newsoutlet($conexion, $id){
	$sentencia = $conexion->prepare("SELECT newsoutlet_institution FROM users WHERE id_user = '$id'");
	$sentencia->execute();
	return $sentencia->fetchAll();
}

function reset_pass_verify($conexion, $email, $key){
	$sentencia = $conexion->prepare("SELECT * FROM users WHERE email = '$email' AND resetkey = '$key' LIMIT 1");
	$sentencia->execute();
	return $sentencia->fetchAll();
}

function randHash($len=32)
{
	return substr(md5(openssl_random_pseudo_bytes(20)),-$len);
}

function delete_industry($conexion, $id_user, $id_industry){
	$sentencia = $conexion->prepare("DELETE FROM users_has_industries WHERE users_id_user = '$id_user' AND industries_id_industry = '$id_industry'");
	$sentencia->execute();
	return $sentencia->fetchAll();
}

function delete_area($conexion, $id_user, $id_area){
	$sentencia = $conexion->prepare("DELETE FROM users_has_areas WHERE users_id_user = '$id_user' AND areas_id_area = '$id_area'");
	$sentencia->execute();
	return $sentencia->fetchAll();
}

function delete_language($conexion, $id_user, $id_language){
	$sentencia = $conexion->prepare("DELETE FROM users_has_languages WHERE users_id_user = '$id_user' AND languages_id_language = '$id_language'");
	$sentencia->execute();
	return $sentencia->fetchAll();
}

function delete_user($conexion, $id_user){
	$sentencia = $conexion->prepare("DELETE FROM users_has_industries WHERE users_id_user = '$id_user'");
	$sentencia->execute();

	$sentencia1 = $conexion->prepare("DELETE FROM users_has_areas WHERE users_id_user = '$id_user'");
	$sentencia1->execute();

	$sentencia2 = $conexion->prepare("DELETE FROM users_has_languages WHERE users_id_user = '$id_user'");
	$sentencia2->execute();

	$sentencia3 = $conexion->prepare("DELETE FROM users_has_sectors WHERE users_id_user = '$id_user'");
	$sentencia3->execute();

	$sentencia4 = $conexion->prepare("DELETE FROM users WHERE id_user = '$id_user'");
	$sentencia4->execute();

	return $sentencia4->fetchAll();
}



 ?>