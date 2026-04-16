<?php session_start();

    require 'admin/config.php'; 
    require 'functions.php'; 

    //Nos conectamos a la base de datos
    $conexion = func_conexion($bd_config);

    if (!$conexion) {
        header('Location: error.php');
    }

    func_comprobarSession();

    $errores = '';

    $email = $_SESSION['user'];

    $user_data = consultar_existencia_por_email($conexion, $email);

    if($user_data['type'] == 'SOURCE'){
        header('Location: ' . RUTA . "/profile");
    }

    if($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['busqueda'])){
        $busqueda = limpiarDatos($_GET['busqueda']);
        $city_residence_hidden = limpiarDatos($_GET['residence_city_hidden']);
        if($city_residence_hidden == ""){
            $users_found = obtener_usuarios_por_industrias($conexion, $busqueda, 50);
        }else{
            if($busqueda=="Select an Industry"){


                $users_found = obtener_usuarios_por_ciudad($conexion, $city_residence_hidden, 50);
                //$users_found2 = obtener_usuarios_por_ciudad($conexion, $city_residence_hidden, 50);

                /*for($i=0; $i<count($users_found); $i++){
                    echo $users_found[$i][0];
                    for($j=0; $j<count($users_found2); $j++){
                        if($users_found[$i][0] == $users_found2[$j][0]){
                            //print_r($users_found2[$j][3]);
                             unset($users_found2[$j]);
                        }
                    }
                }*/

            }else{
                $users_found = obtener_usuarios($conexion, $busqueda, $city_residence_hidden, 50);    
            } 
        }
        

        if(empty($users_found)){
            $errores = 'No results were found';
        } else{
            //$titulo = 'Resultado de la busqueda: ' . $busqueda;
        }
    }

    //Obtengo los posts de la base de datos
    $industries = obtener_industrias($conexion);

    


    require 'views/header.php';
    require 'views/searchprofile.view.php';


    function eliminar_tildes($cadena){
 
    //Codificamos la cadena en formato utf8 en caso de que nos de errores
    $cadena = utf8_encode($cadena);
 
    //Ahora reemplazamos las letras
    $cadena = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $cadena
    );
 
    $cadena = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $cadena );
 
    $cadena = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $cadena );
 
    $cadena = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $cadena );
 
    $cadena = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $cadena );
 
    $cadena = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('n', 'N', 'c', 'C'),
        $cadena
    );
 
    return $cadena;
}

 ?>