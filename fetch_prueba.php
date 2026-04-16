<?php 

//uso del archivo de configuracion
	require 'admin/config.php'; 

	//uso del archivo de funciones
	require 'functions.php'; 

	//NOS CONECTAMOS A LA BASE DE DATOS
	$conexion = func_conexion($bd_config);

	$output = '';

	$postdata = $_POST["idsector"]; 
	//echo '<script>console.log('$postdata')</script>';

	//$sql = "SELECT * FROM posnews WHERE id_sector= '$postdata'";
	$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM areas WHERE id_area = $postdata";



	//$sql = "SELECT * FROM posnews WHERE id_sector = 1 ";
	//$result = mysqli_query($conexion, $sql);
	$output = '<option value="">-</option>';
	//echo $result;

	$result = obtener_posnews($conexion, $postdata);
	//$result = obtener_areas($conexion, "1");

	/*while($row = mysqli_fetch_array($result)){
		//$output .= '<option value="'.$row["id_area"].'">'.$row["name_area"].'</option>';
		//$output .= '<option value="">Select dos</option>';

		$output .= '<option value="'.$row["id_area"].'">'.$row["name_area"].'</option>';
		//echo '<script>console.log('$postdata')</script>';
	}*/

	foreach ($result as $res) {
		//echo '<script>console.log("yea")</script>';
		$output .= '<option value="'.$res["id_pos"].'">'.$res["name_pos"].'</option>';
	}

	echo $output;

 ?>