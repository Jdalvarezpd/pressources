<?php 

//defino la variable RUTA que me indica donde esta mi carpeta base de mi pagina
define ('RUTA', 'http://localhost/proyectos/pressources');
//Variable para validar la ruta del header y poder cambiar el css de la barra de navegacion usando $_SERVER['REQUEST_URI']
define ('RUTA_HEADER', '/proyectos/pressources/' );

//Arreglo para acceder a la base de datos
$bd_config = array(
	'basedatos' => 'pressources1',
	'usuario' => 'root',
	'pass' => '',
	'host' => 'localhost'
);

//PRESSOURCES
/*define ('RUTA', 'http://www.pressources.com');
define ('RUTA_HEADER', '/');

$bd_config = array(
	'basedatos' => 'Sql1215837_1',
	'usuario' => 'Sql1215837',
	'pass' => '3smkw2328u',
	'host' => '89.46.111.66'
);

$admin_user1 = array(
	'user' => 'gedallovich_press',
	'pass' => 'p2017res07s2618'
);

$admin_user2 = array(
	'user' => 'rossella_press',
	'pass' => 'p2017res05s1425'
);*/

?>