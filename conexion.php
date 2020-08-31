<?php

function conectarDB(){
//Conexión a DB 123
        $servidor = "localhost";
        $usuario = "root";
        $password = "";
        $bd = "tecno_aprender";

    $conexion = mysqli_connect($servidor, $usuario, $password,$bd);

        if($conexion){
            echo "";
        }else{
            echo 'Ha sucedido un error inexperado en la conexion de la base de datos';
        }

    return $conexion;
}
?>
