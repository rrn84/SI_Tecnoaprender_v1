<?php
$idCe = $_GET["idCe"];
$tipo = $_GET["tipo"];

if ($tipo == 1){
$sql= "SELECT 
centro_educativo.direccion_regional, centro_educativo.telefono, centro_educativo.equipamiento, 
infraestructura.tomas, infraestructura.condicion_electrica, infraestructura.plaqueo_equipo, 
infraestructura.protocolo_equipo, infraestructura.aire_acondicionado
FROM centro_educativo 
INNER JOIN infraestructura ON  centro_educativo.id=infraestructura.id_CE 
WHERE centro_educativo.id = '$idCe'";
}else {
    $sql= "SELECT nombre, telefono FROM direcciones_regionales WHERE id = '$idCe'";

}

include "conexion.php";
sleep(1);
function desconectar($conexion)
{
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