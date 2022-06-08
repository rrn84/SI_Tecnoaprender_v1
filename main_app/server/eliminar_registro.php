<?php
header("Content-type:text/html;charset=\"utf-8\"");
$elemento = $_POST['id_elemento'];
$donde = $_POST['tabla'];
//$elemento = "10";
//$donde = "consultas";
$sql = "DELETE FROM $donde WHERE `id` = $elemento";
//echo $elemento;
include "conexion.php";

$conexion = conectarDB();


//generamos la consulta

mysqli_set_charset($conexion, "utf8"); //formato de datos utf8

if(!mysqli_query($conexion, $sql)) die();

$sql = "DELETE FROM `proyectos` WHERE `id_iniciativa` = $elemento";

if(!mysqli_query($conexion, $sql)) die();

desconectar($conexion); 


function desconectar($conexion){

    $close = mysqli_close($conexion);

        if($close){
            echo '';
        }else{
            echo 'Ha sucedido un error inexperado en la desconexion de la base de datos';
        }

    return $close;
}

?>