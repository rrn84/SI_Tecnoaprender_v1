<?php
header("Content-type:text/html;charset=\"utf-8\"");
$tabla = $_GET['tabla'];
$tipo = $_GET['tipo'];

$quien= $_GET["id"];

if ($tabla == "centro_educativo" or $tabla == "centros_educativos_mep" or $tabla == "iniciativas"){
    $columna = "id";
    
    if ($tipo == 2){
        $sql = "SELECT * FROM $tabla";
        
        }else {
        $sql = "SELECT * FROM $tabla  WHERE `$columna`=$quien";
        }
        
	
}
else if ($tabla == "uso_equipo"){
    $columna = "id_CE";
    $sql = "SELECT * FROM $tabla  WHERE `$columna`=$quien ORDER BY id DESC LIMIT 1"; 
	
    }else {

        $columna = "id_CE";
        $sql = "SELECT * FROM $tabla  WHERE `$columna`=$quien"; 
    }

  



// $sql = "SELECT * FROM centro_educativo  WHERE id=9";
//$sql = "SELECT * FROM `centro_educativo` WHERE`id`= 9";
include "conexion.php";
function desconectar($conexion){

    $close = mysqli_close($conexion);

        if($close){
            echo '';
        }else{
            echo 'Ha sucedido un error inexperado en la desconexion de la base de datos';
        }

    return $close;
}

function obtenerArreglo($sql){
    //Creamos la conexion con la funcion anterior
    $conexion = conectarDB();

    //generamos la consulta

        mysqli_set_charset($conexion, "utf8"); //formato de datos utf8

    if(!$resultado = mysqli_query($conexion, $sql)) die(); //si la conexión cancelar programa

    $arreglo = array(); //creamos un array

    //guardamos en un array todos los datos de la consulta
    $i=0;

    while($row = mysqli_fetch_assoc($resultado))
    {
        $arreglo[$i] = $row;
        $i++;
    }

    desconectar($conexion); //desconectamos la base de datos

    return $arreglo; //devolvemos el array
}

        $r = obtenerArreglo($sql);
        echo json_encode($r);
?>
