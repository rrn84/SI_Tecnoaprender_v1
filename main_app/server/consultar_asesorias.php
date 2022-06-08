<?php
$id = $_GET['id_CE'];
$correo =  $_GET['correo'];
$tipoUsr = $_GET['tipo_usr'];


switch($tipoUsr) {
    case "2":
        //echo "director";
        $sql= "SELECT 
        asesoria2.*, 
        centro_educativo.institucion, centro_educativo.cod_pres, centro_educativo.equipamiento,
        centro_educativo.direccion_regional, centro_educativo.direccion_regional, 
        centro_educativo.provincia, centro_educativo.canton, centro_educativo.distrito 
        FROM asesoria2 
        INNER JOIN centro_educativo ON  centro_educativo.id=asesoria2.id_CE 
        WHERE id_CE= '$id'";        
    break;
    
    case "6":
        //echo "Asesor";
        $sql= "SELECT
        asesoria2.*,
        centro_educativo.institucion, centro_educativo.cod_pres, centro_educativo.equipamiento,
        centro_educativo.direccion_regional, centro_educativo.direccion_regional, 
        centro_educativo.provincia, centro_educativo.canton, centro_educativo.distrito  
        FROM asesoria2
        INNER JOIN centro_educativo ON centro_educativo.id=asesoria2.id_CE ";
    break;

    case "8":
        //echo "Admin";
        $sql= "SELECT
        asesoria2.*, 
        centro_educativo.institucion, centro_educativo.cod_pres, centro_educativo.equipamiento,
        centro_educativo.direccion_regional, centro_educativo.direccion_regional, 
        centro_educativo.provincia, centro_educativo.canton, centro_educativo.distrito 
        FROM asesoria2 
        INNER JOIN centro_educativo ON centro_educativo.id=asesoria2.id_CE WHERE tipo_visita = 1";
    break;
        
    case "9":
        //echo "Admin";
        $sql= "SELECT
        asesoria2.*, 
        direcciones_regionales.nombre, direcciones_regionales.telefono
        FROM asesoria2 
        INNER JOIN direcciones_regionales ON direcciones_regionales.id=asesoria2.id_CE WHERE tipo_visita = 2";
    break;

    case "10":
        //echo "Admin";
        $sql= "SELECT
        asesoria2.*, 
        centro_educativo.institucion, centro_educativo.cod_pres, centro_educativo.equipamiento,
        centro_educativo.direccion_regional, centro_educativo.direccion_regional, 
        centro_educativo.provincia, centro_educativo.canton, centro_educativo.distrito 
        FROM asesoria2 
        INNER JOIN centro_educativo ON centro_educativo.id=asesoria2.id_CE WHERE tipo_visita = 1 and asesoria2.id_CE= '$id'";
    break;

    case "11":
        $sql= "SELECT
        asesoria2.*, 
        centro_educativo.institucion, centro_educativo.cod_pres, centro_educativo.equipamiento,
        centro_educativo.direccion_regional, centro_educativo.direccion_regional, 
        centro_educativo.provincia, centro_educativo.canton, centro_educativo.distrito 
        FROM asesoria2 
        INNER JOIN centro_educativo ON centro_educativo.id=asesoria2.id_CE WHERE tipo_visita = 1 and centro_educativo.direccion_regional like '%$id%'";
    break;

    default:
        echo "opcion fuera de rango";
    }
//$sql= "SELECT asesorias.correo_asesor, asesorias.id, asesorias.objetivos, asesorias.observaciones, asesorias.recomendacion_asesor, asesorias.fecha, asesorias.fecha_ingreso, asesorias.medio_visita, centro_educativo.institucion FROM asesorias INNER JOIN centro_educativo ON centro_educativo.cod_pres = asesorias.id_CE";

include "conexion.php";
sleep(1);
function desconectar($conexion){

    $close = mysqli_close($conexion);

        if($close){
            echo '';
        }else{
            echo 'Ha sucedido un error inexperado en la desconexion de la base de datos
';
        }

    return $close;
}

function obtenerArreglo($sql){
    //Creamos la conexion con la funcion anterior
  $conexion = conectarDB();
  
    //generamos la consulta

        mysqli_set_charset($conexion, "utf8"); //formato de datos utf8

    if(!$resultado = mysqli_query($conexion, $sql)) die(); //si la conexi��n cancelar programa

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